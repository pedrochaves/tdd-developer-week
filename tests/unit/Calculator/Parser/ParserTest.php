<?php

namespace Calculator\Parser;

use Calculator\Factory\OperationFactory;

class ParserTest extends \Codeception\TestCase\Test
{
    private $parse = null;

    public function _before()
    {
        $factory = new OperationFactory();
        $normalizer = new ExpressionNormalizer();
        $validator = new ExpressionValidator();

        $this->parser = new Parser($factory, $normalizer, $validator);
    }

    public function testParsingThrowsExceptionOnInvalidExpr()
    {
        $this->setExpectedException(
            'Calculator\Exception\InvalidExpressionException',
            'Could not parse "5 + 5a": has invalid characters'
        );

        $this->parser->parse('5 + 5a');
    }

    /**
     * @dataProvider validExpressionsProvider
     */
    public function testParsing($expression, $expected_result)
    {
        $equation = $this->parser->parse($expression);

        $this->assertInstanceOf('Calculator\Equation', $equation);
        $this->assertEquals($expected_result, $equation->solve());
    }

    public function validExpressionsProvider()
    {
        return [
            'too simple' => ['20 + 10', 30],
            'simple' => ['20 + 10 * 3', 50],
            'complete' => ['100 * 4 + 20 / 2', 410],
            'posneg' => ['-5 + 5', 0],
            'first positive' => ['+50 + 5', 55],
            'sign inversion' => ['5 - -5 + -10', 0]
        ];
    }
}
