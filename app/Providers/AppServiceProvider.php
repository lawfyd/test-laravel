<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use function preg_match;
use Illuminate\Database\Eloquent\Relations\Relation;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('is_author', function ($attribute, $value, $parameters, $validator) {
            $regular = '/^([A-ZА-ЯЁ][a-zа-яё]+)\s([A-ZА-ЯЁ][a-zа-яё]+)$/u';
            $param = preg_match($regular, $value);
            if($param) return true;
            return false;
        }, 'The name must be Name Surname');

        Relation::morphMap([
            'category' => 'App\Category',
            'posts' => 'App\Post',
        ]);
    }
}
