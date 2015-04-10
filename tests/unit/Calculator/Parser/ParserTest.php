<?php

namespace Calculator\Parser;

use Calculator\Factory\OperationFactory;
use Codeception\Util\Stub;

class ParserTest extends \Codeception\TestCase\Test
{
    private $parse = null;

    public function _before()
    {
        $factory = Stub::make('Calculator\Factory\OperationFactory');
        $normalizer = Stub::make('Calculator\Parser\ExpressionNormalizer');
        $validator = Stub::make('Calculator\Parser\ExpressionValidator');

        $this->parser = new Parser($factory, $normalizer, $validator);
    }

    /**
     * @expectedException \Calculator\Exception\InvalidExpressionException
     * @expectedExceptionMessage Could not parse "5 + 5a": has invalid characters
     */
    public function testParsingThrowsExceptionOnInvalidExpr()
    {
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
