<?php

namespace App\Providers;

use App\Http\Clients\IceAndFireClient;
use Illuminate\Support\ServiceProvider;

class IceAndFireProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IceAndFireClient::class, function (){
            $config = $this->app->get('config')['iceandfire'];
            return new IceAndFireClient([
                'base_uri' => $config['base_uri'],
                'headers' => [

                ]
            ]);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
