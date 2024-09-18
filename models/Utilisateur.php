<?php

class Utilisateur extends Model
{
    public function __construct()
    {
        parent::__construct();
        $this->table = "Utilisateur";
    }

    public function ajouter($data)
    {
        $this->sql = "INSERT INTO " . $this->table . " (nom, prenom, email, numero_telephone, adresse, code_postal, id_role, mot_de_passe) 
        VALUES (:nom, :prenom, :email, :numero_telephone, :adresse, :code_postal, :id_role, :mot_de_passe)";
        return $this->getLines($data, null);
    }

    public function getAll()
    {
        $this->sql = "SELECT * FROM " . $this->table;
        return $this->getLines();
    }

    public function lire($data)
    {
        $this->sql = "SELECT * FROM " . $this->table . " WHERE id_utilisateur = :id_utilisateur";
        return $this->getLines($data, true);
    }

    public function modifier($data)
    {
        // Requête SQL pour mettre à jour les données de l'utilisateur
        $this->sql = "UPDATE " . $this->table . " 
        SET nom = :nom, prenom = :prenom, email = :email, numero_telephone = :numero_telephone, adresse = :adresse, code_postal = :code_postal, id_role = :id_role 
        WHERE id_utilisateur = :id_utilisateur";
        
        // Exécutez la requête de mise à jour avec les données fournies
        return $this->getLines($data, null);
    }
    

    public function deleteById($data)
    {
        $this->sql = "DELETE FROM " . $this->table . " WHERE id_utilisateur = :id_utilisateur";
        return $this->getLines($data, null);
    }
}
