<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $messages = [
            'email.unique' => 'Пользователь с таким E-Mail уже существует',
        ];

        Validator::make($input, [
            'lastname' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'patronymic' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ], $messages)->validate();

        $avatar = Storage::url("avatars/avatar.webp");

        return User::create([
            'lastname' => $input['lastname'],
            'name' => $input['name'],
            'patronymic' => $input['patronymic'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'avatar' => $avatar,
        ]);
    }
}
