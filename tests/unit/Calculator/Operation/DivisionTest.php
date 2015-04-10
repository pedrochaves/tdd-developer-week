<?php

namespace Calculator\Operation;

class DivisionTest extends \Codeception\TestCase\Test
{
    public function testDivision()
    {
        $operation = new Division(100, 4);

        $this->assertEquals(25, $operation->solve());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Can't divide by zero
     */
    public function testDivisionByZero()
    {
        $operation = new Division(100, 0);
        $operation->solve();
    }
}
