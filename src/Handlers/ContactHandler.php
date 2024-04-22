<?php

namespace App\Handlers;

use AmoCRM\Helpers\EntityTypesInterface;
use App\Helpers\NoteHelper;
use App\Models\Contact;
use App\Service\AmoCRMApiService;

class ContactHandler
{
    private $amoCRMClient;

    public function __construct(AmoCRMApiService $amoCRMClient)
    {
        $this->amoCRMClient = $amoCRMClient;
    }

    public function handleUpdate($data)
    {
        $contact = new Contact($data);
        $note = NoteHelper::createNoteForUpdate($contact, 'Контакт');
        $this->amoCRMClient->addNoteToEntity(EntityTypesInterface::CONTACTS, $note);
    }

    public function handleAdd($data)
    {
        $contact = new Contact($data);
        $note = NoteHelper::createNoteForAdd($contact, 'Контакт');
        $this->amoCRMClient->addNoteToEntity(EntityTypesInterface::CONTACTS, $note);
    }
}