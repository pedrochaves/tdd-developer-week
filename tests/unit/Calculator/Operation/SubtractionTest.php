<?php

namespace Calculator\Operation;

class SubtractionTest extends \Codeception\TestCase\Test
{
    public function testSubtraction()
    {
        $operation = new Subtraction(1, 2);

        $this->assertEquals(-1, $operation->solve());
    }
}
