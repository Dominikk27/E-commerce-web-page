<?php
    

    function readProducts(){
        $dataPath = null;
        if (!$dataPath){
            $dataPath = __DIR__ . '/../products/products.json';
        }

        if(!file_exists($dataPath)){
            echo "Data file not found!";
            return [];
        }

        $json = file_get_contents($dataPath);

        $data = json_decode($json, true);

        return $data['products'] ?? [];
    }

    $products = readProducts();

    print_r($products);

?>