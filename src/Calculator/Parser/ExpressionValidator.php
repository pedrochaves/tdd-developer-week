<?php

namespace Calculator\Parser;

/**
 * Responsible for validating expressions
 */
class ExpressionValidator
{
    /**
     * A possible error message
     * @var string
     */
    private $error = null;

    /**
     * Validates an expression and sets an error message if is invalid
     * @param  string $expression The expression to be validated
     * @return bool
     */
    public function validate($expression)
    {
        if ($this->hasInvalidCharacters($expression)) {
            $this->setError('has invalid characters');

            return false;
        }

        if ($this->hasInvalidBeginning($expression)) {
            $this->setError('can only begin with a number, + or -');

            return false;
        }

        if ($this->hasInvalidEnding($expression)) {
            $this->setError('can only end with a number');

            return false;
        }

        $expression = str_replace(' ', null, $expression);
        if ($operator = $this->hasInvalidOperator($expression)) {
            $this->setError('invalid operator ' . $operator);

            return false;
        }

        return true;
    }

    /**
     * Validates invalid characters
     * @param  string  $expression The expression to be validated
     * @return boolean
     */
    private function hasInvalidCharacters($expression)
    {
        return preg_match('/[^\d\*\/\-\+\s]/', $expression);
    }

    /**
     * Validates the beginning of the expression
     * @param  string  $expression The expression to be validated
     * @return boolean
     */
    private function hasInvalidBeginning($expression)
    {
        return !preg_match('/^[\d\+\-]/', $expression);
    }

    /**
     * Validates the end of the expression
     * @param  string  $expression The expression to be validated
     * @return boolean
     */
    private function hasInvalidEnding($expression)
    {
        return !preg_match('/\d$/', $expression);
    }

    /**
     * Validates the operators of the expression
     * @param  string  $expression The expression to be validated
     * @return boolean
     */
    private function hasInvalidOperator($expression)
    {
        $invalid = ['-*', '-/', '*-', '/-', '+*', '+/', '*+', '*-', '/*', '*/', '**', '//'];
        foreach ($invalid as $operator) {
            if (strpos($expression, $operator) !== false) {
                return $operator;
            }
        }

        return false;
    }

    /**
     * Error setter
     * @param string $error The error
     */
    private function setError($error)
    {
        $this->error = $error;
    }

    /**
     * Returns the error message
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }
}
