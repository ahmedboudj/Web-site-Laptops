<?php

class Laptop extends Model
{

    public function __construct()
    {
        parent::__construct();
        $this->table = "Laptop";
    }

    public function ajouter($data)
    {
        $this->sql = "insert into " . $this->table . " (nom, prix, description, courte_description, quantite) 
        VALUE (:nom, :prix, :description, :courte_description, :quantite)";
        return $this->getLines($data, null);

    }

    public function getAll()
    {
        $this->sql = "SELECT f.*, i.chemin_image from " . $this->table .
            " f left join Image i on f.id_laptop = i.id_laptop";

        return $this->getLines();
    }

    public function lire($data)
    {
        $this->sql = "SELECT f.*, i.chemin_image from " . $this->table .
            " f left join Image i on f.id_laptop = i.id_laptop where f.id_laptop = :id_laptop";

        return $this->getLines($data, true);
    }


    
    public function modifier($data)
    {
        $this->sql = "UPDATE " . $this->table . " SET nom = :nom, prix = :prix, description = :description, courte_description = :courte_description, quantite = :quantite WHERE id_laptop = :id_laptop";
        return $this->getLines($data, null);
    }
    


    public function deleteById($data)
    {
        $this->sql = "delete from " . $this->table . " where id_laptop = :id_laptop";
        return $this->getLines($data, null);
    }


}