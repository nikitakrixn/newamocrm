<?php

namespace App\Handlers;

use AmoCRM\Helpers\EntityTypesInterface;
use App\Helpers\JsonHelper;
use App\Helpers\NoteHelper;
use App\Models\Lead;
use App\Service\AmoCRMApiService;

class LeadHandler
{
    private $amoCRMClient;
    private $jsonHelper;

    public function __construct(AmoCRMApiService $amoCRMClient)
    {
        $this->amoCRMClient = $amoCRMClient;
    }

    public function handleUpdate($data)
    {
        $lead = new Lead();
        $lead->setId($data['id']);
        $lead->setName($data['name']);
        $leads = $this->amoCRMClient->getLead(847657);
        $lead->setUpdatedAt($data['updated_at']);
        $lead->setResponsibleUserId($data['responsible_user_id']);

        $note = NoteHelper::createNoteForUpdate($lead, 'Сделка');

        $this->amoCRMClient->addNoteToEntity(EntityTypesInterface::LEADS, $note);
    }

    public function handleAdd($data)
    {
        $lead = new Lead();
        $lead->setId($data['id']);
        $lead->setName($data['name']);
        $lead->setCreatedAt($data['created_at']);
        $lead->setResponsibleUserId($data['responsible_user_id']);

        $note = NoteHelper::createNoteForAdd($lead, 'Сделка');
        $this->amoCRMClient->addNoteToEntity(EntityTypesInterface::LEADS, $note);
    }
}