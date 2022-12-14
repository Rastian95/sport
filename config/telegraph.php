<?php

use DefStudio\Telegraph\Telegraph;

return [
    /*
     * Telegram api base url, it can be overridden
     * for self-hosted servers
     */
    'telegram_api_url' => 'https://api.telegram.org/',

    /*
     * Sets Telegraph messages default parse mode
     * allowed values: html|markdown
     */
    'default_parse_mode' => Telegraph::PARSE_HTML,

    /*
     * Sets the handler to be used when Telegraph
     * receives a new webhook call.
     *
     * For reference, see https://defstudio.github.io/telegraph/webhooks/overview
     */
    'webhook_handler' => \App\Http\Webhooks\MyWebhookHandler::class,

    /*
     * If enabled, Telegraph dumps received
     * webhook messages to logs
     */
    'debug_mode' => false,

    /*
     * If enabled, unknown webhook commands are
     * reported as exception in application logs
     */
    'report_unknown_webhook_commands' => true,

    'security' => [
        /*
         * if enabled, allows callback queries from unregistered chats
         */
        'allow_callback_queries_from_unknown_chats' => false,

        /*
         * if enabled, allows messages and commands from unregistered chats
         */
        'allow_messages_from_unknown_chats' => true,

        /*
         * if enabled, store unknown chats as new TelegraphChat models
         */
        'store_unknown_chats_in_db' => true,
    ],

    /*
     * Set model class for both TelegraphBot and TelegraphChat,
     * to allow more customization.
     *
     * Bot model must be or extend `DefStudio\Telegraph\Models\TelegraphBot::class`
     * Chat model must be or extend `DefStudio\Telegraph\Models\TelegraphChat::class`
     */
    'models' => [
        'bot' => DefStudio\Telegraph\Models\TelegraphBot::class,
        'chat' => DefStudio\Telegraph\Models\TelegraphChat::class,
    ],

    'bot' => [
        'default' => 'tekicha_sport_bot',
    ],

    'ids' => [
        'bots' => [
            'tekicha_bot' => '5329801120',
            'tekicha_sport_bot' => '5704695558',
        ],
        'chats' => [
            'sebastian' => '1413405776',
            'claudia' => '1516584764',
            'tekicha_spa' => '5736426295',
        ],
        'groups' => [
            'elaguadelavida' => '-728309460',
            'volleyball' => '-661460749',
        ],
    ]
];
