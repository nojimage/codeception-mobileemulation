<?php

/**
 *
 * Copyright 2018 ELASTIC Consultants Inc.
 *
 */
use Codeception\Module\MobileEmulation\DeviceMetricsOptions;
use Codeception\Test\Unit;

/**
 * DeviceMetricsOptions Test
 */
class DeviceMetricsOptionsTest extends Unit
{

    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @covers DeviceMetricsOptions::__construct()
     */
    public function testConstruct()
    {
        $option = new DeviceMetricsOptions(320, 480, 2);

        $this->tester->assertSame([
            'width' => 320,
            'height' => 480,
            'pixelRatio' => 2.0,
            ], $option->toArray());
    }

    /**
     * @covers DeviceMetricsOptions::fromArray()
     */
    public function testFromArray()
    {
        $option = DeviceMetricsOptions::fromArray([
                'width' => 320,
                'height' => 480,
                'pixelRatio' => 2,
        ]);

        $this->tester->assertSame([
            'width' => 320,
            'height' => 480,
            'pixelRatio' => 2.0,
            ], $option->toArray());
    }

    /**
     * test for set methods
     */
    public function testSetter()
    {
        $option = new DeviceMetricsOptions(320, 480, 2);
        $option->setWidth(360);
        $option->setHeight(640);
        $option->setPixelRaio(3.0);

        $this->tester->assertSame([
            'width' => 360,
            'height' => 640,
            'pixelRatio' => 3.0,
            ], $option->toArray());
    }
}
