<?php
/**
 *
 * Copyright 2018 ELASTIC Consultants Inc.
 *
 */

namespace Codeception\Module\MobileEmulation;

use Codeception\TestInterface;

/**
 * MobileEmulation Driver interface
 */
interface MobileEmulationDriverInterface
{

    /**
     * Auto load when Cest class has $mobileEmulation property.
     *
     * @param TestInterface $test
     */
    public function _before(TestInterface $test);

    /**
     * Reset WebDriver config when mobile emulated
     *
     * @param TestInterface $test
     */
    public function _after(TestInterface $test);

    /**
     * set mobileEmulation and restart WebDriver
     *
     * @param mixed $deviceName
     */
    public function emulationMobile($deviceName = null);
}
