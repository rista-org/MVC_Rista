<?php
    $server = $_SERVER['REQUEST_URI'];
    $url = strtok($server, '?');

    $routes = [
        '/' => '/app/views/login.blade.php',
        '/login'=>'/app/controllers/main.php',
        '/home'=>'/app/views/home.blade.php',
        '/details'=>'/app/controllers/main.php',
        '/connection'=> '/app/controllers/main.php',
        '/requested'=>'/app/controllers/main.php',
        '/connected'=>'/app/controllers/main.php',
        '/logout'=> '/app/controllers/main.php'
    ];
    if(array_key_exists($url, $routes)){
        include __DIR__ .$routes[$url];
    }else{
        echo "error";
    }