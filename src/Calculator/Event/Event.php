<?php

namespace PlanetExpat\Event;

interface Event {
    public function getName();
    public function setValue(array $value);
    public function getValue();
}
