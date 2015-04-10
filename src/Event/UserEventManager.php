<?php

namespace Event;

use Doctrine\ORM\EntityManagerInterface;

class UserEventManager
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function saveEquationSolving($expression, $result)
    {
        $evt_data = (object) [
            'expr' => $expression,
            'result' => $result
        ];

        $event = new UserEvent('equation.solving', $evt_data);

        return $this->save($event);
    }

    public function saveEquationError($expression, $message)
    {
        $evt_data = (object) [
            'expr' => $expression,
            'message' => $message
        ];

        $event = new UserEvent('equation.error', $evt_data);

        return $this->save($event);
    }

    private function save(UserEvent $event)
    {
        $this->em->persist($event);
        $this->em->flush();

        return $event;
    }
}
