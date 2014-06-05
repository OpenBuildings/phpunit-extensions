<?php

namespace CL\PHPUnitExtensions\Test;

use CL\PHPUnitExtensions\Assert;
use CL\PHPUnitExtensions\Constraint;

/**
 * @coversDefaultClass CL\PHPUnitExtensions\Assert
 */
class AssertTest extends AbstractTestCase
{
    /**
     * @covers ::constrainArray
     */
    public function testConstrainArray()
    {
        $expected = new Constraint\ConstrainArray(array('test' => $this->equalTo('12')), false);

        $constrint = Assert::constrainArray(array('test' => $this->equalTo('12')), false);

        $this->assertEquals($expected, $constrint);
    }

    /**
     * @covers ::assertArrayConstrained
     */
    public function testAssertArrayConstrained()
    {
        Assert::assertArrayConstrained(array('test' => $this->equalTo('12')), array('test' => 12), false);
    }
}
