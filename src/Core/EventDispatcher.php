<?php

namespace Nicolasfromerom\PruebaTecnica\Core;

class EventDispatcher {
    private array $listeners = [];

    public function subscribe(string $eventName, callable $listener): void {
        $this->listeners[$eventName][] = $listener;
    }

    public function dispatch(object $event): void {
        $eventName = get_class($event);

        if (!empty($this->listeners[$eventName])) {
            foreach ($this->listeners[$eventName] as $listener) {
                $listener($event);
            }
        }
    }
}
