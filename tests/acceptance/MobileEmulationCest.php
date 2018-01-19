<?php
/**
 *
 * Copyright 2018 ELASTIC Consultants Inc.
 *
 */

/**
 * Test mobile emulation manualy
 */
class MobileEmulationCest
{

    /**
     * @param AcceptanceTester $I
     */
    public function tryMobileEmulation(AcceptanceTester $I)
    {
        $I->expect('enable mobile emulation manualy');
        $I->emulationMobile();
        $I->amOnPage('/');
        $I->seeInUserAgent('iPhone OS');
        $I->expectsWindowSizeIs(375, 667);
        $I->expectsDevicePixcelRatioIs(2);
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryEmulateWithNexus5(AcceptanceTester $I)
    {
        $I->expect('set Nexus 5 settings');
        $I->emulationMobile('Nexus 5');
        $I->amOnPage('/');
        $I->seeInUserAgent('Android');
        $I->expectsWindowSizeIs(360, 640);
        $I->expectsDevicePixcelRatioIs(3);
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryRevertEmulation(AcceptanceTester $I)
    {
        $I->expect('revert emulation settings in another senario');
        $I->amOnPage('/');
        $I->dontSeeInUserAgent('iPhone OS');
        $I->dontSeeInUserAgent('Android');
    }
}
