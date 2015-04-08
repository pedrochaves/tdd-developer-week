<?php

namespace Calculator;

class EquationTest extends \Codeception\TestCase\Test
{
    public function testEquationReturnsZeroWithNoOperations()
    {
        $equation = new Equation();

        $this->assertEquals(0, $equation->solve());
    }

    /**
     * @dataProvider equationsProvider
     */
    public function testEquationSolving(array $operations, $result)
    {
        $equation = new Equation();
        foreach ($operations as $operation) {
            $equation->addOperation($operation);
        }

        $this->assertEquals($result, $equation->solve());
    }

    public function equationsProvider()
    {
        return [
            '1 + 2' => [
                [
                    new Operation\Sum(1, 2)
                ],
                3
            ],
            '1 - 2 + 2 - 3' => [
                [
                    new Operation\Subtraction(1, 2),
                    new Operation\Sum(2, 2),
                    new Operation\Subtraction(2, 3),
                ],
                -2
            ],
            '2 / 3 / 2 * 6 * 5' => [
                [
                    new Operation\Division(2, 3),
                    new Operation\Division(3, 2),
                    new Operation\Multiplication(2, 6),
                    new Operation\Multiplication(6, 5),
                ],
                10
            ],
            '4 * 2 + 2' => [
                [
                    new Operation\Multiplication(4, 2),
                    new Operation\Sum(2, 2),
                ],
                10
            ],
            '2 + 4 * 2' => [
                [
                    new Operation\Sum(2, 4),
                    new Operation\Multiplication(4, 2),
                ],
                10
            ],
            '2 + 2 * 2 - 2 / 2' => [
                [
                    new Operation\Sum(2, 2),
                    new Operation\Multiplication(2, 2),
                    new Operation\Subtraction(2, 2),
                    new Operation\Division(2, 2),
                ],
                5
            ],
            '1 + 2 * 3 - 4 / 2 * 6 - 8 / 2 + 9' => [
                [
                    new Operation\Sum(1, 2),
                    new Operation\Multiplication(2, 3),
                    new Operation\Subtraction(3, 4),
                    new Operation\Division(4, 2),
                    new Operation\Multiplication(2, 6),
                    new Operation\Subtraction(6, 8),
                    new Operation\Division(8, 2),
                    new Operation\Sum(2, 9),
                ],
                0
            ],
        ];
    }
}
