<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\PersonalizationModule\Application\Feed;

use OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\TableViewNameGenerator;
use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Application\Model\CategoryList;

class GenerateCSVExportsDo extends \OxidEsales\Eshop\Application\Controller\Admin\GenericExportDo
{
    /**
     * @inheritdoc
     */
    public $sClassDo = self::class;

    /**
     * @inheritdoc
     */
    public $sClassMain = GenerateCSVExportsMain::class;

    /**
     * @inheritdoc
     */
    public $sExportPath = "";

    /**
     * Delimiter for values
     *
     * @var string
     */
    public $delim = "|";

    /**
     * Line delimiter
     *
     * @var string
     */
    public $lineDelim = "\n";

    /**
     * Complete name of product file
     *
     * @var string
     */
    private $productFilename = "";

    /**
     * Complete name of category file
     *
     * @var string
     */
    private $categoryFilename = "";

    /**
     * @inheritdoc
     */
    protected $_sThisTemplate = "oepersonalizationexportresult.tpl";

    /**
     * GenerateCSVExportsDo constructor.
     *
     * @param string $exportPath
     */
    public function __construct($exportPath = null)
    {
        parent::__construct();
        $this->sExportPath = ($exportPath) ? $exportPath : $this->getConfig()->getConfigParam('sOePersonalizationExportPath');
        $this->oePersonalizationPrepareExport();
    }

    /**
     * @inheritdoc
     */
    public function nextTick($pos)
    {
        if ($pos == 1) {
            $this->oePersonalizationPrepareProductExport();
            $this->oePersonalizationPrepareCategoryExport();

            $this->oePersonalizationExportCategories();

            $productsHeader = $this->oePersonalizationGetProductsHeader();
            $this->writeToFile($this->productFilename, $productsHeader);
        }

        $continueExport = false;

        $article = $this->getOneArticle($pos, $continueExport);
        if ($article) {
            $productsBody = $this->oePersonalizationGetProductsRow($article);
            $this->writeToFile($this->productFilename, $productsBody);
            $continueExport = $pos;
        }

        return $continueExport;
    }

    /**
     * @inheritdoc
     */
    protected function _insertArticles($sHeapTable, $sCatAdd)
    {
        parent::_insertArticles($sHeapTable, $sCatAdd);

        return true;
    }

    /**
     * Create export folder, if not existent.
     */
    private function oePersonalizationPrepareExport()
    {
        $directory = rtrim($this->getConfig()->getConfigParam('sShopDir') . $this->sExportPath, "/");
        if (!file_exists($directory)) {
            mkdir($directory);
        }
    }

    /**
     * Set filename for product export, delete file if already present.
     */
    private function oePersonalizationPrepareProductExport()
    {
        $directory = rtrim($this->getConfig()->getConfigParam('sShopDir') . $this->sExportPath, '/');
        $this->productFilename = $directory . '/products.csv';
        if (file_exists($this->productFilename)) {
            unlink($this->productFilename);
        }
    }

    /**
     * Set filename for category export, delete file if already present.
     */
    private function oePersonalizationPrepareCategoryExport()
    {
        $directory = rtrim($this->getConfig()->getConfigParam('sShopDir') . $this->sExportPath, '/');
        $this->categoryFilename = $directory . '/categories.csv';
        if (file_exists($this->categoryFilename)) {
            unlink($this->categoryFilename);
        }
    }

    /**
     * Get header row for product export.
     *
     * @return string
     */
    protected function oePersonalizationGetProductsHeader()
    {
        $fields = [
            'ID',
            $this->getLanguageVariation("Name"),
            $this->getLanguageVariation("Description"),
            $this->getLanguageVariation("ProductUrl"),
            'ImageUrl',
            'Price',
            'OldPrice',
            'New',
            'Stock',
            'EAN',
            'Brand',
            'ProductCategory'
        ];
        return $this->joinArray($fields) . $this->lineDelim;
    }

    /**
     * Get single row for product export.
     *
     * @param Article $article Article to use for export.
     *
     * @return string
     */
    protected function oePersonalizationGetProductsRow($article)
    {
        $articleForDescription = $article;

        if ($article->isVariant()) {
            $articleForDescription = $article->getParentArticle();
        }

        $oldPrice = 0;
        if ($article->getTPrice()) {
            $oldPrice = $article->getTPrice()->getBruttoPrice();
        }

        $fields = array_values([
            'ID' => (isset($article->oxarticles__oxartnum->value) && $article->oxarticles__oxartnum->value) ? $article->oxarticles__oxartnum->value : $article->getId(),
            'Name' => $this->joinArray($this->oePersonalizationGetArticleTitles($articleForDescription->oxarticles__oxid->value)),
            'Description' => $this->joinArray($this->oePersonalizationGetArticleDescriptions($articleForDescription->oxarticles__oxid->value)),
            'ProductUrl' => $this->joinArray($this->oePersonalizationGetArticleLinks($article)),
            'ImageUrl' => $this->formatText($article->getPictureUrl(1)),
            'Price' => $article->getPrice()->getBruttoPrice(),
            'OldPrice' => $oldPrice,
            'New' => '0',
            'Stock' => $article->oxarticles__oxstock->value,
            'EAN' => $this->formatText($article->oxarticles__oxean->value),
            'Brand' => $this->formatText(($article->getManufacturer()) ? $article->getManufacturer()->oxmanufacturers__oxtitle->value : ''),
            'ProductCategory' => $this->joinArray($article->getCategoryIds())
        ]);

        return $this->joinArray($fields) . $this->lineDelim;
    }

