<?php

namespace Rush4u\CommandBus\Vendor\Laravel;

use Illuminate\Support\ServiceProvider;
use Rush4u\CommandBus\Command\CommandBusInterface;
use Rush4u\CommandBus\Query\QueryBusInterface;
use Rush4u\CommandBus\Vendor\Laravel\Command\CommandBus;
use Rush4u\CommandBus\Vendor\Laravel\Query\QueryBus;

class Rush4uCommandBusServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            CommandBusInterface::class,
            CommandBus::class
        );

        $this->app->bind(
            QueryBusInterface::class,
            QueryBus::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
