<?php

namespace Calculator\Factory;

use Calculator\Operation\Operator;

class OperationFactoryTest extends \Codeception\TestCase\Test
{
    private $factory = null;

    protected function _before()
    {
        $this->factory = new OperationFactory();
    }

    /**
     * @dataProvider typesProvider
     */
    public function testOperationFactory($type, $class_name)
    {
        $operation = $this->factory->factoryByOperator($type, 1, 1);

        $this->assertInstanceOf($class_name, $operation);
    }

    public function typesProvider()
    {
        return [
            'sum' => [Operator::SUM(), 'Calculator\Operation\Sum'],
            'subtraction' => [Operator::SUBTRACTION(), 'Calculator\Operation\Subtraction'],
            'multiplication' => [Operator::MULTIPLICATION(), 'Calculator\Operation\Multiplication'],
            'division' => [Operator::DIVISION(), 'Calculator\Operation\Division'],
        ];
    }
}
