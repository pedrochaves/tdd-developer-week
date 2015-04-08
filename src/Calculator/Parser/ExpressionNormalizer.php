<?php

namespace Calculator\Parser;

use Calculator\Exception\InvalidExpressionException;

/**
 * Responsible for normalizing the expressions for the parser
 */
class ExpressionNormalizer
{
    /**
     * Normalizes the expression
     * @return string The expression expression
     */
    public function normalize($expression)
    {
        // First we remove spaces to normalize stuff
        $expression = str_replace(' ', null, $expression);
        // Positive/negative inversions
        $expression = str_replace(
            ['--', '++', '-+', '+-'],
            ['+', '+', '-', '-'],
            $expression
        );

        // Remove the useless plus in the beginning
        if ($expression[0] === '+') {
            $expression = substr($expression, 1);
        }

        // Then we put spaces around the numbers
        $expression = preg_replace('/(\d+)/', ' $1 ', $expression);
        // Clean it up
        $expression = trim($expression);

        // In case the expression starts with a -, this normalizes the space
        // that stands between the - and the number
        if (substr($expression, 0, 2) == '- ') {
            $expression = '-' . substr($expression, 2);
        }

        return $expression;
    }
}
