<?php

namespace Backend\Modules\Commerce\Domain\Country\Event;

final class Deleted extends Event
{
    /**
     * @var string The name the listener needs to listen to to catch this event.
     */
    const EVENT_NAME = 'commerce.event.country.deleted';
}