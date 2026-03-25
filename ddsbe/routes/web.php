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

//
$router->get('/test', function () {
    return 'OK';
});
$router->get('/run-migrations', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Migrations run successfully';
});

/*
// unsecure routes 
$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('/users1',['uses' => 'UserController@getUsers']);
});
*/

$router->group(['middleware' => 'auth.access'], function () use ($router) {

    // more simple routes 
    $router->get('/users', 'UserController@index');   // Get all users
    $router->post('/users', 'UserController@add');  // create new user 
    $router->get('/users/{id}', 'UserController@show'); // get user by id
    $router->put('/users/{id}', 'UserController@update'); // update user 
    $router->patch('/users/{id}', 'UserController@update'); // update user 
    $router->delete('/users/{id}', 'UserController@delete'); // delete 

    //for userjob
    $router->get('/userjob', 'UserJobController@index'); 
    $router->get('/userjob/{id}', 'UserJobController@show'); // get user by id
});