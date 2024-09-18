<?php

class Auths extends Controller
{



    public function deconnexion()
    {
        // Supprimez les données de session de l'utilisateur
        unset($_SESSION['Utilisateur']);
    
        // Réinitialisez le panier de l'utilisateur
        if (isset($_SESSION[Panier::NAME])) {
            unset($_SESSION[Panier::NAME]);
            }
    
        // Redirigez l'utilisateur vers la page d'accueil
            header("Location: " . URI . "laptops/index");
    }




    public function login()
        {
            if (isset($_SESSION['Utilisateur'])) {
                header("Location: " . URI . "auths/index");
            }
                
            if (isset($_POST["submit"])) {
                if ($this->isValid($_POST)) {
                    $mot_de_passe = $_POST["mot_de_passe"];
                    unset($_POST["mot_de_passe"]);
                    unset($_POST["submit"]);
                    //var_dump($_POST);
                    $auth = new Auth();
                    $utilisateur = $auth->findByEmail($_POST);
                    if ($utilisateur) {
                        if (password_verify($mot_de_passe, $utilisateur->mot_de_passe)) {
                            unset($utilisateur->mot_de_passe);
                            $_SESSION[Auth::USER] = $utilisateur;
                            header("Location: " . URI . "laptops/index");
                            $_SESSION['role'] = $utilisateur->id_role;
                        } else {
                            $erreurs["message"] = "Email or password invalid!";
                            $this->render("login", $erreurs);
                            return;

                        }
                    } else {
                        $erreurs["message"] = "Email or password invalid!";
                        $this->render("login", $erreurs);
                    }
                } else {
                    $erreurs["message"] = "Remplir tous les champs!";
                    $this->render("login", $erreurs);
                }
            }
            $this->render("login");
        }



    public function __construct()
        {
            parent::__construct();
        }


        
    public function gestionUtilisateurs()
        {
            if ($_SESSION[Auth::USER]->description === Auth::ADMIN) {

                $this->utilisateurs();
            } else {
                // Rediriger vers la page d'accueil si l'utilisateur n'est pas un administrateur
                header("Location: " . URI . "laptops/index");
            }
        }





public function utilisateurs()
        {
            
            if ($_SESSION[Auth::USER]->description === Auth::ADMIN) {
            
                $auth = new Auth();
                $utilisateurs = $auth->getAllUsers();

            
                $this->render('utilisateurs', compact('utilisateurs'));
            } else {
                // Rediriger vers la page d'accueil si l'utilisateur n'est pas un administrateur
                header("Location: " . URI . "laptops/index");
            }
        }





public function modifier_utilisateur($id_utilisateur)

{
    // Vérifiez si l'utilisateur est authentifié et a le rôle d'ADMIN
    if (!isset($_SESSION[Auth::USER]) || $_SESSION[Auth::USER]->description !== Auth::ADMIN) {
        header("Location: " . URI . "laptops/index");
        return;
    }
    
    // Assurez-vous que l'ID de l'utilisateur est un nombre entier
    if (!is_numeric($id_utilisateur)) {
        header("Location: " . URI . "auths/utilisateurs");
        return;
    }
    
    $utilisateur_model = new Utilisateur();
    $utilisateur = $utilisateur_model->lire(["id_utilisateur" => $id_utilisateur]);
    
    // Vérifiez si l'utilisateur existe
    if (!$utilisateur) {
        header("Location: " . URI . "auths/utilisateurs");
        return;
    }
    
    // Si le formulaire a été soumis, traitez la mise à jour
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'id_utilisateur' => $id_utilisateur,
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'numero_telephone' => $_POST['numero_telephone'],
            'adresse' => $_POST['adresse'],
            'code_postal' => $_POST['code_postal'],
            'id_role' => $_POST['id_role'],
        ];
        
        // Mettez à jour les données de l'utilisateur dans la base de données
        $utilisateur_model->modifier($data);
        
        // Redirigez vers la liste des utilisateurs après la mise à jour
        header("Location: " . URI . "auths/utilisateurs");
        return;
    }
    
    // Chargez la vue modifier_utilisateur.php avec les données de l'utilisateur
    include 'views/auths/modifier_utilisateur.php';
}




