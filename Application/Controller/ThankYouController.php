<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\EcondaModule\Application\Controller;

use OxidEsales\EcondaModule\Component\DemoAccountData;

/**
 * @mixin \OxidEsales\Eshop\Application\Controller\ThankYouController
 */
class ThankYouController extends ThankYouController_parent
{
    public function oeEcondaGetCategoryId()
    {
        $activeCategoryId = $this->getActiveCategory()->getId();
        if ($this->getConfig()->getConfigParam('blOeEcondaUseDemoAccount')) {
            $activeCategoryId = DemoAccountData::getCategoryId();
        }

        return $activeCategoryId;
    }
}
