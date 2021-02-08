<?php

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

$router->group(['prefix' => 'api'], function () use ($router) {
    // Authentication management
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('login', 'AuthController@login');
        $router->post('register', 'AuthController@register');
    });

    // User management endpoints
    $router->group(['prefix' => 'users'], function () use ($router) {
        $router->get('/', 'UserController@showAllUsers');
        $router->get('/{id}', 'UserController@showOneUser');
    });

    // Mentor management endpoints
    $router->group(['prefix' => 'mentors'], function () use ($router) {
        $router->get('/', 'MentorController@showAllMentors');
        $router->get('/{id}', 'MentorController@showOneMentor');
        $router->put('update/{id}', 'MentorController@update');
        $router->delete('delete/{id}', 'MentorController@delete');
    });

    // Mentee management endpoints
    $router->group(['prefix' => 'mentees'], function () use ($router) {
        $router->get('/', 'MenteeController@showAllMentors');
        $router->get('/{id}', 'MenteeController@showOneMentor');
        $router->put('update/{id}', 'MenteeController@update');
        $router->delete('delete/{id}', 'MenteeController@delete');
    });

    $router->group(['middleware' => 'auth:api'], function () use ($router) {
    });
});
