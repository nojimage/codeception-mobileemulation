<?php
/**
 *
 * Copyright 2018 ELASTIC Consultants Inc.
 *
 */

namespace Codeception\Module;

use Codeception\Module;
use Codeception\Module\MobileEmulation\Chrome;
use Codeception\Test\Cest;
use Codeception\TestInterface;
use RuntimeException;

/**
 * WebDriver Mobile Emulation
 */
class MobileEmulation extends Module
{

    /**
     * @var array
     */
    protected $config = [
        'defaultDeviceName' => 'iPhone 6',
    ];

    /**
     * @var Chrome
     */
    protected $chrome;

    /**
     * setup defaultDeviceName
     */
    public function _initialize()
    {
        $defaultDeviceName = $this->_getConfig('defaultDeviceName');
        if ($defaultDeviceName) {
            $this->defaultDeviceName = $defaultDeviceName;
        }

        if (!$this->hasModule(Chrome::class)) {
            $this->moduleContainer->create(Chrome::class);
        }
        $this->chrome = $this->getModule(Chrome::class);
        $this->chrome->_setConfig($this->_getConfig());
    }

    /**
     * Auto load when Cest class has $mobileEmulation property.
     *
     * @param TestInterface $test
     */
    public function _before(TestInterface $test)
    {
        if (!is_a($test, Cest::class)) {
            return;
        }

        if ($this->getBrowser() === 'chrome') {
            $this->chrome->_before($test);
        }
    }

    /**
     * Reset WebDriver config when mobile emulated
     *
     * @param TestInterface $test
     */
    public function _after(TestInterface $test)
    {
        if ($this->getBrowser() === 'chrome') {
            $this->chrome->_after($test);
        }
    }

    /**
     * set mobileEmulation and restart WebDriver
     *
     * @param mixed $deviceName
     * @link https://sites.google.com/a/chromium.org/chromedriver/mobile-emulation
     */
    public function emulationMobile($deviceName = null)
    {
        if ($this->getBrowser() === 'chrome') {
            $this->chrome->emulationMobile($deviceName);
            return;
        }

        throw new RuntimeException('MobileEmulation support only chrome browser.');
    }

    /**
     * @return string
     */
    protected function getBrowser()
    {
        return strtolower($this->getModule('WebDriver')->_getConfig('browser'));
    }
}
