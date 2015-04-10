<?php

namespace Event;

use DateTime;
use StdClass;

/**
 * @Entity
 * @Table(name="user_events")
 **/
class UserEvent
{
    /**
     * @Id
     * @Column(type="integer", nullable=false)
     * @GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @Column(type="string", length=32, nullable=false)
     */
    public $type;

    /**
     * @Column(type="object", nullable=false)
     */
    public $data;

    /**
     * @Column(type="datetime", nullable=false)
     */
    public $happened_at;

    public function __construct($type, StdClass $data)
    {
        $this->type = $type;
        $this->data = $data;
        $this->happened_at = new DateTime();
    }
}
