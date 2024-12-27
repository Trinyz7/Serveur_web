<?php

// ------------------------------------------------------
// 1. Inclusion de l'autoload Composer
// ------------------------------------------------------
// Grâce à ce fichier, toutes les classes installées via Composer (par ex. AltoRouter)
// ainsi que tes classes "App\..." sont automatiquement chargées.
require_once __DIR__ . '/../app/Controllers/MainController.php';
require_once __DIR__ . '/../app/Controllers/CatalogController.php';
require_once __DIR__ . '/../vendor/autoload.php';


// ------------------------------------------------------
// 2. Namespaces importés
// ------------------------------------------------------
// On "use" les classes (controllers) que l'on va manipuler.
// Assure-toi que leurs namespaces sont corrects dans ton code.
use App\Controllers\MainController;
use App\Controllers\CatalogController;

// ------------------------------------------------------
// 3. Instanciation d'AltoRouter
// ------------------------------------------------------
$router = new AltoRouter();

// ------------------------------------------------------
// 4. Configuration du chemin de base
// ------------------------------------------------------
// $_SERVER['BASE_URI'] est généralement défini par le .htaccess et pointe 
// vers la racine du site, terminant par /public.
// Cela permet à AltoRouter de comprendre comment lire l'URL.
$router->setBasePath($_SERVER['BASE_URI']);

// ------------------------------------------------------
// 5. Déclaration des routes
// ------------------------------------------------------
// On liste les routes sous forme de tableaux :
//  array(METHODE, 'URL', 'cible', 'nom_de_la_route')
// La "cible" est elle-même un tableau contenant le 'controller' et 'action'.
// [i:id] capture un entier et le met dans $match['params']['id'].
$router->addRoutes([
    [
        'GET', 
        '/', 
        [ 
            'controller' => MainController::class, 
            'action'     => 'home' 
        ], 
        'home'
    ],
    [
        'GET', 
        '/mentions-legales', 
        [
            'controller' => MainController::class, 
            'action'     => 'legalMentions'
        ], 
        'legal-mentions'
    ],
    [
        'GET', 
        '/catalogue/categorie/[i:id]', 
        [
            'controller' => CatalogController::class, 
            'action'     => 'category'
        ], 
        'catalog-category'
    ],
    [
        'GET', 
        '/catalogue/type/[i:id]', 
        [
            'controller' => CatalogController::class, 
            'action'     => 'type'
        ], 
        'catalog-type'
    ],
    [
        'GET', 
        '/catalogue/marque/[i:id]', 
        [
            'controller' => CatalogController::class, 
            'action'     => 'brand'
        ], 
        'catalog-brand'
    ],
    [
        'GET', 
        '/catalogue/produit/[i:id]', 
        [
            'controller' => CatalogController::class, 
            'action'     => 'product'
        ], 
        'catalog-product'
    ],
    [
        'GET',
        '/test',
        [
            'controller' => MainController::class,
            'action'     => 'test'
        ],
        'test'
    ]
]);

// ------------------------------------------------------
// 6. Faire correspondre l'URL courante à une route
// ------------------------------------------------------
$match = $router->match(); 

// ------------------------------------------------------
// 7. Contrôler si la route existe (match != false)
// ------------------------------------------------------
if ($match !== false) {

    // 7.1. Récupérer le nom complet du controller (namespace + classe)
    $controllerToUse = $match['target']['controller'];

    // 7.2. Récupérer la méthode à invoquer
    $methodToUse = $match['target']['action'];

    // 7.3. Instancier le controller
    $controller = new $controllerToUse();

    // 7.4. Appeler la méthode avec les éventuels paramètres extraits de l'URL
    //      (par ex. l'ID dans [i:id])
    $controller->$methodToUse($match['params']);

} else {
    // ------------------------------------------------------
    // 8. Si la route n'existe pas, on peut afficher une page 404
    // ------------------------------------------------------
    // Soit on redirige vers une méthode "pageNotFound" dans MainController,
    // soit on gère ça directement ici.
    header('HTTP/1.0 404 Not Found');
    echo '404 - Not Found';
    // ou :
    // $controller = new MainController();
    // $controller->pageNotFound();
}
