<?php


namespace App\Http\Controllers;

use App\Http\Webhooks\CustomWebhookHandler;
use DefStudio\Telegraph\Models\TelegraphBot;
use DefStudio\Telegraph\Models\TelegraphChat;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    public function index()
    {

    }

    public function test()
    {
        $chat = TelegraphChat::find(1);
        $chat->message('hello')->send();
    }

    public function webhook(Request $request,CustomWebhookHandler $handler)
    {
        $bot = TelegraphBot::find(1);
        $handler->handle($request, $bot);
    }

}
