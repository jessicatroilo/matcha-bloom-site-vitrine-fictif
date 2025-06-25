<?php

namespace App\Service;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class ProductHomeService
{
    private string $filePath;

    /**
     * Constructeur de la classe ProductHomeService.
     *
     * @param string $filePath Le chemin du fichier JSON contenant les produits.
     */
    public function __construct()
    {
        $this->filePath = __DIR__.'/../Ressource/products.json';
    }

    /**
     * Récupère les produits depuis le fichier JSON.
     *
     * @return array Un tableau associatif contenant les produits.
     * @throws FileNotFoundException Si le fichier products.json n'est pas trouvé.
     */    
    public function getProducts():array
    {
        $filePath = $this->filePath;
        
        if (!file_exists($filePath)) {
            throw new FileNotFoundException('Raté ! Where is the file products.json ?');
        }

            $json = file_get_contents($filePath);
            return json_decode($json, true) ?? [];
    }

    /**
     * Enregistre les produits dans le fichier JSON.
     *
     * @param array $products Un tableau associatif contenant les produits à enregistrer.
     * @return void
     */
    public function saveProducts(array $products): void
    {
        file_put_contents($this->filePath, json_encode($products, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}