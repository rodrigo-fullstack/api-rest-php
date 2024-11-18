<?php

use App\Http\Routes;

// Determinando rotas com os métodos estáticos
// Padronização do Action é o nome da controladora separada por @ e o método da controladora
Routes::get("/", "HomeController@index");
Routes::post("/", "HomeController@index");
Routes::put("/", "HomeController@index");
Routes::delete("/", "HomeController@index");

// $routes = Routes::routes();