<?php
/**
 *
 * Copyright 2018 ELASTIC Consultants Inc.
 *
 */

/**
 * Test mobile emulation automatically
 */
class AutoMobileEmulationCest
{

    public $mobileEmulation = true;

    /**
     * @param AcceptanceTester $I
     */
    public function tryMobileEmulation(AcceptanceTester $I)
    {
        $I->expect('start mobile emulation automatically');
        $I->amOnPage('/');
        $I->seeInUserAgent('iPhone OS');
        $I->expectsWindowSizeIs(375, 667);
        $I->expectsDevicePixcelRatioIs(2);
    }

    /**
     * @param AcceptanceTester $I
     */
    public function tryNotRevertEmulation(AcceptanceTester $I)
    {
        $I->expect("don't revert emulation settings in another senario");
        $I->amOnPage('/');
        $I->seeInUserAgent('iPhone OS');
        $I->expectsWindowSizeIs(375, 667);
        $I->expectsDevicePixcelRatioIs(2);
    }
}
