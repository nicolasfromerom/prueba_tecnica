<?php

namespace Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Application\EventHandler;

use Nicolasfromerom\PruebaTecnica\TechnicalTestContext\User\Domain\Events\UserRegisteredEvent;

class SendWelcomeEmailHandler {
    public function handle(UserRegisteredEvent $event): void {
        $user = $event->getUser();
        echo json_encode(["message" => "Welcome email sent to " . $user->getEmail()]);
    }
}
