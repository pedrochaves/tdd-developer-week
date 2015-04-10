<?php

namespace Calculator;

use Codeception\Util\Stub;

class EquationTest extends \Codeception\TestCase\Test
{
    /**
     * @dataProvider equationsProvider
     */
    public function testEquationSolving(array $operations, $result)
    {
        $equation = new Equation(...$operations);

        $this->assertEquals($result, $equation->solve());
    }

    public function equationsProvider()
    {
        return [
            'no operations' => [
                [],
                0
            ],
            '1 + 2' => [
                [
                    Stub::construct('Calculator\Operation\Addition', [1, 2])
                ],
                3
            ],
            '1 - 2 + 2 - 3' => [
                [
                    Stub::construct('Calculator\Operation\Subtraction', [1, 2]),
                    Stub::construct('Calculator\Operation\Addition', [2, 2]),
                    Stub::construct('Calculator\Operation\Subtraction', [2, 3])
                ],
                -2
            ],
            '2 / 3 / 2 * 6 * 5' => [
                [
                    Stub::construct('Calculator\Operation\Division', [2, 3]),
                    Stub::construct('Calculator\Operation\Division', [3, 2]),
                    Stub::construct('Calculator\Operation\Multiplication', [2, 6]),
                    Stub::construct('Calculator\Operation\Multiplication', [6, 5]),
                ],
                10
            ],
            '4 * 2 + 2' => [
                [
                    Stub::construct('Calculator\Operation\Multiplication', [4, 2]),
                    Stub::construct('Calculator\Operation\Addition', [2, 2])
                ],
                10
            ],
            '2 + 4 * 2' => [
                [
                    Stub::construct('Calculator\Operation\Addition', [2, 4]),
                    Stub::construct('Calculator\Operation\Multiplication', [4, 2]),
                ],
                10
            ],
            '2 + 2 * 2 - 2 / 2' => [
                [
                    Stub::construct('Calculator\Operation\Addition', [2, 2]),
                    Stub::construct('Calculator\Operation\Multiplication', [2, 2]),
                    Stub::construct('Calculator\Operation\Subtraction', [2, 2]),
                    Stub::construct('Calculator\Operation\Division', [2, 2])
                ],
                5
            ],
            '1 + 2 * 3 - 4 / 2 * 6 - 8 / 2 + 9' => [
                [
                    Stub::construct('Calculator\Operation\Addition', [1, 2]),
                    Stub::construct('Calculator\Operation\Multiplication', [2, 3]),
                    Stub::construct('Calculator\Operation\Subtraction', [3, 4]),
                    Stub::construct('Calculator\Operation\Division', [4, 2]),
                    Stub::construct('Calculator\Operation\Multiplication', [2, 6]),
                    Stub::construct('Calculator\Operation\Subtraction', [6, 8]),
                    Stub::construct('Calculator\Operation\Division', [8, 2]),
                    Stub::construct('Calculator\Operation\Addition', [2, 9])
                ],
                0
            ],
        ];
    }
}
