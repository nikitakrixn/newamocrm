<?php

require __DIR__ . '/vendor/autoload.php';

use App\Service\AmoCRMApiService;
use App\WebhookHandler;

parse_str(file_get_contents('test1337.txt'), $data);
var_dump($data);
//file_put_contents('test1337.txt', print_r($data,true));
$amoCRMClient = new AmoCRMApiService();
$handler = new WebhookHandler($amoCRMClient);
$handler->handleWebhook($data);