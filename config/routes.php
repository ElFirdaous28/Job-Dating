<?php

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\AnnounceController;
$router = new Router();

//<========================================================================================>

$router->addRoute('GET', '/', [HomeController::class, 'welcome']);

$router->addRoute('GET', '/register', [AuthController::class, 'registerPage']);
$router->addRoute('POST', '/handleRegister', [AuthController::class, 'handleRegister']);

$router->addRoute('GET', '/login', [AuthController::class, 'loginPage']);
$router->addRoute('POST', '/handleLogin', [AuthController::class, 'handleLogin']);

$router->addRoute('GET', '/logout', [AuthController::class, 'logout']);
//<========================================================================================>
$router->addRoute('GET', '/admin/home', [HomeController::class, 'adminHome']);
$router->addRoute('GET', '/student/home', [HomeController::class, 'userHome']);
// Admin Announecement
$router -> addRoute("GET","/admin/announcements",[AnnounceController::class, 'annoncements']);
$router -> addRoute("GET","/admin/announcements/add",[AnnounceController::class, 'create']);
