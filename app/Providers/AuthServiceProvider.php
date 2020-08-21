<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('ui-token', function($request) {
            $token = $request->header('Authorization');
            if (!$token) return null;
            $lt = \App\LoginToken::where('value', $token)->where('expires_at', '<', Carbon::now())->first();
            if ($lt) {
                $lt->update(['expires_at'=>Carbon::now()]);
                return $lt->user;
            }
        });
    }
}
