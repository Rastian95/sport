<?php

namespace App\Http\Webhooks;

use DefStudio\Telegraph\DTO\User;
use DefStudio\Telegraph\Handlers\WebhookHandler;

class CustomWebhookHandler extends WebhookHandler
{
    protected function handleChatMemberJoined(User $member): void
    {
        $this->chat->html("Welcome {$member->firstName()}")->send();
    }
}
