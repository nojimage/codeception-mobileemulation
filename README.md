# WebDriver mobile emulation switcher for Codeception

<p align="center">
    <a href="LICENSE.txt" target="_blank">
        <img alt="Software License" src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square">
    </a>
    <a href="https://travis-ci.org/nojimage/codeception-mobileemulation" target="_blank">
        <img alt="Build Status" src="https://img.shields.io/travis/nojimage/codeception-mobileemulation/master.svg?style=flat-square">
    </a>
    <a href="https://packagist.org/packages/elstc/codeception-mobileemulation" target="_blank">
        <img alt="Latest Stable Version" src="https://img.shields.io/packagist/v/elstc/codeception-mobileemulation.svg?style=flat-square">
    </a>
</p>

This Codeception module can be able mobile emulation on browser. Currently support only `chrome` browser.

## Installation

You can install this plugin into your applicaion using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require --dev elstc/codeception-mobileemulation
```


Then enable this module in your test suite configration file (eg: `acceptance.suite.yml` and etc...):

```
modules:
    enabled:
        - MobileEmulation
        - WebDriver
```

See: [06-ModulesAndHelpers - Codeception - Documentation](http://codeception.com/docs/06-ModulesAndHelpers)

[IMPORTANT] `MobileEmulation` module should be load before `WebDriver` module.

## Usage

In your `Cest` test case, write `$mobileEmulation` property:

```(php)
class AwesomeCest
{
    public $mobileEmulation = true;

    // ...
}
```

When `$mobileEmulation = true`, within this testcase, mobile emulation is enabled.

And you can use `emulationMobile()` method:

```(php)
class AwesomeCest
{
    public function tryYourSenario($I)
    {
        // enable mobile emulation manually, (with specific device name)
        $I->emulationMobile('iPhone 8 Plus');
        // ...
    }
}
```

## Configuration options

#### `defaultDeviceName`

Default emulate device name.

default: `'iPhone 6'`
