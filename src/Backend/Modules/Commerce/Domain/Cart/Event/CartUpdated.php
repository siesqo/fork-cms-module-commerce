<?php

namespace Backend\Modules\Commerce\Domain\Cart\Event;

final class CartUpdated extends Event
{
    /**
     * @var string The name the listener needs to listen to to catch this event.
     */
    const EVENT_NAME = 'commerce.event.cart.updated';
}