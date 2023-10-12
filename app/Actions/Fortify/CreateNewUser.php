<?php

namespace App\Actions\Fortify;

use App\Models\Information;
use App\Models\Newsletter;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Str;


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
        Validator::make($input, [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'phone' => ['required'],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ])->validate();

         $user = User::create([
            // 'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
        // Créer une entrée dans la table d'information
        Newsletter::create([
            'email' => $user->email,
        ]);

        $information = new Information();
        $information->id_user = $user->id;
        $information->nom = $input['nom'];
        $information->prenom = $input['prenom'];
        $information->phone = $input['phone'];
        $slug = Str::slug($information->nom .$information->nom. ' ' . time());
        $information->slug = $slug;
        $information->save();

        $user->roles()->attach($user->id, ['id_role' => 3]);

        return $user;
    }
}
