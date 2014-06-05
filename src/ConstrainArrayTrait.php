<?php

namespace CL\PHPUnitExtensions;

use SebastianBergmann\Comparator;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
trait ConstrainArrayTrait
{
    /**
     * Asserts that a condition is true.
     *
     * @param  boolean $condition
     * @param  string  $message
     * @throws PHPUnit_Framework_AssertionFailedError
     */
    public function assertArrayConstrained(array $constraints, array $array, $isStrict = true, $message = '')
    {
        Assert::assertArrayConstrained($constraints, $array, $isStrict, $message);
    }

    /**
     * Returns a Constraint/ConstrainArray matcher object.
     *
     * @return Constraint/ConstrainArray
     * @since  Method available since Release 3.3.0
     */
    public function constrainArray(array $constraints, $isStrict = true)
    {
        return Assert::constrainArray($constraints, $isStrict);
    }
}
