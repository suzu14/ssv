<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
        \URL::forceScheme('https');
        $this->app['request']->server->set('HTTPS','on');
        
        //$this->registerPolicies();
        /*
        //管理者
        Gate::define('admin', function (User $user) {
            return ($user->role_id == 0);
        });
        
        //グループ代表
        Gate::define('leader', function (User $user) {
            return ($user->role_id == 1);
        });
        
        //一般ユーザー
        Gate::define('general', function (User $user) {
            return ($user->role_id == 2);
        });*/
    }
}
