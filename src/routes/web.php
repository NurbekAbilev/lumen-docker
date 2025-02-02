<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/api/user/register', ['uses' => 'UserController@userRegister']);
$router->post('/api/user/sign-in', ['uses' => 'UserController@userSignIn']);

$router->post('/api/user/recover-password', ['uses' => 'PasswordRecoveryController@passwordRecoverySendEmail']);
$router->patch('/api/user/recover-password', ['uses' => 'PasswordRecoveryController@recoverPassword']);

$router->group(['middleware' => 'auth'], function () use ($router) {
    $router->post('/api/user/companies', ['uses' => 'CompaniesController@createCompany']);
    $router->get('/api/user/companies', ['uses' => 'CompaniesController@companyIndex']);
});
