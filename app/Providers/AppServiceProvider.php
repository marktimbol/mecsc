<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Mecsc\Contracts\AgendaInterface;
use Mecsc\Contracts\ScheduleInterface;
use Mecsc\Contracts\UserInterface;
use Mecsc\Repositories\AgendaRepository;
use Mecsc\Repositories\ScheduleRepository;
use Mecsc\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ScheduleInterface::class, ScheduleRepository::class);
        $this->app->bind(AgendaInterface::class, AgendaRepository::class);
        $this->app->bind(UserInterface::class, UserRepository::class);
    }
}
