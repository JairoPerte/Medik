<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser_Copy implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:40'],
            'apellido' => ['required', 'string', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'nif' => ['required', 'string', 'max:10', 'unique:users'],
            'edad' => ['required', 'integer', 'min:0'],
            'peso' => ['required', 'numeric', 'min:0'],
            'altura' => ['required', 'numeric', 'min:0'],
            'numtel' => ['required', 'string', 'max:15'],
            'idMedCab' => ['nullable', 'exists:doctor,id'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'apellido' => $input['apellido'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'nif' => $input['nif'],
            'edad' => $input['edad'],
            'peso' => $input['peso'],
            'altura' => $input['altura'],
            'numtel' => $input['numtel'],
            'idMedCab' => $input['idMedCab']
        ]);
    }
}
