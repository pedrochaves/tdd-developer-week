<?php

namespace Calculator\Operation;

class Multiplication extends Operation
{
    public function solve()
    {
        return $this->left * $this->right;
    }
}
