<?php

use App\Http\Routes;

// Determinando rotas com os métodos estáticos
Routes::get("/", "HomeController@index");
Routes::post("/", "HomeController@index");
Routes::put("/", "HomeController@index");
Routes::delete("/", "HomeController@index");

// $routes = Routes::routes();