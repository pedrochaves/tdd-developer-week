<?php

namespace Calculator\Operation;

abstract class Operation
{
    public $left = 0;

    public $right = 0;

    public function __construct($left, $right)
    {
        $this->left = $left;
        $this->right = $right;
    }

    abstract public function solve();
}
