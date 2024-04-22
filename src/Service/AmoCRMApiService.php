<?php

namespace App\Service;

use AmoCRM\Client\AmoCRMApiClient;
use AmoCRM\Client\LongLivedAccessToken;
use Dotenv\Dotenv;

class AmoCRMApiService
{
    private $client;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $apiClient = new AmoCRMApiClient();
        $longLivedAccessToken = new LongLivedAccessToken($_ENV['CLIENT_ACCESS_TOKEN']);
        $this->client = $apiClient->setAccessToken($longLivedAccessToken)
            ->setAccountBaseDomain($_ENV['ACCOUNT_DOMAIN']);
    }

    public function addNoteToEntity($entityType, $noteText)
    {
        $this->client->notes($entityType)->addOne($noteText);
    }


    public function getUserbyId($userId)
    {
        return $this->client->users()->getOne($userId);
    }

    public function getLead($userId)
    {
        return $this->client->leads()->getOne($userId);

    }


}