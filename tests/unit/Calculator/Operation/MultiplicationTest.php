<?php

namespace Calculator\Operation;

class MultiplicationTest extends \Codeception\TestCase\Test
{
    public function testMuliplication()
    {
        $operation = new Multiplication(5, 5);

        $this->assertEquals(25, $operation->solve());
    }
}
