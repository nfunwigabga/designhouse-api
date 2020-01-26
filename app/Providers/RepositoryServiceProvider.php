<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\Contracts\{
    IDesign,
    IUser,
    IComment
};
use App\Repositories\Eloquent\{
    DesignRepository,
    UserRepository,
    CommentRepository
};

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
        $this->app->bind(IDesign::class, DesignRepository::class);
        $this->app->bind(IUser::class, UserRepository::class);
        $this->app->bind(IComment::class, CommentRepository::class);
    }
}
