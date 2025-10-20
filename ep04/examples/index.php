<?php

require __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router("../" . URL_BASE);
$router->group(null);
$router->get("/", function ($data) {
      echo "<h1>Olá Mundo!</h1>";
      echo "<pre>";
      var_dump($data);
      echo "</pre>";
});

$router->get("/contato", function ($data) {
      echo "<h1>Página de Contato</h1>";
      echo "<pre>";
      var_dump($data);
      echo "</pre>";
});

$router->group("ops");
$router->get("/{errcode}", function($data) {
      echo "<h1>Erro {$data["errcode"]}</h1>";
      echo "<pre>";
      var_dump($data);
      echo "</pre>";
});

$router->dispatch();

if($router->error()) {
      $router->redirect("/ops/{$router->error()}");
}