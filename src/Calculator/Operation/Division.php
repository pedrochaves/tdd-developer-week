<?php

namespace Calculator\Operation;

class Division extends Operation
{
    public function solve()
    {
        if ($this->right === 0) {
            throw new \InvalidArgumentException('Can\'t divide by zero.');
        }

        return $this->left / $this->right;
    }
}
