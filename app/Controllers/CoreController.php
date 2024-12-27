<?php

namespace App\Controllers;

use App\Models\Category;

class CoreController
{
    /**
     * Fonction qui permet d'afficher une vue
     *
     * @param string $viewName Nom de la vue à afficher (ex: 'home')
     * @param array $viewData Données à transmettre à la vue
     */
    public function show($viewName, $viewData = [])
    {
        // L'URL absolue du site, définie par BASE_URI dans le .htaccess
        $absoluteURL = $_SERVER['BASE_URI'];

        // Variable globale pour accéder au router dans les vues
        global $router;

        // Charger toutes les catégories pour le menu (ou autres besoins globaux)
        $categoryModel = new Category();
        $categories = $categoryModel->findAll();

        // Transformation des catégories (si nécessaire)
        // Exemple : créer une liste associative si besoin
        $categoriesById = [];
        foreach ($categories as $category) {
            $categoriesById[$category->getId()] = $category;
        }

        // Inclusion des fichiers de vue (header, contenu principal, footer)
        require_once __DIR__ . "/../views/partials/header.tpl.php";
        require_once __DIR__ . "/../views/$viewName.tpl.php";
        require_once __DIR__ . "/../views/partials/footer.tpl.php";
    }
}
