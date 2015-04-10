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
        $operation = $this->factory->factoryByOperator($type, 10, 20);

        $this->assertInstanceOf($class_name, $operation);
        $this->assertEquals(10, $operation->left);
        $this->assertEquals(20, $operation->right);
    }

    public function typesProvider()
    {
        return [
            'sum' => [Operator::ADDITION(), 'Calculator\Operation\Addition'],
            'subtraction' => [Operator::SUBTRACTION(), 'Calculator\Operation\Subtraction'],
            'multiplication' => [Operator::MULTIPLICATION(), 'Calculator\Operation\Multiplication'],
            'division' => [Operator::DIVISION(), 'Calculator\Operation\Division'],
        ];
    }
}
