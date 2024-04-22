<?php

namespace App\Helpers;

use AmoCRM\Collections\NotesCollection;
use AmoCRM\Models\NoteType\CommonNote;
use App\Models\User;

class NoteHelper
{
    public static function createNoteForUpdate($entity, $entityType, $attinationInfo = '')
    {
        return self::createNoteCollection($entity->getId(), self::generateNoteTextForUpdate($entity, $entityType));
    }

    public static function createNoteForAdd($entity, $entityType)
    {
        return self::createNoteCollection($entity->getId(), self::generateNoteTextForAdd($entity, $entityType));
    }

    private static function generateNoteTextForUpdate($entity, $entityType)
    {

        $updatedAt = date('d.m.Y H:i:s', $entity->getUpdatedAt());
        $updatedFields = implode(', ', array_keys($entity->getUpdated()));
        $text = "{$entityType} '{$entity->getName()}' была обновлена {$updatedAt}.\n";
        $text .= "Обновленные поля: {$updatedFields}.\n";
        $text .= "ID Ответственного: {$entity->getResponsibleUserId()}";

        return $text;
    }

    private static function generateNoteTextForAdd($entity, $entityType)
    {
        $createdAt = date('d.m.Y H:i:s', $entity->getCreatedAt());
        $text = "{$entityType} '{$entity->getName()}' была создана {$createdAt}.\n";
        $text .= "ID Ответственного: {$entity->getResponsibleUserId()}";

        return $text;
    }

    private static function createNoteCollection($entityId, $note)
    {
        $notesCollection = new NotesCollection();
        $serviceMessageNote = new CommonNote();
        $serviceMessageNote->setEntityId($entityId)
            ->setText($note);

        $notesCollection->add($serviceMessageNote);

        return $notesCollection;
    }
}