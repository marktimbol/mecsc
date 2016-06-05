<?php

namespace App\Providers;

use App\Agenda;
use App\Company;
use App\Exhibitor;
use App\Role;
use App\Schedule;
use App\Thread;
use App\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

        $router->model('users', User::class);
        $router->model('contacts', User::class);
        $router->model('speakers', User::class);
        $router->model('roles', Role::class);
        $router->model('schedules', Schedule::class);
        $router->model('agendas', Agenda::class);
        $router->model('companies', Company::class);
        $router->model('exhibitors', Exhibitor::class);
        $router->model('threads', Thread::class);
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function map(Router $router)
    {
        $router->group(['namespace' => $this->namespace], function ($router) {
            require app_path('Http/routes.php');
        });
    }
}
