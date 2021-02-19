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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->group(['prefix' => 'api'], function () use ($router) {
    // Authentication management
    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('login', 'AuthController@login');
        $router->post('register', 'AuthController@register');
        $router->post('logout', 'AuthController@logout');
    });

    $router->group(['middleware' => 'auth:api'], function () use ($router) {
        // User management endpoints
        $router->group(['prefix' => 'users', 'middleware' => ['role:admin']], function () use ($router) {
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
            $router->get('/{id}/skill', 'MentorController@getSkill');
            $router->post('/{id}/skill', 'MentorController@setSkill');
            $router->delete('/{id}/skill', 'MentorController@deleteSkill');
            $router->get('/{id}/area', 'MentorController@getArea');
            $router->post('/{id}/area', 'MentorController@setArea');
            $router->delete('/{id}/area', 'MentorController@deleteArea');
        });

        // Mentee management endpoints
        $router->group(['prefix' => 'mentees'], function () use ($router) {
            $router->get('/', 'MenteeController@showAll');
            $router->get('/{id}', 'MenteeController@showOne');
            $router->put('/{id}', 'MenteeController@update');
            $router->delete('/{id}', 'MenteeController@delete');
            $router->get('/{id}/skill', 'MenteeController@getSkill');
            $router->post('/{id}/skill', 'MenteeController@setSkill');
            $router->delete('/{id}/skill', 'MenteeController@deleteSkill');
            $router->get('/{id}/area', 'MenteeController@getArea');
            $router->post('/{id}/area', 'MenteeController@setArea');
            $router->delete('/{id}/area', 'MenteeController@deleteArea');
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

        // Area management endpoints
        $router->group(['prefix' => 'areas'], function () use ($router) {
            $router->post('/', 'AreaController@create');
            $router->get('/', 'AreaController@showAll');
            $router->get('/{id}', 'AreaController@showOne');
            $router->put('/{id}', 'AreaController@update');
            $router->delete('/{id}', 'AreaController@delete');
        });

        // Skill management endpoints
        $router->group(['prefix' => 'skills'], function () use ($router) {
            $router->post('/', 'SkillController@create');
            $router->get('/', 'SkillController@showAll');
            $router->get('/{id}', 'SkillController@showOne');
            $router->put('/{id}', 'SkillController@update');
            $router->delete('/{id}', 'SkillController@delete');
        });

        // Invoice management endpoints
        $router->group(['prefix' => 'invoices'], function () use ($router) {
            $router->post('/', 'InvoiceController@create');
            $router->get('/', 'InvoiceController@showAll');
            $router->get('/{id}', 'InvoiceController@showOne');
            $router->put('/{id}', 'InvoiceController@update');
            $router->put('/{id}/cancel', 'InvoiceController@cancel');
        });

        // Payment management endpoints
        $router->group(['prefix' => 'payments'], function () use ($router) {
            $router->post('/', 'PaymentController@create');
            $router->get('/', 'PaymentController@showAll');
            $router->get('/{id}', 'PaymentController@showOne');
            $router->put('/{id}', 'PaymentController@update');
        });

        // Mark management endpoints
        $router->group(['prefix' => 'marks'], function () use ($router) {
            $router->post('/', 'MarkController@create');
            $router->get('/', 'MarkController@showAll');
            $router->get('/{id}', 'MarkController@showOne');
            $router->put('/{id}', 'MarkController@update');
            $router->delete('/{id}', 'MarkController@delete');
        });
    });
});
