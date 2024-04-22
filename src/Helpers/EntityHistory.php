<?php

namespace App\Helpers;

class EntityHistory
{
    private $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function setPreviousState($entity)
    {
        file_put_contents($this->filePath, json_encode($entity));
    }

    public function checkForChanges($entity)
    {
        $currentState = json_encode($entity);
        $previousState = file_get_contents($this->filePath);

        if ($previousState !== $currentState) {
            $previousData = json_decode($previousState, true);
            $currentData = json_decode($currentState, true);

            $changedFields = $this->getChangedFields($previousData, $currentData);

            return $changedFields;
        }

        return [];
    }

    private function getChangedFields(array $previousData, array $currentData)
    {
        $changedFields = [];

        foreach ($currentData as $field => $value) {
            if (!array_key_exists($field, $previousData) || $previousData[$field] !== $value) {
                $changedFields[$field] = [
                    'old' => isset($previousData[$field]) ? $previousData[$field] : null,
                    'new' => $value,
                ];
            }
        }

        return $changedFields;
    }
}