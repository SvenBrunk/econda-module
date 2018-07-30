<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\PersonalizationModule\Tests\Integration;

use OxidEsales\PersonalizationModule\Application\Feed\GenerateCSVExportsMain;
use OxidEsales\PersonalizationModule\Application\Factory;
use OxidEsales\PersonalizationModule\Component\Tracking\File\FileSystem;

class GenerateCSVExportsMainTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
    public function testGetTrackingScriptMessageIfEnabledWhenFileIsPresent()
    {
        $jsFileLocatorStub = $this->makeFileSystemStub(true);

        $controller = $this->getGenerateCSVExportsMain($jsFileLocatorStub);
        $this->assertNotEmpty($controller->getTrackingScriptMessageIfEnabled());
    }

    public function testGetTrackingScriptMessageIfEnabledWhenFileIsNotPresent()
    {
        $jsFileLocatorStub = $this->makeFileSystemStub(false);

        $controller = $this->getGenerateCSVExportsMain($jsFileLocatorStub);
        $this->assertEmpty($controller->getTrackingScriptMessageIfEnabled());
    }

    public function testGetTrackingScriptMessageIfDisabledWhenFileIsPresent()
    {
        $jsFileLocatorStub = $this->makeFileSystemStub(true);

        $controller = $this->getGenerateCSVExportsMain($jsFileLocatorStub);
        $this->assertEmpty($controller->getTrackingScriptMessageIfDisabled());
    }

    public function testGetTrackingScriptMessageIfDisabledWhenFileIsNotPresent()
    {
        $jsFileLocatorStub = $this->makeFileSystemStub(false);

        $controller = $this->getGenerateCSVExportsMain($jsFileLocatorStub);
        $this->assertNotEmpty($controller->getTrackingScriptMessageIfDisabled());
    }

    /**
     * @param FileSystem $fileSystem
     * @return GenerateCSVExportsMain
     */
    protected function getGenerateCSVExportsMain($fileSystem)
    {
        $factory = $this->getMockBuilder(Factory::class)
            ->setMethods(['makeFileSystem'])
            ->getMock();
        $factory->method('makeFileSystem')->willReturn($fileSystem);
        $controller = oxNew(GenerateCSVExportsMain::class, $factory);

        return $controller;
    }

    /**
     * @param bool $isFilePresent
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|FileSystem
     */
    protected function makeFileSystemStub($isFilePresent)
    {
        $fileSystemStub = $this->getMockBuilder(FileSystem::class)
            ->disableOriginalConstructor()
            ->getMock();
        $fileSystemStub->method('isFilePresent')->willReturn($isFilePresent);

        return $fileSystemStub;
    }
}
