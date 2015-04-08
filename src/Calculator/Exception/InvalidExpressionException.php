<?php

namespace Calculator\Exception;

/**
 * To be thrown when we have an invalid expression
 */
class InvalidExpressionException extends \InvalidArgumentException
{
    public function __construct($message, $expression)
    {
        $template = 'Could not parse "%s": %s';

        parent::__construct(sprintf($template, $expression, $message));
    }
}
