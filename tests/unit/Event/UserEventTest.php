<?php

namespace Event;

class UserEventTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function testUserEventConstructor()
    {
        $data = new \StdClass();
        $data->somedata = 'somevalue';

        $event = new UserEvent('click', $data);

        $this->assertNull($event->id);
        $this->assertEquals('click', $event->type);
        $this->assertEquals($data, $event->data);
        $this->assertInstanceOf('\DateTime', $event->happened_at);
    }

}
