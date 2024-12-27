<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;
use App\Controllers\CoreController;


class MainController extends CoreController
{
    /**
     * Méthode test
     * Permet de tester les interactions avec les modèles et de déboguer.
     */
    public function test()
    {
        // Exemple d'utilisation du modèle Brand (remplaçable par d'autres modèles)
        $brandModel = new Brand();
        
        // Récupère toutes les entrées du modèle Brand
        $list = $brandModel->findAll();
        
        // Récupère un élément spécifique avec ID 7
        $elem = $brandModel->find(7);
        
        // Affiche toutes les marques
        dump($list);
        
        // Affiche la marque avec l'ID 7
        dump($elem);
    }

    /**
     * Affiche la page d'accueil du site
     */
    public function home()
    {
        // Créer une instance du modèle Category
        $categoryModel = new Category();
        
        // Récupérer les catégories spécifiquement pour la page d'accueil
        $categories = $categoryModel->findAllForHomePage();
        
        // Affiche la vue "home" et transmet les données des catégories
        $this->show('home', [
            'categories' => $categories
        ]);
    }
}
