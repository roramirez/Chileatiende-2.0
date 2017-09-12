<?php

namespace App\Providers;

use App\ScoutEngines\Elasticsearch\ElasticsearchEngine;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Scout\EngineManager;
use Elasticsearch\ClientBuilder as ElasticBuilder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        app(EngineManager::class)->extend('elasticsearch', function($app) {
            return new ElasticsearchEngine(ElasticBuilder::create()
                ->setHosts(config('scout.elasticsearch.hosts'))
                ->build(),
                config('scout.elasticsearch.index')
            );
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
