<?php 
    require __DIR__ . '/envManager.php';

    $env = load_env(__DIR__ . '/.env');

    
    $url = $env['URL'] ?? null;

    $ch = curl_init($url);

    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 10,
    ]);

    $res = curl_exec($ch);

    if ($res === false){
        die("chyba cURL: " . curl_error($ch));
    }

    curl_close($ch);

    $xml = simplexml_load_string($res);


    $namespaces = $xml->getNamespaces(true);
    $g = $xml->children($namespaces['g']);


    $products = [];

    foreach ($xml->channel->item as $item){
        $g = $item->children($namespaces['g']);

        [$price, $currency] = explode(' ', (string)$g->price);

        $parametre_tab = (string) $g->parametre_tab;
        $parametre_tab = strip_tags($parametre_tab);

        $parameters_parts = explode('|', $parametre_tab);
        
        $parameters = [];
        for($i = 0; $i < count($parameters_parts)-2; $i+=3){
            $name = trim($parameters_parts[$i]);
            $value = trim($parameters_parts[$i+1]) .' '. $parameters_parts[$i+2];
            $parameters[$name] = $value;
        }


        $products[] = [
            'id' => (string) $g->id,
            'name' => trim((string) $g->title),
            'price' => (float) $price,
            'sale_price' => isset($g->sale_price) ? (float)$g->sale_price : null,
            'currency' => $currency,
            'image' => (string) $g->image_link,
            'category' => (string) $g->product_type,
            'type' => (string) $g->predpona,
            'brand' => (string) $g->brand,
            'description' => (string) $g->description,
            'parameters' => $parameters,
        ];
    }

    file_put_contents(
        __DIR__ . '/../products/products.json',
        json_encode([
            'checked' => date('Y-m-d H:i:s'),
            'count' => count($products),
            'products' => $products
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
    
    echo "OK – uložených produktov: " . count($products);
    print_r($products[0]);
?>