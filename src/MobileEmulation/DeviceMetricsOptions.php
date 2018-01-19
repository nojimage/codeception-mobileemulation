<?php
/**
 *
 * Copyright 2018 ELASTIC Consultants Inc.
 *
 */

namespace Codeception\Module\MobileEmulation;

use InvalidArgumentException;
use RangeException;

/**
 * DeviceMetrics Options
 */
class DeviceMetricsOptions
{

    /**
     * @var int
     */
    private $width = 375;

    /**
     * @var int
     */
    private $height = 667;

    /**
     * @var float
     */
    private $pixelRatio = 2.0;

    /**
     * construct
     *
     * @param int $width
     * @param int $height
     * @param float $pixelRatio
     */
    public function __construct($width, $height, $pixelRatio)
    {
        $this->setWidth($width);
        $this->setHeight($height);
        $this->setPixelRaio($pixelRatio);
    }

    /**
     * @param int $width
     */
    public function setWidth($width)
    {
        if ($width < 1) {
            throw new RangeException('Device width greater than 1.');
        }
        $this->width = (int)$width;
    }

    /**
     * @param int $height
     */
    public function setHeight($height)
    {
        if ($height < 1) {
            throw new RangeException('Device height greater than 1.');
        }
        $this->height = (int)$height;
    }

    /**
     * @param int $pixelRatio
     */
    public function setPixelRaio($pixelRatio)
    {
        if ($pixelRatio < 1) {
            throw new RangeException('Device pixel ratio greater than 1.');
        }
        $this->pixelRatio = (float)$pixelRatio;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'width' => $this->width,
            'height' => $this->height,
            'pixelRatio' => $this->pixelRatio,
        ];
    }

    /**
     * create from array
     *
     * @param array $options
     * @return DeviceMetricsOptions
     */
    public static function fromArray(array $options)
    {
        foreach (['width', 'height', 'pixelRatio'] as $key) {
            if (!isset($options[$key])) {
                throw new InvalidArgumentException('$options required ' . $key);
            }
        }

        return new self($options['width'], $options['height'], $options['pixelRatio']);
    }
}
