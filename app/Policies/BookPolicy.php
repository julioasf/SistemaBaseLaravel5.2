<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Book;
use App\User;

class BookPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        //
    }*/

    public function update(User $user, Book $book)
    {
        return $user->id == $book->user_id;
    }

    public function before($user, $book)
    {
        if ($user->admin) {
            return true;
        }
    }
}
