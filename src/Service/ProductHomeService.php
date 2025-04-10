<?php

namespace App\Service;

use Symfony\Component\Filesystem\Exception\FileNotFoundException;

class ProductHomeService
{
    public function getProducts():array
    {
        $filePath = __DIR__.'/../Ressource/products.json';

        if (!file_exists($filePath)) {
            throw new FileNotFoundException('Raté ! Where is the file products.json ?');
        }

            $json = file_get_contents($filePath);
            return json_decode($json, true) ?? [];
    }
}