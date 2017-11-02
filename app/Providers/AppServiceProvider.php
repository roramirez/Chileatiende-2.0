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
        setlocale(LC_ALL, env('PHP_LOCALE'));

        Schema::defaultStringLength(191);

        $this->bootClaveUnicaSocialite();

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

    private function bootClaveUnicaSocialite()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'claveunica',
            function ($app) use ($socialite) {
                $config = $app['config']['services.claveunica'];
                return $socialite->buildProvider(\App\ClaveUnicaProvider::class, $config);
            }
        );
    }
}
