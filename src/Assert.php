<?php

namespace CL\PHPUnitExtensions;

use PHPUnit_Framework_Assert;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class Assert
{
    /**
     * Asserts that a condition is true.
     *
     * @param  PHPUnit_Framework_Constraint[]         $constraints
     * @param  array                                  $array
     * @param  string                                 $message
     * @throws PHPUnit_Framework_AssertionFailedError
     */
    public static function assertArrayConstrained(array $constraints, array $array, $isStrict = true, $message = '')
    {
        PHPUnit_Framework_Assert::assertThat($array, self::constrainArray($constraints, $isStrict), $message);
    }

    /**
     * Returns a Constraint\ConstrainArray matcher object.
     *
     * @return Constraint\ConstrainArray
     */
    public static function constrainArray(array $constraints, $isStrict = true)
    {
        return new Constraint\ConstrainArray($constraints, $isStrict);
    }
}
