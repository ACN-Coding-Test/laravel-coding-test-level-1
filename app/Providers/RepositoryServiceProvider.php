<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\BaseRepository;
use App\Http\Repositories\EventRepository;
use App\Http\Repositories\Contracts\EventContract;
use App\Http\Repositories\Contracts\BaseRepositoryContract;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(BaseRepositoryContract::class, BaseRepository::class);
        $this->app->bind(EventContract::class, EventRepository::class);
    }
}
