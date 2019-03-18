<?php

namespace App\Providers;

use post; 

use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    
    //protected $defer = true;

    public function boot()
    {
        //
        view()->composer('layouts.sidebar', function($view){        
            $archives = \App\Post::archives(); 
            //print_r($archives);      
            // $tags = \App\Tag::has('posts')->pluck('name');           
            // $view->with(compact('archives','tags'));
            $view->with('archives', \App\Post::archives());
            $view->with('tags', \App\Tag::has('posts')->pluck('name'));
        }); 
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        \App::singleton(Stripe::class, function(){
            //$app->make('');
            //echo "tex";
            //return new Stripe(config('services.stripe.secret'));
        });
    }


    public function provides()
    {
        return [Post::class];
    }
}
