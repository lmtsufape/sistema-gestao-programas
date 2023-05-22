<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Relation::enforceMorphMap([
        //     'aluno' => 'App\Models\Aluno',
        //     'servidor' => 'App\Models\Servidor',
        //     'orientador' => 'App\Models\Orientador',
        // ]);
    }
}
