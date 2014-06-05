Phpunit Extensions
==================

[![Build Status](https://travis-ci.org/clippings/phpunit-extensions.png?branch=master)](https://travis-ci.org/clippings/phpunit-extensions)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/clippings/phpunit-extensions/badges/quality-score.png)](https://scrutinizer-ci.com/g/clippings/phpunit-extensions/)
[![Code Coverage](https://scrutinizer-ci.com/g/clippings/phpunit-extensions/badges/coverage.png)](https://scrutinizer-ci.com/g/clippings/phpunit-extensions/)
[![Latest Stable Version](https://poser.pugx.org/clippings/phpunit-extensions/v/stable.png)](https://packagist.org/packages/clippings/phpunit-extensions)

Additional assertions and constraints for PHPUnit

Usage
-----

``assertArrayConstrained`` - is used to have a constriant for each entry in an array

```php
use CL\PHPUnitExtensions\Constraint\ConstrainArray;

class ExampleTest extends PHPUnit_Framework_TestCase
{
    use ConstrainArrayTrait;

    public function testTest()
    {
        $this->assertArrayConstrained(
            array('test' => $this->equalTo('12')),
            array('test' => 12)
        );
    }
}

```

License
-------

Copyright (c) 2014, Clippings Ltd. Developed by Ivan Kerin

Under BSD-3-Clause license, read LICENSE file.
