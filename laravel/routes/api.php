<?php

//Public Route
$router->group(['prefix' => 'v1'], function () use ($router) {

    $router->group(['prefix' => 'auth'], function () use ($router) {
        $ctlr = App\Http\Controllers\Api\AuthController::class.'@';

        $router->post('/register', $ctlr . 'register');
        $router->post('/login', $ctlr . 'login');
    });

});

//Protected Route
$router->group(['middleware' => ['auth:sanctum']], function () use ($router){
    $router->group(['prefix' => 'v1'], function () use ($router) {

        $router->group(['prefix' => 'events'], function () use ($router) {
            $ctlr = App\Http\Controllers\Api\EventController::class.'@';

            $router->get('/', $ctlr . 'index');
            $router->get('/active-events', $ctlr . 'activeEvent');
            $router->get('/{id}', $ctlr . 'show');
            $router->post('/', $ctlr . 'create');
            $router->patch('/{id}', $ctlr . 'update');
            $router->delete('/{id}', $ctlr . 'delete');
        });

        $router->group(['prefix' => 'auth'], function () use ($router) {
            $ctlr = App\Http\Controllers\Api\AuthController::class.'@';

            $router->post('/logout', $ctlr . 'logout');
        });

    });
});



