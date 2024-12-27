<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Product extends CoreModel
{
    private $name;
    private $description;
    private $picture;
    private $price;
    private $rate;
    private $status;
    private $brand_id;
    private $category_id;
    private $type_id;

    /**
     * Insère un nouvel enregistrement dans la table `product`.
     */
    protected function insert()
    {
        $sql = "
            INSERT INTO product (name, description, picture, price, rate, status, brand_id, category_id, type_id, created_at, updated_at)
            VALUES (:name, :description, :picture, :price, :rate, :status, :brand_id, :category_id, :type_id, NOW(), NOW())
        ";

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $stmt->bindValue(':price', $this->price, PDO::PARAM_STR);
        $stmt->bindValue(':rate', $this->rate, PDO::PARAM_INT);
        $stmt->bindValue(':status', $this->status, PDO::PARAM_INT);
        $stmt->bindValue(':brand_id', $this->brand_id, PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $this->category_id, PDO::PARAM_INT);
        $stmt->bindValue(':type_id', $this->type_id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $this->id = $pdo->lastInsertId();
        }
    }

    /**
     * Met à jour un enregistrement existant dans la table `product`.
     */
    protected function update()
    {
        $sql = "
            UPDATE product
            SET
                name = :name,
                description = :description,
                picture = :picture,
                price = :price,
                rate = :rate,
                status = :status,
                brand_id = :brand_id,
                category_id = :category_id,
                type_id = :type_id,
                updated_at = NOW()
            WHERE id = :id
        ";

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
        $stmt->bindValue(':description', $this->description, PDO::PARAM_STR);
        $stmt->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $stmt->bindValue(':price', $this->price, PDO::PARAM_STR);
        $stmt->bindValue(':rate', $this->rate, PDO::PARAM_INT);
        $stmt->bindValue(':status', $this->status, PDO::PARAM_INT);
        $stmt->bindValue(':brand_id', $this->brand_id, PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $this->category_id, PDO::PARAM_INT);
        $stmt->bindValue(':type_id', $this->type_id, PDO::PARAM_INT);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);

        $stmt->execute();
    }

    /**
     * Supprime un enregistrement de la table `product` par son ID.
     */

     public function find($id)
     {
         $sql = "SELECT * FROM product WHERE id = :id";
     
         $pdo = Database::getPDO();
         $stmt = $pdo->prepare($sql);
         $stmt->bindValue(':id', $id, PDO::PARAM_INT);
         $stmt->execute();
     
         return $stmt->fetchObject(Product::class);
     }
     
    
    public function delete()
    {
        $sql = "DELETE FROM product WHERE id = :id";

        $pdo = Database::getPDO();
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Getters et setters pour les propriétés


    public function findByBrand($id_brand)
{
    $sql = "SELECT * FROM product WHERE brand_id = :brand_id";
    $pdo = Database::getPDO();
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':brand_id', $id_brand, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_CLASS, Product::class);
}



    public function findByType($id_type)
{
    $sql = "SELECT * FROM product WHERE type_id = :type_id";
    $pdo = Database::getPDO();
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':type_id', $id_type, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_CLASS, Product::class);
}



    public function findByCategory($id_category)
{
    $sql = "SELECT * FROM product WHERE category_id = :category_id";
    $pdo = Database::getPDO();
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':category_id', $id_category, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_CLASS, Product::class);
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

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
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

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function getRate()
    {
        return $this->rate;
    }

    public function setRate($rate)
    {
        $this->rate = $rate;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function getBrandId()
    {
        return $this->brand_id;
    }

    public function setBrandId($brand_id)
    {
        $this->brand_id = $brand_id;
        return $this;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
        return $this;
    }

    public function getTypeId()
    {
        return $this->type_id;
    }

    public function setTypeId($type_id)
    {
        $this->type_id = $type_id;
        return $this;
    }
}
