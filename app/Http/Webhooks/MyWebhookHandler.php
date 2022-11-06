<?php

namespace App\Http\Webhooks;

use App\Libraries\PrettyTable;
use App\Models\Event;
use App\Models\Player;
use DefStudio\Telegraph\DTO\User;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class MyWebhookHandler extends WebhookHandler
{

    public function nuevo(string $title): void
    {
        if($title == '/nuevo') {
            $this->chat->message('Necesitas ingresar un título')->send();
            return;
        }
        $last_event = Event::latest('created_at')->first();
        if($last_event->active) {
            $this->chat->message('Ya hay un partido activo, puede editar el título con el comando "/editar"')->send();
            return;
        }
        $table = new PrettyTable();
        $table->add_row("$title");
        $this->chat->message('¡Partido Creado!')->send();
        $message =  $this->chat->message($table->print())->send();
        $messageID = $message->telegraphMessageId();
        if($messageID) {
            $this->chat->pinMessage($messageID)->send();
            Event::create([
                'title' => $title,
                'owner_chat_id' => $this->chat->id,
                'creator_chat_id' => $this->message->from()->id(),
                'message_id' => $messageID,
            ]);
        }


    }

    public function editar(string $title = ''): void
    {
        if($title == '/editar') {
            $this->chat->message('Necesitas ingresar un título')->send();
            return;
        }
        $last_event = Event::latest('created_at')->with('details')->first();
        if(!$last_event->active) {
            $this->chat->message('No hay un partido activo, puede crear uno con el comando "/nuevo"')->send();
            return;
        }
        $table = new PrettyTable();
        $table->add_row("$title");
        $table->add_new_line();
        foreach ($last_event->details as $key => $player) {
            $number = $key + 1;
            $row = "$number. $player->name";
            $table->add_row($row);
        }
        $this->chat->message('¡Partido Editado!')->send();
        $this->chat->edit($last_event->message_id)->message($table->print())->send();
        $last_event->update([
            'title' => $title,
        ]);

    }

    public function participo(): void
    {
        $last_event = Event::latest('created_at')->first();
        if(!$last_event->active) {
            $this->chat->message('No hay un partido activo, puede crear uno con el comando "/nuevo"')->send();
            return;
        }
        $name = $this->message->from()->firstName();
        $player = Player::firstOrCreate(
            ['chat_id' => $this->message->from()->id()],
            ['name' => $name, 'rating' => '6']
        );
        $player_id = $player->id;
        if ($last_event->details()->where('player_id', '=', $player_id)->exists()) {
            $this->chat->message('Ya estás participando')->send();
            return;
        }
        $last_event->details()->create([
            'player_id' => $player_id,
            'name' => $player->name,
            'rating' => $player->rating,
        ]);
        $last_event = Event::latest('created_at')->with('details')->first();
        $table = new PrettyTable();
        $table->add_row($last_event->title);
        $table->add_new_line();
        foreach ($last_event->details as $key => $player) {
            $number = $key + 1;
            $row = "$number. $player->name";
            $table->add_row($row);
        }

        $this->chat->message("OK. Que bueno que participes $name")->send();
        $this->chat->edit($last_event->message_id)->message($table->print())->send();
    }

    public function yo(): void
    {
        $this->participo();
    }

    public function terminar(): void
    {
        $last_event = Event::latest('created_at')->first();
        if(!$last_event->active) {
            $this->chat->message('No hay un partido activo, puede crear uno con el comando "/nuevo"')->send();
            return;
        }
        $last_event->update([
            'active' => false,
        ]);
        $this->chat->message('¡Partido Terminado, espero que la hayan pasado bien!')->send();
        $this->chat->unpinMessage($last_event->message_id)->send();
    }

    protected function handleChatMemberJoined(User $member): void
    {
        $this->chat->html("Bienvenido/a {$member->firstName()}")->send();
    }

    protected function handleUnknownCommand(\Illuminate\Support\Stringable $text): void
    {
        $this->chat->html("No puedo entender su comando: $text")->send();
    }
}
