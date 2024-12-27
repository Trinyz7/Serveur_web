<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Type extends CoreModel
{
    private $name;
    private $description;

    /**
     * Insère un nouveau type dans la table `type`.
     */
    protected function insert()
    {
        $sql = "
            INSERT INTO type (name, description, created_at, updated_at)
            VALUES (:name, :description, NOW(), NOW())
        ";

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
        }
    }

    /**
     * Met à jour un type existant dans la table `type`.
     */
    protected function update()
    {
        $sql = "
            UPDATE type
            SET name = :name, description = :description, updated_at = NOW()
            WHERE id = :id
        ";

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * Supprime un type de la table `type`.
     */
    public function delete()
    {
        $sql = "DELETE FROM type WHERE id = :id";

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * Récupère tous les types.
     */
    public function findAll()
    {
        $sql = "SELECT * FROM type";
        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Type::class);
    }

    // Getters et setters
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }
}
