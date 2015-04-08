<?php

namespace Calculator\Operation;

class Subtraction extends Operation
{
    public function solve()
    {
        return $this->left - $this->right;
    }
}
