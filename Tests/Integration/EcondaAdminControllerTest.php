<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\EcondaModule\Tests\Integration;

use OxidEsales\EcondaModule\Application\Controller\Admin\EcondaAdminController;
use OxidEsales\EcondaModule\Application\Factory;
use OxidEsales\EcondaModule\Component\Tracking\File\FileSystem;

class EcondaAdminControllerTest extends \OxidEsales\TestingLibrary\UnitTestCase
{
    public function testGetTrackingScriptMessageIfEnabledWhenFileIsPresent()
    {
        $jsFileLocatorStub = $this->getFileSystemStub(true);

        $controller = $this->getEcondaAdminController($jsFileLocatorStub);
        $this->assertNotEmpty($controller->getTrackingScriptMessageIfEnabled());
    }

    public function testGetTrackingScriptMessageIfEnabledWhenFileIsNotPresent()
    {
        $jsFileLocatorStub = $this->getFileSystemStub(false);

        $controller = $this->getEcondaAdminController($jsFileLocatorStub);
        $this->assertEmpty($controller->getTrackingScriptMessageIfEnabled());
    }

    public function testGetTrackingScriptMessageIfDisabledWhenFileIsPresent()
    {
        $jsFileLocatorStub = $this->getFileSystemStub(true);

        $controller = $this->getEcondaAdminController($jsFileLocatorStub);
        $this->assertEmpty($controller->getTrackingScriptMessageIfDisabled());
    }

    public function testGetTrackingScriptMessageIfDisabledWhenFileIsNotPresent()
    {
        $jsFileLocatorStub = $this->getFileSystemStub(false);

        $controller = $this->getEcondaAdminController($jsFileLocatorStub);
        $this->assertNotEmpty($controller->getTrackingScriptMessageIfDisabled());
    }

    /**
     * @param FileSystem $fileSystem
     * @return EcondaAdminController
     */
    protected function getEcondaAdminController($fileSystem)
    {
        $factory = $this->getMockBuilder(Factory::class)
            ->setMethods(['getFileSystem'])
            ->getMock();
        $factory->method('getFileSystem')->willReturn($fileSystem);
        $controller = oxNew(EcondaAdminController::class, $factory);

        return $controller;
    }

    /**
     * @param bool $isFilePresent
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|FileSystem
     */
    protected function getFileSystemStub($isFilePresent)
    {
        $fileSystemStub = $this->getMockBuilder(FileSystem::class)
            ->disableOriginalConstructor()
            ->getMock();
        $fileSystemStub->method('isFilePresent')->willReturn($isFilePresent);

        return $fileSystemStub;
    }
}
