<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\EcondaModule\Tests\Integration;

use OxidEsales\EcondaModule\Application\Feed\GenerateCSVExportsDo;
use OxidEsales\Eshop\Core\Registry;

class GenerateCSVExportsDoTest extends ExportDataInCSVTest
{
    /**
     * @inheritdoc
     */
    protected function prepareShopStructureForExport()
    {
        $vfsWrapper = $this->getVfsStreamWrapper();
        $vfsWrapper->createStructure(['export' => []]);

        Registry::getConfig()->setConfigParam('sShopDir', $vfsWrapper->getRootPath());
        return $vfsWrapper->getRootPath();
    }

    /**
     * @inheritdoc
     */
    protected function setParametersForExport($exportParentProducts, $exportVars, $categories, $minStock, $exportPath)
    {
        $this->setRequestParameter('acat', $categories);
        $this->setRequestParameter('sExportMinStock', $minStock);
        $this->setRequestParameter('blExportMainVars', $exportParentProducts);
        $this->setRequestParameter('blExportVars', $exportVars);
        $this->setRequestParameter("iStart", 1);
        Registry::getConfig()->setConfigParam('sOeEcondaExportPath', $exportPath);
    }

    /**
     * @inheritdoc
     */
    protected function prepareShopUrlForExport()
    {
        $vfsWrapperUrl = $this->getVfsStreamWrapper();

        $shopUrl = $vfsWrapperUrl->getRootPath();

        Registry::getConfig()->setConfigParam('sShopURL', $shopUrl);

        $pictureHandler = $this->getMock(\OxidEsales\Eshop\Core\PictureHandler::class, ["getProductPicUrl"]);
        $pictureHandler->expects($this->any())->method('getProductPicUrl')->will($this->returnValue(
            $shopUrl . 'out/pictures/generated/product/1/540_340_75/nopic.jpg'
        ));
        Registry::set(\OxidEsales\Eshop\Core\PictureHandler::class, $pictureHandler);
        return $shopUrl;
    }

    /**
     * @inheritdoc
     */
    protected function runExport()
    {
        $export = oxNew(GenerateCSVExportsDo::class);

        $export->start();
        $export->run();
    }

    public function testCreateFolderOnInitialization()
    {
        $shopDir = $this->prepareShopStructureForExport();
        Registry::getConfig()->setConfigParam('sOeEcondaExportPath', 'export/oeeconda');

        oxNew(GenerateCSVExportsDo::class);

        $this->assertFileExists($shopDir . 'export/oeeconda');
    }

    public function testUseExportPathFromConfig()
    {
        $vfsWrapper = $this->getVfsStreamWrapper();
        $vfsWrapper->createStructure(['export_test' => []]);

        Registry::getConfig()->setConfigParam('sShopDir', $vfsWrapper->getRootPath());
        Registry::getConfig()->setConfigParam('sOeEcondaExportPath', 'export_test/custom_test');

        oxNew(GenerateCSVExportsDo::class);

        $this->assertFileExists($vfsWrapper->getRootPath() . 'export_test/custom_test');
    }

}
