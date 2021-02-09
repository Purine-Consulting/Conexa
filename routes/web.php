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
        $router->get('/', 'UserController@showAll');
        $router->get('/{id}', 'UserController@showOne');
        $router->put('/{id}', 'UserController@update');
        $router->delete('/{id}', 'UserController@delete');
    });

    // Mentor management endpoints
    $router->group(['prefix' => 'mentors'], function () use ($router) {
        $router->get('/', 'MentorController@showAll');
        $router->get('/{id}', 'MentorController@showOne');
        $router->put('/{id}', 'MentorController@update');
        $router->delete('/{id}', 'MentorController@delete');
    });
    
    // Mentee management endpoints
    $router->group(['prefix' => 'mentees'], function () use ($router) {
        $router->get('/', 'MenteeController@showAll');
        $router->get('/{id}', 'MenteeController@showOne');
        $router->put('/{id}', 'MenteeController@update');
        $router->delete('/{id}', 'MenteeController@delete');
    });

    // Session management endpoints
    $router->group(['prefix' => 'sessions'], function () use ($router) {
        $router->post('/', 'SessionController@create');
        $router->get('/', 'SessionController@showAll');
        $router->get('/{id}', 'SessionController@showOne');
        $router->put('/{id}', 'SessionController@update');
        $router->delete('/{id}', 'SessionController@delete');
    });
    

    // Activity management endpoints
    $router->group(['prefix' => 'activities'], function () use ($router) {
        $router->post('/', 'ActivityController@create');
        $router->get('/', 'ActivityController@showAll');
        $router->get('/{id}', 'ActivityController@showOne');
        $router->put('/{id}', 'ActivityController@update');
        $router->delete('/{id}', 'ActivityController@delete');
        $router->get('/{id}/session', 'ActivityController@showSession');
    });
    
    $router->group(['middleware' => 'auth:api'], function () use ($router) {
    });
});
