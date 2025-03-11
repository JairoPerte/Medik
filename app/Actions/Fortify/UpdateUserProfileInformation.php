<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:40'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'nif' => ['required', 'string', 'max:10'],
            'numtel' => ['nullable', 'string', 'max:15'],
            'edad' => ['nullable', 'integer', 'min:0'],
            'peso' => ['nullable', 'numeric', 'min:0'],
            'altura' => ['nullable', 'numeric', 'min:0'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        $input['edad'] = $input['edad'] !== '' ? $input['edad'] : null;
        $input['peso'] = $input['peso'] !== '' ? $input['peso'] : null;
        $input['altura'] = $input['altura'] !== '' ? $input['altura'] : null;

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if (
            $input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail
        ) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
                'nif' => $input['nif'],
                'numtel' => $input['numtel'],
                'edad' => $input['edad'],
                'peso' => $input['peso'],
                'altura' => $input['altura'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
