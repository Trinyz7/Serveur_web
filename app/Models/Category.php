<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel
{
    private $name;
    private $subtitle;
    private $picture;
    private $home_order;

    /**
     * Insère un nouvel enregistrement dans la table `category`.
     */
    protected function insert()
    {
        $sql = "
            INSERT INTO category (name, subtitle, picture, home_order, created_at, updated_at)
            VALUES (:name, :subtitle, :picture, :home_order, NOW(), NOW())
        ";

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':subtitle', $this->subtitle, PDO::PARAM_STR);
        $stmt->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $stmt->bindValue(':home_order', $this->home_order, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
        }
    }


    public function findAll()
{
    $sql = "SELECT * FROM category";
    $pdo = Database::getPDO();
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
}

public function findAllForHomePage()
{
    $sql = "SELECT * FROM category WHERE home_order > 0 ORDER BY home_order ASC";
    $pdo = Database::getPDO();
    $pdoStatement = $pdo->query($sql);

    return $pdoStatement->fetchAll(PDO::FETCH_CLASS, Category::class);
}


    /**
     * Met à jour un enregistrement existant dans la table `category`.
     */
    protected function update()
    {
        $sql = "
            UPDATE category
            SET
                name = :name,
                subtitle = :subtitle,
                picture = :picture,
                home_order = :home_order,
                updated_at = NOW()
            WHERE id = :id
        ";

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':subtitle', $this->subtitle, PDO::PARAM_STR);
        $stmt->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $stmt->bindValue(':home_order', $this->home_order, PDO::PARAM_INT);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * Supprime un enregistrement de la table `category` par son ID.
     */
    public function delete()
    {
        $sql = "DELETE FROM category WHERE id = :id";

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Getters et setters pour les propriétés


    public function find($id)
{
    $sql = "SELECT * FROM category WHERE id = :id";
    $pdo = Database::getPDO();
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchObject(Category::class);
}


    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getSubtitle()
    {
        return $this->subtitle;
    }

    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture)
    {
        $this->picture = $picture;
        return $this;
    }

    public function getHomeOrder()
    {
        return $this->home_order;
    }

    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;
        return $this;
    }
}
