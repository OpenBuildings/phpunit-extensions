<?php

namespace CL\PHPUnitExtensions\Test;

use CL\PHPUnitExtensions\ConstrainArrayTrait;
use CL\PHPUnitExtensions\Constraint\ConstrainArray;

/**
 * @coversDefaultClass CL\PHPUnitExtensions\ConstrainArrayTrait
 * @requires PHP 5.4
 */
class ConstrainArrayTraitTest extends AbstractTestCase
{
    use ConstrainArrayTrait;

    /**
     * @covers ::constrainArray
     */
    public function testConstrainArray()
    {
        $expected = new ConstrainArray(array('test' => $this->equalTo('12')), false);

        $constrint = $this->constrainArray(array('test' => $this->equalTo('12')), false);

        $this->assertEquals($expected, $constrint);
    }

    /**
     * @covers ::assertArrayConstrained
     */
    public function testAssertArrayConstrained()
    {
        $this->assertArrayConstrained(array('test' => $this->equalTo('12')), array('test' => 12), false);
    }
}
