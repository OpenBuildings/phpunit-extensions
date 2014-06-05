<?php

namespace CL\PHPUnitExtensions\Test;

use CL\PHPUnitExtensions\Constraint\ConstrainArray;

/**
 * @coversDefaultClass CL\PHPUnitExtensions\ConstrainArrayTrait
 * @requires PHP 5.4
 */
class ConstrainArrayTraitTest extends AbstractTestCase
{
    /**
     * @covers ::constrainArray
     */
    public function testConstrainArray()
    {
        $test = new ConstrainArrayTraitTestCase();

        $expected = new ConstrainArray(array('test' => $this->equalTo('12')), false);

        $constrint = $test->constrainArray(array('test' => $this->equalTo('12')), false);

        $this->assertEquals($expected, $constrint);
    }

    /**
     * @covers ::assertArrayConstrained
     */
    public function testAssertArrayConstrained()
    {
        $test = new ConstrainArrayTraitTestCase();

        $test->assertArrayConstrained(array('test' => $this->equalTo('12')), array('test' => 12), false);
    }
}
