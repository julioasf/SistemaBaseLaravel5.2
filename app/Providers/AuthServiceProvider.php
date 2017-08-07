<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Policies\BookPolicy;
use App\Book;
use App\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    /*protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];*/

    // Para testes. Original, acima.
    protected $policies = [
        Book::class => BookPolicy::class  // --> app/Policies
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        // Criado para testes de autorizacao.
        // se $user->id == $book->user_id, retorna true
        // Nao utilizar type hinting
        //$gate->define('show-book', function (User $user, Book $book) {
        /*$gate->define('show-book', function ($user, $book) {
            return $user->id == $book->user_id;
        });

        $gate->define('update-book', function ($user, $book) {
            return $user->id == $book->user_id;
        });*/
    }
}
