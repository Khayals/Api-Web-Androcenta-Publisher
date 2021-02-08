<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$router->group(['prefix' => 'v1'],function () use ($router) {

    $router->group(['prefix' => 'role'], function () use($router) {
        $router->post('create',['uses' => 'Role\CreateController']);
        $router->get('get/all',['uses' => 'Role\GetAllController']);
    });

    $router->group(['prefix' => 'user'], function () use($router) {
        $router->post('create',['uses' => 'User\CreateController']);
        $router->post('login',['uses' => 'User\LoginController']);
        $router->get('get/all',['uses' => 'User\GetAllController']);
        $router->get('get',['uses' => 'User\GetController'])->middleware('jwt.auth');
        $router->get('logout',['uses' => 'User\LogoutController'])->middleware('jwt.auth');
    });

    $router->group(['prefix' => 'bookcategory'], function () use($router) {
        $router->post('create',['uses' => 'BookCategory\CreateController'])->middleware('jwt.auth');
        $router->get('get/all',['uses' => 'BookCategory\GetAllController']);
        $router->delete('delete/{id}',['uses' => 'BookCategory\DeleteController']);
    });

    $router->group(['prefix' => 'book'], function () use($router) {
        $router->post('create',['uses' => 'Book\CreateController'])->middleware('jwt.auth');
        $router->delete('delete/{id}',['uses' => 'Book\DeleteController']);
        $router->get('get/all',['uses' => 'Book\GetAllController']);
        // $router->delete('delete/{id}',['uses' => 'BookCategory\DeleteController']);
    });

});

