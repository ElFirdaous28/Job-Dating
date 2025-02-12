<?php

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\AnnounceCont;
use App\Controllers\CompanyController;

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

//<========================================================================================>
$router->addRoute('GET', '/admin/companies', [CompanyController::class, 'index']);
$router->addRoute('POST', '/admin/add_company', [CompanyController::class, 'createCompany']);
// $router->addRoute('POST','/admin/updateCompany/{id}', [CompanyController::class, 'update']);
// $router->addRoute('POST','/admin/deleteCompany/{id}', [CompanyController::class, 'destroy']);




// Admin Announecement
$router -> addRoute("GET","/admin/announcements",[AnnounceCont::class, 'index']);

//<========================================================================================>
$router -> addRoute('GET','/getAnnouncements', [AnnounceCont::class,'getAnnouncements']);
