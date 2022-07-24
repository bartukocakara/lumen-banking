<?php
require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

date_default_timezone_set(env('APP_TIMEZONE', 'Europe/Istanbul'));

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
*/

$app = new Laravel\Lumen\Application(
    dirname(__DIR__)
);

 $app->withFacades();

 $app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

/*
|--------------------------------------------------------------------------
| Register Config Files
|--------------------------------------------------------------------------

*/

$app->configure('app');
$app->configure('database');
$app->configure('cache');
$app->configure('swagger-lume');
$app->configure('auth');
$app->configure('response-messages');
$app->configure('queue');
$app->configure('broadcasting');
$app->configure('mail');
/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
*/

$app->routeMiddleware([
    'jwt' => App\Http\Middleware\JwtMiddleware::class
 ]);

$app->middleware([
    App\Http\Middleware\XssProtection::class
 ]);

$app->middleware([
    App\Http\Middleware\CorsMiddleware::class
 ]);
// $app->routeMiddleware([
//     "checkIp" => App\Http\Middleware\IpMiddleware::class
//  ]);
/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------

*/
 $app->register(\SwaggerLume\ServiceProvider::class);
 $app->register(App\Providers\AppServiceProvider::class);
//  $app->register(App\Providers\AuthServiceProvider::class);
 $app->register(Illuminate\Redis\RedisServiceProvider::class);
 $app->register(Flipbox\LumenGenerator\LumenGeneratorServiceProvider::class);
 $app->register(Tymon\JWTAuth\Providers\LumenServiceProvider::class);
 $app->register(App\Providers\BroadcastServiceProvider::class);
 $app->register(Illuminate\Mail\MailServiceProvider::class);
 $app->register(Illuminate\Notifications\NotificationServiceProvider::class);
 $app->register(\Illuminate\Mail\MailServiceProvider::class);

 $app->alias('mail.manager', Illuminate\Mail\MailManager::class);
 $app->alias('mail.manager', Illuminate\Contracts\Mail\Factory::class);

 $app->alias('mailer', Illuminate\Mail\Mailer::class);
 $app->alias('mailer', Illuminate\Contracts\Mail\Mailer::class);
 $app->alias('mailer', Illuminate\Contracts\Mail\MailQueue::class);

 //  $app->register(App\Providers\EventServiceProvider::class);
 /*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
*/

app()->setLocale('tr');

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

return $app;
