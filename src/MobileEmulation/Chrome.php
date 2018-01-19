<?php
/**
 *
 * Copyright 2018 ELASTIC Consultants Inc.
 *
 */

namespace Codeception\Module\MobileEmulation;

use Codeception\Module;
use Codeception\Module\WebDriver;
use Codeception\Test\Cest;
use Codeception\TestInterface;
use Facebook\WebDriver\Chrome\ChromeOptions;
use InvalidArgumentException;

/**
 * WebDriver Mobile Emulation for Chrome
 */
class Chrome extends Module implements MobileEmulationDriverInterface
{

    /**
     * @var array
     */
    protected $config = [
        'defaultDeviceName' => 'iPhone 6',
    ];

    /**
     * is mobile emulated
     *
     * @var bool
     */
    protected $mobileEmulated = false;

    /**
     * setup defaultDeviceName
     */
    public function _initialize()
    {
        $defaultDeviceName = $this->_getConfig('defaultDeviceName');
        if ($defaultDeviceName) {
            $this->defaultDeviceName = $defaultDeviceName;
        }
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

        $testClass = $test->getTestClass();

        $mobileEmulation = property_exists($testClass, 'mobileEmulation') ? $testClass->mobileEmulation : false;

        if ($mobileEmulation === true) {
            $this->_mobileEmulation($this->_getConfig('defaultDeviceName'));
        } elseif ($mobileEmulation) {
            $this->_mobileEmulation($mobileEmulation);
        }
    }

    /**
     * Reset WebDriver config when mobile emulated
     *
     * @param TestInterface $test
     */
    public function _after(TestInterface $test)
    {
        if ($this->mobileEmulated) {
            $driver = $this->getModule('WebDriver');
            /* @var $driver WebDriver */
            $driver->_resetConfig();
            $driver->_restart($driver->_getConfig());
            $this->mobileEmulated = false;
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
        if ($deviceName === null) {
            $deviceName = $this->_getConfig('defaultDeviceName');
        }

        $this->_mobileEmulation($deviceName);
        $this->getModule('WebDriver')->_restart();
        $this->mobileEmulated = true;
    }

    /**
     * @param mixed $deviceName
     * @link https://sites.google.com/a/chromium.org/chromedriver/mobile-emulation
     */
    protected function _mobileEmulation($deviceName)
    {
        $mobileEmulation;

        if (is_string($deviceName)) {
            $mobileEmulation = MobileEmulationOptions::withDeviceName($deviceName);
        } elseif (is_array($deviceName)) {
            $mobileEmulation = MobileEmulationOptions::fromArray($deviceName);
        } else {
            $mobileEmulation = $deviceName;
        }

        if (!is_a($mobileEmulation, MobileEmulationOptions::class)) {
            throw new InvalidArgumentException('Invalid mobileEmulation options: ' . var_export($deviceName, true));
        }

        $driver = $this->getModule('WebDriver');
        /* @var $driver WebDriver */

        $driver->_capabilities(function($currentCapabilities) use ($mobileEmulation) {
            $chromeOptions = new ChromeOptions();
            $chromeOptions->setExperimentalOption('mobileEmulation', $mobileEmulation->toArray());
            $currentCapabilities[ChromeOptions::CAPABILITY] = $chromeOptions->toArray();

            return $currentCapabilities;
        });
    }
}
