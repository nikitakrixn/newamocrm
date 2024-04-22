<?php

namespace App;

use App\Handlers\ContactHandler;
use App\Handlers\LeadHandler;
use App\Service\AmoCRMApiService;

class WebhookHandler
{
    private $leadHandler;
    private $contactHandler;

    public function __construct(AmoCRMApiService $amoCRMClient)
    {
        $this->leadHandler = new LeadHandler($amoCRMClient);
        $this->contactHandler = new ContactHandler($amoCRMClient);
    }

    public function handleWebhook($data)
    {

        if (is_array($data['leads']['update']) && !empty($data['leads']['update'])) {
            $this->leadHandler->handleUpdate(reset($data['leads']['update']));
        } elseif (is_array($data['contacts']['update']) && !empty($data['contacts']['update'])) {
            $this->contactHandler->handleUpdate(reset($data['contacts']['update']));
        } elseif (is_array($data['leads']['add']) && !empty($data['leads']['add'])) {
            $this->leadHandler->handleAdd(reset($data['leads']['add']));
        } elseif (is_array($data['contacts']['add']) && !empty($data['contacts']['add'])) {
            $this->contactHandler->handleAdd(reset($data['contacts']['add']));
        } else {
            http_response_code(400);
            exit('Next Generation');
        }
    }

}