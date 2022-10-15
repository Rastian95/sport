<?php

namespace App\Http\Webhooks;

use App\Models\Event;
use DefStudio\Telegraph\DTO\User;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class MyWebhookHandler extends WebhookHandler
{

    public function nuevo(): void
    {
        $event = Event::create([
            'title' => '',
            'owner_chat_id' => $this->message->chat()->id(),
            'creator_chat_id' => $this->message->from()->id(),
            'isNewly' => true,
        ]);
        if ($event->wasRecentlyCreated === true) {
            $this->chat->message('OK. Indicame el día y la hora')->send();
        } else {
            $this->chat->message('Hubo un error en la creación del partido, intente más tarde')->send();
        }
    }

    public function participo(): void
    {
        $name = $this->message->from()->firstName();
        $this->chat->message("OK. Que bueno que participes $name")->send();
    }

    public function hola(string $userName)
    {
        $this->chat->markdown("*Hola* $userName, que bueno verte por aquí!")->send();
    }

    protected function handleChatMemberJoined(User $member): void
    {
        $this->chat->html("Bienvenido {$member->firstName()}")->send();
    }

    protected function handleUnknownCommand(\Illuminate\Support\Stringable $text): void
    {
        if (!self::$handleUnknownCommands) {
            parent::handleUnknownCommand($text);
        }

        $this->chat->html("I can't understand your command: $text")->send();
    }
}
