<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Brand extends CoreModel
{
    private $name;
    private $logo;

    /**
     * Insère une nouvelle marque dans la table `brand`.
     */
    protected function insert()
    {
        $sql = "
            INSERT INTO brand (name, logo, created_at, updated_at)
            VALUES (:name, :logo, NOW(), NOW())
        ";

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':logo', $this->logo, PDO::PARAM_STR);

        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
        }
    }

    /**
     * Met à jour une marque existante dans la table `brand`.
     */
    protected function update()
    {
        $sql = "
            UPDATE brand
            SET name = :name, logo = :logo, updated_at = NOW()
            WHERE id = :id
        ";

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':logo', $this->logo, PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * Supprime une marque de la table `brand`.
     */
    public function delete()
    {
        $sql = "DELETE FROM brand WHERE id = :id";

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * Récupère toutes les marques.
     */
    public function findAll()
    {
        $sql = "SELECT * FROM brand";
        $pdo = Database::getPDO();
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_CLASS, Brand::class);
    }

    public function find($id)
{
    $sql = "SELECT * FROM brand WHERE id = :id";

    $pdo = Database::getPDO();
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchObject(Brand::class);
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

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;
    }
}
