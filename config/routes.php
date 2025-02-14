<?php

use App\Core\Router;
use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\AnnounceController;
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
$router->addRoute('GET', '/admin/companies', [CompanyController::class, 'companiesPage']);
$router->addRoute('POST', '/admin/companies/add_company', [CompanyController::class, 'createCompany']);
$router->addRoute('GET','/admin/companies/get/{id}', [CompanyController::class, 'getEditCompany']);
$router->addRoute('POST','/admin/companies/edit', [CompanyController::class, 'updateCompany']);




// Admin Announecement
$router -> addRoute("GET","/admin/announcements",[AnnounceController::class, 'annoncements']);
$router -> addRoute("POST","/admin/announcements/add",[AnnounceController::class, 'create']);
$router -> addRoute("POST","/admin/announcements/edit",[AnnounceController::class, 'updateAnnounce']);
$router -> addRoute("GET","/admin/announces/get/{id}",[AnnounceController::class, 'getEditAnnounce']);

// Admin trashed Announecement
$router -> addRoute("GET","/admin/announcements/trashed",[AnnounceController::class, 'trashedAnnoncements']);


// Admin companies

$router -> addRoute("GET","/getCompany",[CompanyController::class, 'getCompany']);
$router->addRoute('DELETE', '/deleteCompany/{id}', [CompanyController::class, 'deleteCompany']);
$router -> addRoute('GET','/getSearchedCompanies',[CompanyController::class,'getSearchedCompanies']);


//<========================================================================================>
$router -> addRoute('GET','/getAnnouncements', [AnnounceController::class,'getAnnouncements']);
$router -> addRoute('GET','/getSearchedAnnouncements', [AnnounceController::class,'getSearchedAnnouncements']);
$router -> addRoute('GET','/getFilteredAnnouncements', [AnnounceController::class,'getFilteredAnnouncements']);
$router -> addRoute('GET','/getDeletedAnnouncements', [AnnounceController::class,'getDeletedAnnouncements']);
$router->addRoute('DELETE', '/deleteAnnouncement/{id}', [AnnounceController::class, 'deleteAnnouncement']);
$router->addRoute('DELETE', '/permanentlyDeleteAnnouncement/{id}', [AnnounceController::class, 'permanentlyDeleteAnnouncement']);
$router->addRoute('POST', '/restoreAnnouncement/{id}', [AnnounceController::class, 'restoreAnnouncement']);
