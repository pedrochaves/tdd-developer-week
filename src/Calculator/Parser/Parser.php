<?php

namespace Calculator\Parser;

use Calculator\Equation;
use Calculator\Exception\InvalidExpressionException;
use Calculator\Factory\OperationFactory;
use Calculator\Operation\Operator;

/**
 * A calculator parser
 */
class Parser
{
    /**
     * The OperationFactory object
     * @var \Calculator\Factory\OperationFactory
     */
    private $factory = null;

    /**
     * The ExpressionNormalizer object
     * @var \Calculator\Parser\ExpressionNormalizer
     */
    private $normalizer = null;

    /**
     * The ExpressionValidator object
     * @var \Calculator\Parser\ExpressionValidator
     */
    private $validator = null;

    public function __construct(
        OperationFactory $factory,
        ExpressionNormalizer $normalizer,
        ExpressionValidator $validator
    ) {
        $this->factory = $factory;
        $this->normalizer = $normalizer;
        $this->validator = $validator;
    }

    /**
     * Returns an Equation based on the expression
     * @param  string $expression A mathmatical expression
     * @return \Calculator\Equation
     * @throws \InvalidArgumentException If the expression is somehow invalid
     */
    public function parse($expression)
    {
        if (!$this->validator->validate($expression)) {
            throw new InvalidExpressionException($this->validator->getError(), $expression);
        }

        $expression = $this->normalizer->normalize($expression);

        $members = $this->parseMembers($expression);
        $operations = $this->getOperationsFromMembers($members);

        return $this->createEquation($operations);
    }

    /**
     * Breaks the expression into members and returns each one of them in an array
     * @param  string $expression The raw expression
     * @return array
     */
    private function parseMembers($expression)
    {
        // Return only the members
        $members = explode(' ', $expression);
        $members = array_map(function($member) {
            return trim($member);
        }, $members);

        return $members;
    }

    /**
     * Returns the Calculator\Operation instances need to form the equation
     * @param  array  $members The members
     * @return array An array of Calculator\Operation instances
     */
    private function getOperationsFromMembers(array $members)
    {
        $operations = [];
        $op_counter = 0;
        foreach ($members as $i => $member) {
            if (is_numeric($member)) {
                // Save the first number for next iteraction
                if ($i === 0) {
                    $left = $member;
                } else {
                    // The last one was an operation, so this is the right of the operation
                    $operations[$op_counter]->right = $member;
                    // And is the left of the next
                    $left = $member;

                    $op_counter++;
                }
            } else {
                $operator = new Operator($member);

                $operations[$op_counter] = $this->factory->factoryByOperator($operator, $left, 0);
            }
        }

        return $operations;
    }

    /**
     * Creates the equation with all the operations parsed
     * @param  array  $operations The operations of the equation
     * @return Calculator\Operation
     */
    private function createEquation(array $operations)
    {
        return new Equation(...$operations);
    }
}
