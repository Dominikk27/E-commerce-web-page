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

        
        if (!empty($g->parametre_tab)) {
            $parameters = parseParametreList((string)$g->parametrelist);
        } else {
            $parameters = parseParametreTab((string)$g->parametre_tab);
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



    function parseParametreTab(string $input): array
    {
        $text = html_entity_decode($input, ENT_QUOTES | ENT_HTML5);
        $text = strip_tags($text);
        $text = preg_replace('/\s+/', ' ', $text);

        $parts = array_map('trim', explode('|', $text));
        $parameters = [];

        for ($i = 0; $i < count($parts) - 1; $i += 2) {
            $key = $parts[$i] ?? null;
            $value = $parts[$i + 1] ?? null;

            if (!$key || !$value) continue;

            $parameters[$key] = $value;
        }

        return $parameters;
    }

    function parseParametreList(string $html): array
    {
        $html = html_entity_decode($html, ENT_QUOTES | ENT_HTML5);

        $dom = new DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML('<meta charset="utf-8">'.$html);
        libxml_clear_errors();

        $xpath = new DOMXPath($dom);
        $items = $xpath->query('//li');

        $parameters = [];

        foreach ($items as $li) {
            $text = trim(preg_replace('/\s+/', ' ', $li->textContent));

            if (strpos($text, ':') !== false) {
                [$key, $value] = explode(':', $text, 2);
                $parameters[trim($key)] = trim($value);
            }
        }

        return $parameters;
    }

?>