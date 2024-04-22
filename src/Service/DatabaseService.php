<?php

namespace App\Service;

use PDO;

class DatabaseService
{
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getLeadById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM leads WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateLead($id, $data) {
        // Пример обновления записи
        $stmt = $this->pdo->prepare("UPDATE leads SET name = ?, status_id = ? WHERE id = ?");
        $stmt->execute([$data['name'], $data['status_id'], $id]);
    }

    public function createLead($data) {
        // Пример создания новой записи
        $stmt = $this->pdo->prepare("INSERT INTO leads (name, status_id) VALUES (?, ?)");
        $stmt->execute([$data['name'], $data['status_id']]);
    }
}