public function ajouter_user()
{
    // Vérifiez si l'utilisateur est authentifié et a le rôle d'ADMIN
    if (!isset($_SESSION[Auth::USER]) || $_SESSION[Auth::USER]->description !== Auth::ADMIN) {
        header("Location: " . URI . "laptops/index");
        return;
    }
    
    // Si le formulaire est soumis
    if (isset($_POST['Save'])) {
        // Récupérez les données soumises
        $data = [
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'email' => $_POST['email'],
            'numero_telephone' => $_POST['numero_telephone'],
            'adresse' => $_POST['adresse'],
            'code_postal' => $_POST['code_postal'],
            'id_role' => 2, // Par défaut, on donne le rôle 'client'
            'mot_de_passe' => password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT),
        ];

        // Vérifiez que les mots de passe correspondent
        if ($_POST['mot_de_passe'] === $_POST['c_mot_de_passe']) {
            // Créez un nouvel objet Utilisateur
            $utilisateur_model = new Utilisateur();

            // Ajoutez l'utilisateur à la base de données
            if ($utilisateur_model->ajouter($data)) {
                // Redirigez vers la liste des utilisateurs après l'ajout
                header("Location: " . URI . "auths/utilisateurs");
                return;
            } else {
                $message = "Erreur lors de l'ajout de l'utilisateur.";
            }
        } else {
            $message = "Les mots de passe ne correspondent pas.";
        }
    }

    // Chargez la vue ajouter_user.php
    include 'views/auths/ajouter_user.php';
}




        public function supprimer($id_utilisateur)
        {
            if (isset($_SESSION[Auth::USER])) {
                if ($_SESSION[Auth::USER]->description === Auth::ADMIN) {
                    if (is_numeric($id_utilisateur)) {
                        $utilisateur = new Utilisateur();
                        if ($utilisateur->deleteById(["id_utilisateur" => $id_utilisateur])) { 
                            header("Location: " . URI . "auths/utilisateurs");
                            return;
                        }
                        header("Location: " . URI . "auths/utilisateurs");
                        return;
                    }
                    header("Location: " . URI . "auths/utilisateurs");
                    return;
                }
            }
            header("Location: " . URI . "auths/utilisateurs");
        }



        


    public function inscription()
            {
                if (isset($_SESSION[Auth::USER])) {
                    header("Location: " . URI . "laptops/index");
                }
                if (isset($_POST["inscription"])) {

                    if ($this->isValid($_POST)) {
                        if ($_POST["mot_de_passe"] === $_POST["c_mot_de_passe"]) {
                
                            unset($_POST["inscription"]);
                            unset($_POST["c_mot_de_passe"]);
                            
                            $_POST["id_role"] = 2;
                    
                            $_POST["mot_de_passe"] = password_hash($_POST["mot_de_passe"], PASSWORD_DEFAULT);
                            $auth = new Auth();
                            $auth->inscription($_POST);
                        }
                        echo "valide";
                    } else {
                        echo "invalide";
                    }
                }

                $this->render("inscription");
            }



            public function profil()
            {
                // Assurez-vous que l'utilisateur est connecté
                if (!isset($_SESSION[Auth::USER])) {
                    header("Location: " . URI . "auths/login");
                    exit();
                }
        
                // Obtenir l'utilisateur en cours
                $utilisateur = $_SESSION[Auth::USER];
        
                // Charger la vue `profil.php` en passant les informations de l'utilisateur
                $this->render('profil', compact('utilisateur'));
            }
        
            public function modifier_profil()
            {
                // Assurez-vous que l'utilisateur est connecté
                if (!isset($_SESSION[Auth::USER])) {
                    header("Location: " . URI . "auths/login");
                    exit();
                }
        
                // Obtenir l'utilisateur en cours
                $utilisateur = $_SESSION[Auth::USER];
        
                // Traiter la soumission du formulaire
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Récupérer les données soumises par l'utilisateur
                    $data = [
                        'id_utilisateur' => $utilisateur->id_utilisateur,
                        'nom' => $_POST['nom'],
                        'prenom' => $_POST['prenom'],
                        'email' => $_POST['email'],
                        'numero_telephone' => $_POST['numero_telephone'],
                        'adresse' => $_POST['adresse'],
                        'code_postal' => $_POST['code_postal'],
                        'id_role' => $_POST['id_role'],
                    ];
        
                    // Mettre à jour les données de l'utilisateur dans la base de données
                    $utilisateur_model = new Utilisateur();
                    $result = $utilisateur_model->modifier($data);
        
                    if ($result) {
                        // Si la mise à jour est réussie, mettre à jour la session utilisateur
                        $utilisateur->nom = $data['nom'];
                        $utilisateur->prenom = $data['prenom'];
                        $utilisateur->email = $data['email'];
                        $utilisateur->numero_telephone = $data['numero_telephone'];
                        $utilisateur->adresse = $data['adresse'];
                        $utilisateur->code_postal = $data['code_postal'];
                        $utilisateur->id_role = $data['id_role'];
        
                        // Rediriger vers le profil mis à jour
                        header("Location: " . URI . "auths/profil");
                        exit();
                    } else {
                        // En cas d'échec de la mise à jour, afficher un message d'erreur
                        $message = "Échec de la mise à jour du profil.";
                        $this->render('profil', compact('utilisateur', 'message'));
                        return;
                    }
                }
        
                // Charger la vue `profil.php` en passant les informations de l'utilisateur
                $this->render('profil', compact('utilisateur'));
            }
          

        }

