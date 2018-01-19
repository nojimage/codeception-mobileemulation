<?php

/**
 *
 * Copyright 2018 ELASTIC Consultants Inc.
 *
 */
use Codeception\Module\MobileEmulation\DeviceMetricsOptions;
use Codeception\Module\MobileEmulation\MobileEmulationOptions;
use Codeception\Test\Unit;

/**
 * MobileEmulationOptions Test
 */
class MobileEmulationOptionsTest extends Unit
{

    /**
     * @var UnitTester
     */
    protected $tester;

    /**
     * @covers MobileEmulationOptions::__construct()
     */
    public function testConstruct()
    {
        $option = new MobileEmulationOptions('iPhone 6');

        $this->tester->assertSame([
            'deviceName' => 'iPhone 6',
        ], $option->toArray());
    }

    /**
     * @covers MobileEmulationOptions::__construct()
     */
    public function testConstructWithUserAgent()
    {
        $option = new MobileEmulationOptions('iPhone 6', 'Custom UserAgent');

        $this->tester->assertSame([
            'userAgent' => 'Custom UserAgent',
        ], $option->toArray());
    }

    /**
     * @covers MobileEmulationOptions::__construct()
     */
    public function testConstructWithDeviceMetrics()
    {
        $option = new MobileEmulationOptions('iPhone 6', null, new DeviceMetricsOptions(360, 640, 3.0));

        $this->tester->assertSame([
            'deviceMetrics' => [
                'width' => 360,
                'height' => 640,
                'pixelRatio' => 3.0,
            ],
        ], $option->toArray());
    }

    /**
     * @covers MobileEmulationOptions::__construct()
     */
    public function testConstructWithUserAgentAndDeviceMetrics()
    {
        $option = new MobileEmulationOptions('iPhone 6', 'Custom UserAgent', new DeviceMetricsOptions(360, 640, 3.0));

        $this->tester->assertSame([
            'userAgent' => 'Custom UserAgent',
            'deviceMetrics' => [
                'width' => 360,
                'height' => 640,
                'pixelRatio' => 3.0,
            ],
        ], $option->toArray());
    }

    /**
     * @covers MobileEmulationOptions::fromArray()
     */
    public function testFromArray()
    {
        $option = MobileEmulationOptions::fromArray([
            'deviceName' => 'iPhone 6',
        ]);

        $this->tester->assertSame([
            'deviceName' => 'iPhone 6',
        ], $option->toArray());

        //
        $optionWithUserAgent = MobileEmulationOptions::fromArray([
            'userAgent' => 'Custom UserAgent',
        ]);

        $this->tester->assertSame([
            'userAgent' => 'Custom UserAgent',
        ], $optionWithUserAgent->toArray());

        //
        $optionWithDeviceMetrics = MobileEmulationOptions::fromArray([
            'deviceMetrics' => [
                'width' => 360,
                'height' => 640,
                'pixelRatio' => 3.0,
            ],
        ]);

        $this->tester->assertSame([
            'deviceMetrics' => [
                'width' => 360,
                'height' => 640,
                'pixelRatio' => 3.0,
            ],
        ], $optionWithDeviceMetrics->toArray());

        //
        $optionWithUserAgentAndDeviceMetrics = MobileEmulationOptions::fromArray([
            'deviceName' => 'iPhone 6',
            'userAgent' => 'Custom UserAgent',
            'deviceMetrics' => [
                'width' => 360,
                'height' => 640,
                'pixelRatio' => 3.0,
            ],
        ]);

        $this->tester->assertSame([
            'userAgent' => 'Custom UserAgent',
            'deviceMetrics' => [
                'width' => 360,
                'height' => 640,
                'pixelRatio' => 3.0,
            ],
        ], $optionWithUserAgentAndDeviceMetrics->toArray());
    }

    /**
     * @covers MobileEmulationOptions::withDeviceName()
     */
    public function testWithDeviceName()
    {
        $option = MobileEmulationOptions::withDeviceName('iPhone 6');

        $this->tester->assertSame([
            'deviceName' => 'iPhone 6',
        ], $option->toArray());
    }

    /**
     * @covers MobileEmulationOptions::withUserAgent()
     */
    public function testWithUserAgent()
    {
        $option = MobileEmulationOptions::withUserAgent('Custom UserAgent');

        $this->tester->assertSame([
            'userAgent' => 'Custom UserAgent',
        ], $option->toArray());
    }

    /**
     * @covers MobileEmulationOptions::withDeviceMetrics()
     */
    public function testWithDeviceMetrics()
    {
        $option = MobileEmulationOptions::withDeviceMetrics(new DeviceMetricsOptions(360, 640, 3.0));

        $this->tester->assertSame([
            'deviceMetrics' => [
                'width' => 360,
                'height' => 640,
                'pixelRatio' => 3.0,
            ],
        ], $option->toArray());

        $optionFromArray = MobileEmulationOptions::withDeviceMetrics([
            'width' => 375,
            'height' => 667,
            'pixelRatio' => 2.0,
        ]);

        $this->tester->assertSame([
            'deviceMetrics' => [
                'width' => 375,
                'height' => 667,
                'pixelRatio' => 2.0,
            ],
        ], $optionFromArray->toArray());
    }

    /**
     * test for set methods
     */
    public function testSetter()
    {
        // set deviceName
        $option = new MobileEmulationOptions();
        $option->setDeviceName('iPhone 7 Plus');

        $this->tester->assertSame([
            'deviceName' => 'iPhone 7 Plus',
        ], $option->toArray());

        // override userAgent
        $option->setUserAgent('Custom UserAgent');

        $this->tester->assertSame([
            'userAgent' => 'Custom UserAgent',
        ], $option->toArray());

        // append deviceMetircs
        $option->setDeviceMetrics(new DeviceMetricsOptions(360, 640, 3.0));

        $this->tester->assertSame([
            'userAgent' => 'Custom UserAgent',
            'deviceMetrics' => [
                'width' => 360,
                'height' => 640,
                'pixelRatio' => 3.0,
            ],
        ], $option->toArray());

        // override deviceName
        $option->setDeviceName('iPhone 6');

        $this->tester->assertSame([
            'deviceName' => 'iPhone 6',
        ], $option->toArray());
    }
}
