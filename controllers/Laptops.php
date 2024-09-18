<?php

class Laptops extends Controller
    {

            public function index()
                {

                    $laptop = new Laptop();
                    $laptops = $laptop->getAll();
                    $this->render('index', compact("laptops"));
                }

            public function admin()
                {
                    if (isset($_SESSION[Auth::USER])) {
                        if ($_SESSION[Auth::USER]->description === Auth::ADMIN) {
                            $laptop = new Laptop();
                            $laptops = $laptop->getAll();
                            $this->render('admin', compact("laptops"));
                            return;
                        }
                    }

                    header("Location: " . URI . "laptops/index");
                }

                public function __construct()
                {
                    parent::__construct();
                }

                private function uploadImage($id_laptop)
                {
                    // Vérifiez s'il existe déjà une image pour le laptop
                    $laptop = new Laptop();
                    $currentLaptop = $laptop->lire(['id_laptop' => $id_laptop]);
                    
                    if ($currentLaptop->chemin_image) {
                        // Supprimez l'ancienne image
                        $oldImagePath = RACINE . $currentLaptop->chemin_image;
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                
                    if (isset($_FILES["image"]) && $_FILES["image"]["error"] === UPLOAD_ERR_OK) {
                        $image_name = $_FILES["image"]["name"];
                        $image_tmp = $_FILES["image"]["tmp_name"];
                        $image_destination = "assets/images/" . basename($image_name);
                
                        $image_type = strtolower(pathinfo($image_destination, PATHINFO_EXTENSION));
                        
                        // Vérifiez le type de l'image
                        if (!in_array($image_type, array("jpg", "jpeg", "png", "gif", "avif", "webp"))) {
                            echo "Seules les images JPG, JPEG, PNG, GIF, AVIF et WEBP sont autorisées.";
                            exit();
                        }
                
                        // Déplacez le fichier image vers la destination
                        if (move_uploaded_file($image_tmp, RACINE . $image_destination)) {
                            // Mettez à jour ou ajoutez l'image dans la base de données
                            $image = new Image();
                            $data = [
                                "id_laptop" => $id_laptop,
                                "chemin_image" => $image_destination
                            ];
                            
                            // Si une image existait déjà, mettez à jour, sinon, ajoutez une nouvelle image
                            if ($currentLaptop->chemin_image) {
                                $image->update($data);
                            } else {
                                $image->upload($data);
                            }
                        }
                    }
                }
                

            public function ajouter()
                    {
                                if (isset($_POST['save']))
                                 {
                                    if ($this->isValid($_POST))
                                     {
                                        unset($_POST['save']);
                                        $laptop = new Laptop();

                                        if ($laptop->ajouter($_POST)) {
                                            global $oPDO;
                                            $id_laptop = $oPDO->lastInsertId();
                                            $this->uploadImage($id_laptop);
                                            header(URI . "laptops/index");   
                                        }else{
                                            echo "erreur";
                                        }
                                     }
                                    }
                        $this->render("ajouter");
                    }
                
            public function supprimer($id_laptop)
                {
                    if (isset($_SESSION[Auth::USER])) {
                        if ($_SESSION[Auth::USER]->description === Auth::ADMIN) {
                            if (is_numeric($id_laptop)) {
                                $laptop = new Laptop();
                                if ($laptop->deleteById(["id_laptop" => $id_laptop])) { 
                                    header("Location: " . URI . "laptops/admin");
                                    return;
                                }
                                header("Location: " . URI . "laptops/admin");
                                return;
                            }
                            header("Location: " . URI . "laptops/admin");
                            return;
                        }
                    }
                    header("Location: " . URI . "laptops/index");
                }


                public function modifier($id_laptop)
                {
                    if (!isset($_SESSION[Auth::USER]) || $_SESSION[Auth::USER]->description !== Auth::ADMIN) {
                        header("Location: " . URI . "laptops/index");
                        return;
                    }
                
                    $laptop = new Laptop();
                    
                    if (isset($_POST['modifier'])) {
                        $data = [
                            'id_laptop' => $id_laptop,
                            'nom' => $_POST['nom'],
                            'prix' => $_POST['prix'],
                            'quantite' => $_POST['quantite'],
                            'courte_description' => $_POST['courte_description'],
                            'description' => $_POST['description']
                        ];
                
                        if ($laptop->modifier($data)) {
                            // Appelez la méthode `uploadImage` pour gérer la mise à jour de l'image
                            $this->uploadImage($id_laptop);
                
                            // Redirigez vers la page d'administration des laptops après mise à jour réussie
                            header("Location: " . URI . "laptops/admin");
                            return;
                        } else {
                            echo "Échec de la mise à jour du laptop.";
                        }
                    }
                
                    $laptopDetails = $laptop->lire(['id_laptop' => $id_laptop]);
                    $this->render('modifier', compact('laptopDetails'));
                }
                
            }
                
