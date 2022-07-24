<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;

// SWAGGER REDIRECT ROUTE
$router->get('/', function () {
    return redirect("api/v1/documentation");
});

$router->group([
    "prefix" => "api/v1",
    ], function($router){
        // Accounts
        $router->post('/accounts', 'AccountController@create'); //+
        $router->get('/accounts', 'AccountController@list'); // +
        $router->get('/accounts/{AccountID}', 'AccountController@list'); // +
        $router->delete('/accounts/{AccountID}', 'AccountController@delete'); // +
        // Transactions
        $router->get('/transactions', 'TransactionController@list');
        $router->post('/transactions', 'TransactionController@create');
        $router->patch('/transactions/withdraws/{AccountID}', 'TransactionController@withdraws');
        $router->patch('/transactions/deposits/{AccountID}', 'TransactionController@deposits');
        // Entries
        $router->post('/entries/synchronisation', 'EntryController@synchronisation');

    }
);
