<?php

namespace Calculator\Factory;

use Calculator\Operation\Operator;

/**
 * Responsible for factoring Operation objects
 */
class OperationFactory
{
    /**
     * Factories an \Calculator\Operation\Operation based on the Operator passed
     *
     * @param  \Calculator\Operation\Operator $operator The operator to be factoried
     * @param  int   $left     The left member of the operation
     * @param  int   $right    The right member of the operation
     * @return \Calculator\Operation\Operation
     */
    public function factoryByOperator(Operator $operator, $left, $right)
    {
        $klass = ucfirst(strtolower($operator->getKey()));
        $class_name = 'Calculator\\Operation\\' . $klass;

        return new $class_name($left, $right);
    }
}
