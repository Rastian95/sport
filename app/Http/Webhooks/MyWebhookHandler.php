<?php

namespace App\Http\Webhooks;

use App\Libraries\PrettyTable;
use App\Models\Event;
use DefStudio\Telegraph\DTO\User;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Facades\Log;

class MyWebhookHandler extends WebhookHandler
{

    public function nuevo(string $title): void
    {
        $event = Event::create([
            'title' => $title,
            'owner_chat_id' => $this->chat->id,
            'creator_chat_id' => $this->message->from()->id(),
            'active' => false,
            'isNewly' => true,
        ]);

        $table = new PrettyTable();
        $table->add_row("Partido {$event['title']}");

        if ($event->wasRecentlyCreated === true) {
            $this->chat->message('Partido Creado')->send();
            $message =  $this->chat->message($table->print())->send();
            $messageID = $message->telegraphMessageId();
            Log::debug("Telegraph message id $messageID", );
        } else {
            $this->chat->message('Hubo un error en la creación del partido, intente más tarde')->send();
        }
    }

    public function participo(): void
    {
        $name = $this->message->from()->firstName();
        $this->chat->message("OK. Que bueno que participes $name")->send();
    }

    public function hola()
    {
        $name = $this->message->from()->firstName();
        $this->chat->markdown("*Hola* $name, que bueno verte por aquí!")->send();
    }



    protected function handleChatMemberJoined(User $member): void
    {
        $this->chat->html("Bienvenido {$member->firstName()}")->send();
    }

    protected function handleUnknownCommand(\Illuminate\Support\Stringable $text): void
    {
        $this->chat->html("I can't understand your command: $text")->send();
    }

    protected function handleChatMessage($text): void
    {
        if ($text === 'mensaje') {
            $this->handleMensaje($text);
            return;
        }
    }

    protected function handleMensaje($text): void
    {
        $this->chat->html("Esto es un mensaje: $text")->send();
    }
}
