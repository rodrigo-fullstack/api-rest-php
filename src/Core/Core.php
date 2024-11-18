<?php


namespace App\Core;

Class Core{
    // URLs
    public static function dispatch(array $routes){
        // dump($routes);

        $url = "/";

        $namespaceController = "App\\Controllers\\";

        // Se houver url além de /, concatena na $url com essa nova url
        isset($_GET['url']) && $url .= $_GET['url'];

        foreach($routes as $route){
            // RegExpression para determinar quando há id na url, convertendo para alfanumérico
            // Está aceitando passar id pelo url
            $pattern = '#^' . preg_replace('/{id}/', '([\w-]+)', $route['path']) . '$#';

            if(preg_match($pattern, $url, $matches)){
                // Impede de retornar o path
                array_shift($matches);

                //Separa o action yyyyController do método a partir do @
                [$controller, $action] = explode('@', $route['action']);

                // Coleta o nome completo do namespace da controller
                $controller =  $namespaceController . $controller;
                // instancia a controladora
                $extendController = new $controller;

                // Executa o método de acordo com o que foi passado em $action;
                $extendController->$action();

                // dump($matches);
            }
        }

    }   
}