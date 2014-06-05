<?php

namespace CL\PHPUnitExtensions\Test\Constraint;

use CL\PHPUnitExtensions\Test\AbstractTestCase;
use CL\PHPUnitExtensions\Constraint\ConstrainArray;

/**
 * @coversDefaultClass CL\PHPUnitExtensions\Constraint\ConstrainArray
 */
class ConstrainArrayTest extends AbstractTestCase
{
    /**
     * @covers ::__construct
     * @covers ::count
     * @covers ::toString
     */
    public function testConstruct()
    {
        $constraint = new ConstrainArray(
            array('testKey' => $this->equalTo('test')),
            true
        );

        $this->assertEquals(1, $constraint->count());
        $this->assertEquals('array matches constraints', $constraint->toString());

        $constraint = new ConstrainArray(
            array('testKey' => $this->equalTo('test'), 'other' => $this->identicalTo('test')),
            true
        );

        $this->assertEquals(2, $constraint->count());

        $this->setExpectedException(
            'PHPUnit_Framework_Exception',
            'Argument #1 (integer#123)of CL\PHPUnitExtensions\Constraint\ConstrainArray::__construct() must be a array of PHPUnit_Framework_Constraint'
        );

        $constraint = new ConstrainArray(array('testKey' => 123));
    }

    /**
     * @covers ::__construct
     * @expectedException PHPUnit_Framework_Exception
     * @expectedExceptionMessage Argument #1 (integer#123)of CL\PHPUnitExtensions\Constraint\ConstrainArray::__construct() must be a array of PHPUnit_Framework_Constraint
     */
    public function testConstructArgument1()
    {
        $constraint = new ConstrainArray(array('testKey' => 123));
    }

    /**
     * @covers ::__construct
     * @expectedException PHPUnit_Framework_Exception
     * @expectedExceptionMessage Argument #2 (string#test)of CL\PHPUnitExtensions\Constraint\ConstrainArray::__construct() must be a bool
     */
    public function testConstructArgument2()
    {
        $constraint = new ConstrainArray(array(), 'test');
    }

    public function dataMatches()
    {
        return array(
            array(
                array('testKey' => $this->equalTo('test')),
                array('testKey' => 'test'),
                true,
                true
            ),
            array(
                array('testKey' => $this->equalTo('test')),
                array('testKey' => 'test21'),
                true,
                false
            ),
            array(
                array('testKey' => $this->equalTo('test')),
                array('testKey' => 'test', 'other' => 'key'),
                true,
                false
            ),
            array(
                array('testKey' => $this->equalTo('test')),
                array('testKey' => 'test', 'other' => 'key'),
                false,
                true
            ),
            array(
                array('testKey' => $this->equalTo('test'), 'other' => $this->greaterThan(20)),
                array('testKey' => 'test21', 'other' => 5),
                true,
                false
            ),
            array(
                array('testKey' => $this->equalTo('test'), 'other' => $this->greaterThan(20)),
                array('testKey' => 'test', 'other' => 100),
                true,
                true
            ),
            array(
                array('missing' => $this->equalTo('test'), 'other' => $this->greaterThan(20)),
                array('other' => 100),
                true,
                false
            ),
        );
    }

    /**
     * @dataProvider dataMatches
     * @covers ::matches
     */
    public function testMatches($constraints, $array, $isStrict, $expected)
    {
        $constraintArray = new ConstrainArray($constraints, $isStrict);

        $this->assertEquals($expected, $constraintArray->evaluate($array, '', true));
    }


    public function dataAdditionalFailureDescription()
    {
        return array(
            array(
                array('testKey' => $this->equalTo('test')),
                array('testKey' => 'test21'),
                true,
<<<ERROR_GENERAL
Errors:
key testKey: 'test21' is equal to <string:test>
ERROR_GENERAL
            ),
            array(
                array('testKey' => $this->equalTo('test')),
                array('testKey' => 'test', 'other' => 'key'),
                true,
<<<ERROR_UNMACHED_KEYS
Errors:
Unmached keys: other
ERROR_UNMACHED_KEYS
            ),
            array(
                array('testKey' => $this->equalTo('test'), 'other' => $this->greaterThan(20)),
                array('testKey' => 'test21', 'other' => 5),
                true,
<<<ERROR_GREATER_THAN
Errors:
key testKey: 'test21' is equal to <string:test>
key other: 5 is greater than 20
ERROR_GREATER_THAN
            ),
            array(
                array('missing' => $this->equalTo('test'), 'other' => $this->greaterThan(10)),
                array('other' => 20),
                true,
<<<ERROR_GREATER_THAN
Errors:
key 'missing' does not exist
ERROR_GREATER_THAN
            ),
        );
    }

    /**
     * @dataProvider dataAdditionalFailureDescription
     * @covers ::additionalFailureDescription
     */
    public function testAdditionalFailureDescription($constraints, $array, $isStrict, $expected)
    {
        $constraintArray = new ConstrainArray($constraints, $isStrict);

        $this->assertEquals($expected, $constraintArray->additionalFailureDescription($array));
    }
}
