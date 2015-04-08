<?php

namespace Calculator;

use Calculator\Operation\Operation;
use Calculator\Operation\Subtraction;
use Calculator\Operation\Sum;

class Equation
{
    private $operations = [];

    public function addOperation(Operation $operation)
    {
        $this->operations[] = $operation;
    }

    public function solve()
    {
        $operations = array_merge($this->operations);
        $len = count($operations);
        // Nothing to do here
        if ($len === 0) {
            return 0;
        }

        // A simple equation, like 2 + 2
        if ($len === 1) {
            return $operations[0]->solve();
        }

        // First, we solve the multiplications and divisions
        $previous = -1;
        $next = 0;
        for ($current = 0; $current < $len; $current++) {
            // If there is only one operation we can return the result
            if (count($operations) === 1) {
                return $operations[$current]->solve();
            }

            $next++;
            $operation = $operations[$current];
            if ($operation instanceof Subtraction || $operation instanceof Sum) {
                $previous = $current;

                continue;
            }

            // If it's the first one, the next one gets the result
            if ($current === 0) {
                $operations[$next]->left = $operation->solve();
            } elseif ($current === $len - 1 && $previous > -1) {
                // If it's the last, the one before gets the result
                $operations[$previous]->right = $operation->solve();
            } else {
                // If it's in the middle, the two surrounding them get the result
                if ($previous > -1) {
                    $operations[$previous]->right = $operation->solve();
                }

                if ($next < $len) {
                    $operations[$next]->left = $operation->solve();
                }
            }

            unset($operations[$current]);
        }

        // Solving the ones that are left (only sums and subtractions)
        $operations = array_values($operations);
        $len = count($operations);
        for ($i = 0; $i < $len - 1; $i++) {
            $operations[$i + 1]->left = $operations[$i]->solve();
        }

        // The last one has every result accumulated in them
        return $operations[$len - 1]->solve();
    }
}
