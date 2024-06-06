<?php

namespace App\Actions\Fortify;

use App\Models\Doctor;
use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

// Esta classe é para registrar um novo usuário/doutor

class CreateNewUser implements CreatesNewUsers
{
    // Regras de validação de senha se o trait não estiver disponível
    protected function passwordRules()
    {
        return ['required', 'string', new \Laravel\Fortify\Rules\Password, 'confirmed'];
    }

    /**
     * Validar e criar um novo usuário registrado.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'type' => $input['type'], // assumindo que o tipo é passado no input
            'password' => Hash::make($input['password']),
        ]);

        if ($input['type'] === 'doctor') {
            Doctor::create([
                'doc_id' => $user->id,
                'status' => 'active',
            ]);
        } elseif ($input['type'] === 'user') {
            UserDetails::create([
                'user_id' => $user->id,
                'status' => 'active',
            ]);
        }

        return $user;
    }
}
