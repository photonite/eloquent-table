<?php

namespace Stevebauman\EloquentTable;

use Illuminate\Pagination\PaginationServiceProvider as LaravelPaginationServiceProvider;

/**
 * Class PaginationServiceProvider
 * @package Stevebauman\EloquentTable
 */
class PaginationServiceProvider extends LaravelPaginationServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;
    
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindShared('paginator', function($app)
        {
            $paginator = new TablePaginatorFactory($app['request'], $app['view'], $app['translator']);

            $paginator->setViewName($app['config']['view.pagination']);

            $app->refresh('request', $paginator, 'setRequest');

            return $paginator;
        });
    }
    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('paginator');
    }
}