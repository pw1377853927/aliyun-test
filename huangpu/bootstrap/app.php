<?php


use Illuminate\Session\Middleware\StartSession;

require_once __DIR__.'/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(
    dirname(__DIR__)
))->bootstrap();

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
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
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

// 注册 Excel
$app->register(Maatwebsite\Excel\ExcelServiceProvider::class);

// 设置session别名
$app->alias('session', 'Illuminate\Session\SessionManager');
/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/
// 载入所有config配置
foreach (scandir(__DIR__ . '/../config') as $configItem) {
    if (!in_array($configItem, ['.', '..'])) {
        $app->configure(str_replace('.php', '', $configItem));
    }
}


 $app->middleware([
     Illuminate\Session\Middleware\StartSession::class,
 ]);

 $app->routeMiddleware([
     'auth'           => App\Http\Middleware\Authorization::class,
 ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// $app->register(App\Providers\AppServiceProvider::class);
 $app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);
$app->register(Illuminate\Session\SessionServiceProvider::class);
$app->register(Illuminate\Redis\RedisServiceProvider::class);
$app->register(Illuminate\Cookie\CookieServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/api.php';
});

$app->router->group([
    'namespace' => 'App\Http\Controllers',
], function ($router) {
    require __DIR__.'/../routes/web.php';
});

return $app;
