<?php

namespace App\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Type;

class CatalogController extends CoreController
{
    /**
     * Affiche les produits d'une catégorie
     *
     * @param array $params
     */
    public function category($params)
    {
        // Récupération de l'ID de la catégorie à partir des paramètres
        $id_category = $params['id'];

        // Récupère les détails de la catégorie
        $categoryModel = new Category();
        $category = $categoryModel->find($id_category);

        // Récupère les produits de cette catégorie
        $productModel = new Product();
        $products = $productModel->findByCategory($id_category);

        // Affiche la vue associée avec les données
        $this->show('category', [
            'categoryId' => $id_category,
            'category' => $category,
            'products' => $products,
        ]);
    }

    /**
     * Affiche les produits associés à un type
     *
     * @param array $params
     */

    public function type($params)
    {
        // Récupération de l'ID du type à partir des paramètres
        $id_type = $params['id'];

        // Récupère les détails du type
        $productModel = new Product();
        $products = $productModel->findByType($id_type);

        // Récupère les produits liés à ce type
        $productModel = new Product();
        $products = $productModel->findByType($id_type);

        // Affiche la vue associée avec les données
        $this->show('type', [
            'typeId' => $id_type,
            'type' => $id_type,
            'products' => $products,
        ]);
    }

    /**
     * Affiche les produits associés à une marque
     *
     * @param array $params
     */
    public function brand($params)
    {
        // Récupération de l'ID de la marque à partir des paramètres
        $id_brand = $params['id'];

        // Récupère les détails de la marque
        $brandModel = new Brand();
        $brand = $brandModel->find($id_brand);

        // Récupère les produits associés à cette marque
        $productModel = new Product();
        $products = $productModel->findByBrand($id_brand);

        // Affiche la vue associée avec les données
        $this->show('brand', [
            'brandId' => $id_brand,
            'brand' => $brand,
            'products' => $products,
        ]);
    }

    /**
     * Affiche les détails d'un produit
     *
     * @param array $params
     */
    public function product($params)
    {
        // Récupération de l'ID du produit à partir des paramètres
        $id_product = $params['id'];

        // Récupère les détails du produit
        $productModel = new Product();
        $product = $productModel->find($id_product);

        // Affiche la vue associée avec les données
        $this->show('product', [
            'productId' => $id_product,
            'product' => $product,
        ]);
    }
}
