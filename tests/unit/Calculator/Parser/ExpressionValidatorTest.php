<?php

namespace Calculator\Parser;

class ExpressionValidatorTest extends \Codeception\TestCase\Test
{
    /**
     * @dataProvider validExpressionsProvider
     */
    public function testValidExpressionValidation($expression)
    {
        $validator = new ExpressionValidator();

        $this->assertEquals(true, $validator->validate($expression));
        $this->assertNull($validator->getError());
    }

    public function validExpressionsProvider()
    {
        return [
            ['-5--5'],
            ['+5-+5'],
            ['-5+-7'],
            ['+5++7'],
            ['2+5*7/5'],
        ];
    }

    /**
     * @dataProvider invalidExpressionsProvider
     */
    public function testInvalidExpressionValidation($expression, $message)
    {
        $validator = new ExpressionValidator();

        $this->assertEquals(false, $validator->validate($expression));
        $this->assertEquals($message, $validator->getError());
    }

    public function invalidExpressionsProvider()
    {
        return [
            // Only numbers, spaces and + - * / are valid
            ['(5 + 5a)', 'has invalid characters'],
            // Can only begin with +, - or a number
            ['*1 + 1', 'can only begin with a number, + or -'],
            // Can only finish with a number
            ['1 + 1 *', 'can only end with a number'],
            // Invalid operator
            ['1 +/ 1', 'invalid operator +/']
        ];
    }
}
