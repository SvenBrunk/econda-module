<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\PersonalizationModule\Tests\Integration;

use FileUpload\FileUpload;
use OxidEsales\PersonalizationModule\Application\Factory;
use OxidEsales\PersonalizationModule\Component\Tracking\File\FileSystem;
use OxidEsales\PersonalizationModule\Component\Tracking\File\JsFileLocator;

class FactoryTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
    public function testmakeJsFileLocator()
    {
        $this->assertInstanceOf(JsFileLocator::class, $this->getFactory()->makeJsFileLocator());
    }

    public function testGetFileUploader()
    {
        $this->assertInstanceOf(FileUpload::class, $this->getFactory()->makeFileUploader());
    }

    public function testGetFileSystem()
    {
        $this->assertInstanceOf(FileSystem::class, $this->getFactory()->makeFileSystem());
    }

    protected function getFactory()
    {
        return oxNew(Factory::class);
    }
}
