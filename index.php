<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(URL_BASE);

$router->namespace("Source\App");

$router->group(null);
$router->get("/", "ProcessController:index");
$router->get("/new", "ProcessController:new");
$router->post("/create", "ProcessController:create");
$router->get("/edit/{id}", "ProcessController:edit");
$router->put("/edit/update", "ProcessController:update");
$router->delete("/delete/{id}", "ProcessController:delete");

$router->dispatch();

$router->group("erro");
$router->get("/{errcode}", "ProcessController:error");

if($router->error()) {
    $router->redirect("/erro/{$router->error()}");
}