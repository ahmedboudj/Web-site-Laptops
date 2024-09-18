<?php

class Paniers extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        // Chargez le panier de l'utilisateur connecté
        $panier = new Panier();
        $laptops = $panier->getAll();
        
        if (is_null($laptops)) {
            $laptops = [];
        }

        // Affichez la vue du panier avec les laptops
        $this->render("index", compact('laptops'));
    }

    public function ajouter($id_laptop, $quantite = 1)
    {
        if (isset($_SESSION['Utilisateur']) && is_numeric($id_laptop) && is_numeric($quantite)) {
            $userId = $_SESSION['Utilisateur']->id;

            // Ajouter ou mettre à jour l'article dans le panier
            $panier = new Panier();
            $panier->ajouter($id_laptop, $quantite);
        }

        // Rediriger vers la page d'index du panier
        header("Location: " . URI . "paniers/index");
        exit();
    }

    public function supprimer($id_laptop)
    {
        if (isset($_SESSION['Utilisateur']) && is_numeric($id_laptop)) {
            // Supprimez l'article du panier
            $panier = new Panier();
            $panier->supprimer($id_laptop);
        }

        // Redirigez vers la page d'index du panier
        header("Location: " . URI . "paniers/index");
        exit();
    }

    public function modifier($id_laptop)
    {
        if (isset($_SESSION['Utilisateur']) && is_numeric($id_laptop) && isset($_POST['quantite']) && is_numeric($_POST['quantite'])) {
            $quantite = (int)$_POST['quantite'];

            if ($quantite > 0) {
                // Mettre à jour la quantité dans le panier
                $panier = new Panier();
                $panier->ajouter($id_laptop, $quantite);
            } else {
                // Supprimez l'article si la quantité est 0
                $panier->supprimer($id_laptop);
            }
        }

        // Rediriger vers la page d'index du panier
        header("Location: " . URI . "paniers/index");
        exit();
    }
}
