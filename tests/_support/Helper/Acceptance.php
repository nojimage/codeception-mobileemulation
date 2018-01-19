<?php

namespace Helper;

/**
 * Acceptance Helper
 */
class Acceptance extends \Codeception\Module
{

    /**
     * Get window size
     *
     * @return array [width, height, devicePixelRatio]
     */
    public function grabWindowSize()
    {
        return $this->getModule('WebDriver')->executeJS('return [window.innerWidth, window.innerHeight, window.devicePixelRatio];');
    }

    /**
     * Get user agent
     *
     * @return string
     */
    public function grabUserAgent()
    {
        return $this->getModule('WebDriver')->executeJS('return navigator.userAgent;');
    }

    /**
     * assert window size
     *
     * @return array [width, height]
     */
    public function expectsWindowSizeIs($width, $height)
    {
        $expected = [$width, $height];
        $actual = array_slice($this->grabWindowSize(), 0, 2);

        return $this->assertSame($expected, $actual);
    }

    /**
     * assert pixel ratio
     *
     * @return array [width, height]
     */
    public function expectsDevicePixcelRatioIs($raito)
    {
        list($width, $height, $devicePixelRatio) = $this->grabWindowSize();

        return $this->assertSame($raito, $devicePixelRatio);
    }

    /**
     * assert user agent
     *
     * @param string $text
     * @return bool
     */
    public function seeInUserAgent($text)
    {
        $this->assertContains($text, $this->grabUserAgent());
    }

    /**
     * assert user agent
     *
     * @param string $text
     * @return bool
     */
    public function dontSeeInUserAgent($text)
    {
        $this->assertNotContains($text, $this->grabUserAgent());
    }
}
