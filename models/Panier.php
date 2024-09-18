<?php

class Panier
{
    const NAME = "Panier";

    public function __construct()
    {
        if (!isset($_SESSION[self::NAME])) {
            $_SESSION[self::NAME] = [];
        }
    }

    public function ajouter($id_laptop, $quantite)
    {
        $_SESSION[self::NAME][$id_laptop] = $quantite;
    }

    public function supprimer($id_laptop)
    {
        unset($_SESSION[self::NAME][$id_laptop]);
    }

    public function getAll()
    {
        $laptops = [];
        foreach ($_SESSION[self::NAME] as $id_laptop => $quantite) {
            $laptop = new Laptop();

            $currentLaptop = $laptop->lire(compact('id_laptop'));
            if ($currentLaptop) {
                $laptops[] = [$quantite, $currentLaptop];
            } else {
                 unset($_SESSION[self::NAME][$id_laptop]);
            }
        }
        return $laptops;
    }

}