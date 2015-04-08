<?php

namespace Calculator\Parser;

class ExpressionNormalizerTest extends \Codeception\TestCase\Test
{
    /**
     * @dataProvider validExpressionsProvider
     */
    public function testValidExpressionNormalization($expression, $expected)
    {
        $normalizer = new ExpressionNormalizer();
        $expression = $normalizer->normalize($expression);

        $this->assertEquals($expected, $expression);
    }

    public function validExpressionsProvider()
    {
        return [
            ['-5--5', '-5 + 5'],
            ['+5-+5', '5 - 5'],
            ['-5+-7', '-5 - 7'],
            ['+5++7', '5 + 7'],
            [' 2+5     *7/5', '2 + 5 * 7 / 5'],
        ];
    }
}
