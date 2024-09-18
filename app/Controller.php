<?php

class Controller
{
    public function render($fichier, $data = [])
    {
        extract($data);
        ob_start(); //permet de creer le flux
        require_once("./views/" . lcfirst(get_class($this)) . "/" . $fichier . ".php");
        $contenu = ob_get_clean(); //retourne tout en chaine de caractere
        require_once("./views/layout/default.php");
    }

    public function __construct()
    {
    }

    public function isValid($datas)
    {
        foreach ($datas as $data) {
            if (empty($data)) 
            {
                return false;
            }
        }
        return true;
    }
}
