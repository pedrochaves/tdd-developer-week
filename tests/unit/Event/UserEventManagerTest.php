<?php

namespace Event;

use Codeception\Util\Stub;

class UserEventManagerTest extends \Codeception\TestCase\Test
{
    protected $tester;

    private $manager;

    public function _before()
    {
        $methods = [
            'persist' => Stub::once(function(UserEvent $event) {
                $event->id = 1;

                return $event;
            }),
            'flush' => Stub::once(function() {
                return null;
            })
        ];

        $em = Stub::make('Doctrine\ORM\EntityManager', $methods, $this);

        $this->manager = new UserEventManager($em);
    }

    public function testEventEquationSolving()
    {
        $event = $this->manager->saveEquationSolving('2 + 2', 4);

        $this->assertSame(1, $event->id);
        $this->assertSame('equation.solving', $event->type);
        $this->assertSame('2 + 2', $event->data->expr);
        $this->assertSame(4, $event->data->result);
        $this->assertInstanceOf('\DateTime', $event->happened_at);
    }

    public function testEventEquationError()
    {
        $event = $this->manager->saveEquationError('a + b', 'Error message');

        $this->assertSame(1, $event->id);
        $this->assertSame('equation.error', $event->type);
        $this->assertSame('a + b', $event->data->expr);
        $this->assertSame('Error message', $event->data->message);
        $this->assertInstanceOf('\DateTime', $event->happened_at);
    }
}
