<?php

namespace CL\PHPUnitExtensions\Constraint;

use PHPUnit_Framework_Constraint;
use PHPUnit_Util_InvalidArgumentHelper;

/**
 * @author    Ivan Kerin <ikerin@gmail.com>
 * @copyright 2014, Clippings Ltd.
 * @license   http://spdx.org/licenses/BSD-3-Clause
 */
class ConstrainArray extends PHPUnit_Framework_Constraint
{
    /**
     * @var PHPUnit_Framework_Constraint[]
     */
    protected $constraints = array();

    /**
     * @var boolean
     */
    protected $isStrict = true;

    /**
     * @param PHPUnit_Framework_Constraint[] $constraints
     */
    public function __construct(array $constraints, $isStrict = true)
    {
        parent::__construct();

        foreach ($constraints as $constraint) {
            if (! ($constraint instanceof PHPUnit_Framework_Constraint)) {
                throw PHPUnit_Util_InvalidArgumentHelper::factory(
                    1,
                    'array of PHPUnit_Framework_Constraint',
                    $constraint
                );
            }
        }

        if (! is_bool($isStrict)) {
            throw PHPUnit_Util_InvalidArgumentHelper::factory(2, 'bool', $isStrict);
        }

        $this->constraints = $constraints;
        $this->isStrict = $isStrict;
    }

    /**
     * Evaluates the constraint for parameter $other. Returns true if the
     * constraint is met, false otherwise.
     *
     * @param  mixed   $other
     * @return boolean
     */
    protected function matches($other)
    {
        foreach ($this->constraints as $key => $constraint) {
            if (! array_key_exists($key, $other)) {
                return false;
            }

            if (! $constraint->evaluate($other[$key], '', true)) {
                return false;
            }
        }

        if ($this->isStrict and array_diff_key($other, $this->constraints)) {
            return false;
        }

        return true;
    }

    public function count()
    {
        return count($this->constraints);
    }

    public function additionalFailureDescription($other)
    {
        $errors = [];

        foreach ($this->constraints as $key => $constraint) {
            if (! array_key_exists($key, $other)) {
                $errors []= sprintf("key '%s' does not exist", $key);
            } elseif (! $constraint->evaluate($other[$key], '', true)) {
                $errors []= sprintf("key %s: %s", $key, $constraint->failureDescription($other[$key]));
            }
        }

        if ($this->isStrict and ($diff = array_diff_key($other, $this->constraints))) {
            $errors []= sprintf("Unmached keys: %s", implode(', ', array_keys($diff)));
        }

        return "Errors:\n".implode("\n", $errors);
    }

    /**
     * @return string
     */
    public function toString()
    {
        return 'array matches constraints';
    }
}
