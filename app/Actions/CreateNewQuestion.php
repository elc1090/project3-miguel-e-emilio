<?php

namespace App\Actions;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\Question;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewQuestion
{
    /**
     * Create a newly registered user.
     *
     * @param User $user
     * @return Question
     */
    public function create(User $user): Question
    {
        $seed = bin2hex(openssl_random_pseudo_bytes(20));
        return Question::create([
            'user_id' => $user->id,
            'seed' => $seed
        ]);
    }
}
