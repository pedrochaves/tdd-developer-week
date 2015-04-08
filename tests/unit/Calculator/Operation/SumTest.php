<?php

namespace Calculator\Operation;

class SumTest extends \Codeception\TestCase\Test
{
    public function testSum()
    {
        $operation = new Sum(1, 2);

        $this->assertEquals(3, $operation->solve());
    }
}
