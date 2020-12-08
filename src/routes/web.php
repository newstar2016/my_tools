<?php

$router->get('/', ['uses' => 'IndexController@index']);
$router->get('doc/{name}', ['uses' => 'DocController@index']);

// 业务接口
$router->group(['prefix' => 'app', 'namespace' => 'App'], function () use ($router) {
    //测试控制器
    $router->post('demo/test', ['uses' => 'Demo\TestController@index']);
    $router->get('demo/list', ['uses' => 'Demo\ListController@index']);
    $router->post('demo/order', ['uses' => 'Demo\OrderController@index']);
    $router->post('demo/append-order', ['uses' => 'Demo\AppendOrderController@index']);
    $router->post('demo/cart-to-confirm', ['uses' => 'Demo\CartToConfirmController@index']);
    //测试订单构建者模式
    $router->post('demo/test-build', ['uses' => 'Demo\TestOrderBuilderController@index']);
    //从文件中筛选订单号
    $router->post('demo/screening-order-number', ['uses' => 'Demo\ScreeningPayBackOrderNumberController@index']);
    //json转xml
    $router->post('demo/json-to-xml', ['uses' => 'Demo\JsonToXmlController@index']);
});

// 服务接口
$router->group(['prefix' => 'service', 'namespace' => 'Service', 'middleware' => ['access', 'sign']], function () use ($router) {
    $router->get('demo/list', ['uses' => 'Demo\ListController@index']);
});
