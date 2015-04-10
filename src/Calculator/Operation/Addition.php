<?php

namespace Calculator\Operation;

class Addition extends Operation
{
    public function solve()
    {
        return $this->left + $this->right;
    }
}
