<?php

class Auth extends Model
{
    const USER = "Utilisateur";
    const ADMIN = 'admin';

    public function __construct()
    {
        parent::__construct();
        $this->table = self::USER;
    }

    public function inscription($datas)
    {
        $this->sql = "INSERT INTO " . $this->table . "(nom,prenom,email,numero_telephone,adresse, code_postal,id_role,mot_de_passe) 
        values(:nom,:prenom,:email,:numero_telephone,:adresse, :code_postal,:id_role,:mot_de_passe)";

        return $this->getLines($datas, null);
    }

    public function findByEmail($datas)
    {
        $this->sql = "SELECT u.*,r.description FROM " . $this->table . " u JOIN Role r on u.id_role = r.id_role WHERE email=:email";
        return $this->getLines($datas, true);
    }

    public function findByNom($datas)
    {
        $this->sql = "SELECT * FROM " . $this->table . " WHERE nom=:nom";
        return $this->getLines($datas, null);
    }
    

    public function getAllUsers()
    {
        $this->sql = "SELECT * FROM " . $this->table;
        return $this->getLines();
    }
   
    
    public function deleteById($id_utilisateur)
{
    $this->sql = "DELETE FROM " . $this->table . " WHERE id_utilisateur = :id_utilisateur";
    $params = array(':id_utilisateur' => $id_utilisateur);

    return $this->execute($this->sql, $params);
}


}
