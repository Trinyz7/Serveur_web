<?php

namespace App\Models;

// Modèle de base : classe mère de tous les modèles
// Cette classe factorise les propriétés et méthodes communes à tous les modèles.
// Elle n'est pas destinée à être instanciée directement.
abstract class CoreModel
{
    /**
     * Propriétés communes à tous les modèles
     * Ces propriétés correspondent aux colonnes présentes dans toutes les tables de la base de données.
     */
    protected $id;
    protected $created_at;
    protected $updated_at;

    // ---------------------------------
    // Getters et Setters
    // ---------------------------------

    /**
     * Récupère l'ID de l'objet.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Définit l'ID de l'objet.
     *
     * @param int $id
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Récupère la date de création.
     *
     * @return string|null
     */
    public function getCreated_at()
    {
        return $this->created_at;
    }

    /**
     * Définit la date de création.
     *
     * @param string $created_at
     * @return self
     */
    public function setCreated_at($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    /**
     * Récupère la date de mise à jour.
     *
     * @return string|null
     */
    public function getUpdated_at()
    {
        return $this->updated_at;
    }

    /**
     * Définit la date de mise à jour.
     *
     * @param string $updated_at
     * @return self
     */
    public function setUpdated_at($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    // ---------------------------------
    // Méthodes génériques communes
    // ---------------------------------

    /**
     * Sauvegarde l'objet dans la base de données.
     * Si l'objet a un ID, il est mis à jour, sinon il est inséré.
     */
    public function save()
    {
        if ($this->id) {
            $this->update();
        } else {
            $this->insert();
        }
    }

    /**
     * Insère un nouvel objet dans la base de données.
     */
    abstract protected function insert();

    /**
     * Met à jour un objet existant dans la base de données.
     */
    abstract protected function update();

    /**
     * Supprime l'objet de la base de données.
     */
    abstract public function delete();
}
