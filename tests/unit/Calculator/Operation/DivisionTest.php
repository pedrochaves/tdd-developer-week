<?php

namespace Calculator\Operation;

class DivisionTest extends \Codeception\TestCase\Test
{
    public function testDivision()
    {
        $operation = new Division(100, 4);

        $this->assertEquals(25, $operation->solve());
    }

    public function testDivisionByZero()
    {
        $this->setExpectedException('InvalidArgumentException');

        $operation = new Division(100, 0);
        $operation->solve();
    }
}
