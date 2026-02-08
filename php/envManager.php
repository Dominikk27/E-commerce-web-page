<?php 

function load_env($path){
    
    $env = [];

    if(!file_exists($path)){
        return $env;
    }



    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);


    foreach($lines as $line){
        if(strpos(trim($line), '#') === 0){
            continue;
        }

        [$name, $value] = explode("=", $line, 2);

        $name = trim($name);
        $value = trim($value);

        $env[$name] = $value; 

        if (!isset($_ENV[$name])){
            $_ENV[$name] = $value;
            putenv("$name=$value");
        }
    }

    return $env;
}


#load_env(__DIR__ . '/.env');

#$API_STIHL = $_ENV['URL'];

#echo "WORKS WITH" . $API_STIHL

?>