    /**
     * Get the title of an article in all available active languages.
     *
     * @param string $articleId Id of article to get titles from.
     *
     * @return array
     */
    private function oePersonalizationGetArticleTitles($articleId)
    {
        $titles = [];

        $viewNameGenerator = Registry::get(TableViewNameGenerator::class);

        $sql = "SELECT oxtitle FROM :table WHERE oxid=':oxid'";

        foreach ($this->oePersonalizationGetLanguages() as $language) {
            $titles[] = $this->formatText(
                DatabaseProvider::getDb()->getOne(strtr($sql, [
                    ':table' => $viewNameGenerator->getViewName('oxarticles', $language->id),
                    ':oxid' => $articleId
                ]))
            );
        }

        return $titles;
    }

    /**
     * Get the description of a article in all available active languages.
     *
     * @param string $articleId Id of article to get the descriptions from.
     *
     * @return array
     */
    private function oePersonalizationGetArticleDescriptions($articleId)
    {
        $descriptions = [];

        $viewNameGenerator = Registry::get(TableViewNameGenerator::class);

        $sql = "SELECT oxshortdesc FROM :table WHERE oxid=':oxid'";

        foreach ($this->oePersonalizationGetLanguages() as $language) {
            $descriptions[] = $this->formatText(
                DatabaseProvider::getDb()->getOne(strtr($sql, [
                    ':table' => $viewNameGenerator->getViewName('oxarticles', $language->id),
                    ':oxid' => $articleId
                ]))
            );
        }

        return $descriptions;
    }

    /**
     * Get the links of a article in all available active languages.
     *
     * @param Article $article Article to get the links from.
     *
     * @return array
     */
    private function oePersonalizationGetArticleLinks($article)
    {
        $links = [];

        foreach ($this->oePersonalizationGetLanguages() as $language) {
            $links[] = $this->formatText($article->getLink($language->id));
        }

        return $links;
    }

    /**
     * Gets the field names depending on available languages.
     *
     * @param string $fieldname Name of field.
     *
     * @return string
     */
    private function getLanguageVariation($fieldname)
    {
        $values = [$fieldname];
        $languagesCount = count($this->oePersonalizationGetLanguages());
        if ($languagesCount > 1) {
            $index = 1;
            while ($index < $languagesCount) {
                $values[] = $fieldname . '_var' . $index;
                $index++;
            }
        }

        return $this->joinArray($values);
    }

    /**
     * Build a list of categories with parents.
     */
    private function oePersonalizationExportCategories()
    {
        $headers = $this->oePersonalizationGetCategoriesHeader();
        $this->writeToFile($this->categoryFilename, $headers);

        $body = $this->oePersonalizationGetCategoriesBody();
        $this->writeToFile($this->categoryFilename, $body);
    }

    /**
     * Get header row for category export
     *
     * @return string
     */
    protected function oePersonalizationGetCategoriesHeader()
    {
        $fields = [
            'ID',
            'ParentId',
            $this->getLanguageVariation("Name")
        ];
        return $this->joinArray($fields) . $this->lineDelim;
    }

    /**
     * Get rows for category export.
     *
     * @return string
     */
    protected function oePersonalizationGetCategoriesBody()
    {
        $rows = [];

        $languages = $this->oePersonalizationGetLanguages();

        $categoryList = oxNew(CategoryList::class);
        $categoryList->loadList();

        foreach ($categoryList as $category) {
            $id = $category->getId();
            $parent_id = "ROOT";
            $parent = $category->getParentCategory();
            if ($parent != NULL) {
                $parent_id = $parent->getId();
            }
            $categoryTitles = [];
            foreach ($languages as $language) {
                $category->loadInLang($language->id, $id);
                $categoryTitles[] = $this->formatText($category->getTitle());
            }
            $fields = array_values([
                'ID' => $id,
                'ParentID' => $parent_id,
                'Name' => $this->joinArray($categoryTitles)
            ]);
            $rows[] = $this->joinArray($fields);
        }
        return implode($this->lineDelim, $rows);
    }

    /**
     * Appends content to the given file.
     *
     * @param string $filename Name of file
     * @param string $content  Content to append to file.
     */
    private function writeToFile($filename, $content)
    {
        if (strlen($filename) > 0) {
            file_put_contents($filename, $content, FILE_APPEND);
        }
    }

    /**
     * Get all available, active languages
     *
     * @return array
     */
    private function oePersonalizationGetLanguages()
    {
        return Registry::getLang()->getLanguageArray(null, true, true);
    }

    /**
     * Join elements of an array by delimiter.
     *
     * @param array $array Array to join
     *
     * @return string
     */
    private function joinArray($array)
    {
        return implode($this->delim, $array);
    }

    /**
     * Format a text value in compliance with CSV.
     *
     * @param string $value Text value to format
     *
     * @return string
     */
    private function formatText($value)
    {
        if (strlen($value) > 0) {
            return '"' . str_replace('"', '""', $value) . '"';
        } else {
            return '';
        }
    }
}
