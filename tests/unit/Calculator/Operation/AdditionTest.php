<?php

namespace Calculator\Operation;

class AdditionTest extends \Codeception\TestCase\Test
{
    public function testAddition()
    {
        $operation = new Addition(1, 2);

        $this->assertEquals(3, $operation->solve());
    }
}
