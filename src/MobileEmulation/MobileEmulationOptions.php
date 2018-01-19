<?php
/**
 *
 * Copyright 2018 ELASTIC Consultants Inc.
 *
 */

namespace Codeception\Module\MobileEmulation;

use Codeception\Module\MobileEmulation\DeviceMetricsOptions;
use UnexpectedValueException;

/**
 * MobileEmulation Option
 */
class MobileEmulationOptions
{

    /**
     * @var string
     */
    private $deviceName;

    /**
     * @var string
     */
    private $userAgent;

    /**
     * @var DeviceMetricsOptions
     */
    private $deviceMetrics;

    /**
     * constructor
     *
     * @param string $deviceName
     * @param string $userAgent
     * @param DeviceMetricsOptions $deviceMetrics
     */
    public function __construct($deviceName = null, $userAgent = null, DeviceMetricsOptions $deviceMetrics = null)
    {
        $this->setDeviceName($deviceName);
        if ($userAgent) {
            $this->setUserAgent($userAgent);
        }
        if ($deviceMetrics) {
            $this->setDeviceMetrics($deviceMetrics);
        }
    }

    /**
     * @param string $deviceName
     */
    public function setDeviceName($deviceName)
    {
        $this->deviceName = $deviceName;
        if ($this->userAgent) {
            $this->userAgent = null;
        }
        if ($this->deviceMetrics) {
            $this->deviceMetrics = null;
        }
    }

    /**
     * @param string $userAgent
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = $userAgent;
        if ($this->deviceName) {
            $this->deviceName = null;
        }
    }

    /**
     * @param DeviceMetricsOptions $deviceMetrics
     */
    public function setDeviceMetrics(DeviceMetricsOptions $deviceMetrics)
    {
        $this->deviceMetrics = $deviceMetrics;
        if ($this->deviceName) {
            $this->deviceName = null;
        }
    }

    /**
     * convert to array
     *
     * @return array
     * @throws UnexpectedValueException when empty options.
     */
    public function toArray()
    {
        $options = [];

        if (isset($this->userAgent)) {
            $options['userAgent'] = $this->userAgent;
        }
        if (isset($this->deviceMetrics)) {
            $options['deviceMetrics'] = $this->deviceMetrics->toArray();
        }

        if (empty($options) && isset($this->deviceName)) {
            $options = [
                'deviceName' => $this->deviceName
            ];
        }

        if (empty($options)) {
            throw new UnexpectedValueException('MobileEmutationOptions not setup correctly.');
        }

        return $options;
    }

    /**
     * create from array
     *
     * @param array $options
     * @return MobileEmulationOptions
     */
    public static function fromArray(array $options)
    {
        $mobileEmulation = new self();

        if (isset($options['deviceName'])) {
            $mobileEmulation->setDeviceName($options['deviceName']);
        }

        if (isset($options['userAgent'])) {
            $mobileEmulation->setUserAgent($options['userAgent']);
        }

        if (isset($options['deviceMetrics'])) {
            $devicceMetrics = is_array($options['deviceMetrics'])
                ? DeviceMetricsOptions::fromArray($options['deviceMetrics'])
                : $devicceMetrics;
            $mobileEmulation->setDeviceMetrics($devicceMetrics);
        }

        return $mobileEmulation;
    }

    /**
     * create with deviceName
     *
     * @param string $deviceName
     * @return MobileEmulationOptions
     */
    public static function withDeviceName($deviceName)
    {
        return new self($deviceName);
    }

    /**
     * create with userAgent
     *
     * @param string $userAgent
     * @return MobileEmulationOptions
     */
    public static function withUserAgent($userAgent)
    {
        return new self(null, $userAgent);
    }

    /**
     * create with deviceMetrics
     *
     * @param mixed $deviceMetrics
     * @return MobileEmulationOptions
     */
    public static function withDeviceMetrics($deviceMetrics)
    {
        if (is_array($deviceMetrics)) {
            $deviceMetrics = DeviceMetricsOptions::fromArray($deviceMetrics);
        }

        return new self(null, null, $deviceMetrics);
    }
}
