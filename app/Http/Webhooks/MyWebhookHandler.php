<?php

namespace App\Http\Webhooks;

use App\Models\Event;
use DefStudio\Telegraph\DTO\User;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class MyWebhookHandler extends WebhookHandler
{
    protected function nuevo(User $member): void
    {
        $event = Event::create([
            'title' => '',
            'telegraph_chat_id' => $member->id(),
            'active' => false,
            'isNewly' => true,
        ]);
        if ($event->wasRecentlyCreated === true) {
            $this->chat->message('OK. Indicame el día y la hora')->send();
        } else {
            $this->chat->message('Hubo un error en la creación del partido, intente más tarde')->send();
        }
    }

    protected function handleChatMemberJoined(User $member): void
    {
        $this->chat->html("Bienvenido {$member->firstName()}")->send();
    }
}
