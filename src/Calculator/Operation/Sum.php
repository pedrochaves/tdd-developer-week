<?php

namespace Calculator\Operation;

class Sum extends Operation
{
    public function solve()
    {
        return $this->left + $this->right;
    }
}
