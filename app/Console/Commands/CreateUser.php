<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Enter name');

        $nameValidator = Validator::make(['name' => $name], ['name' => ['required', 'string', 'max:255']]);

        if ($nameValidator->fails()) {
            $this->error($nameValidator->errors()->first());

            return 1;
        }

        $email = $this->ask('Enter email');
        $emailValidator = Validator::make(['email' => $email], ['email' => ['required', 'string', 'email', 'max:255', 'unique:users']]);

        if ($emailValidator->fails()) {
            $this->error($emailValidator->errors()->first());

            return 1;
        }
        $password = $this->secret('Enter Password');
        $passwordConfirmation = $this->secret('Confirm password');

        $passwordValidator = Validator::make([
            'password' => $password,
            'password_confirmation' => $passwordConfirmation,
        ], ['password' => ['required', 'confirmed', Rules\Password::defaults()]]);

        if ($passwordValidator->fails()) {
            foreach ($passwordValidator->errors()->all() as $error) {
                $this->error($error);
            }

            return 1;
        }

        $roles = Role::select('id', 'name')->orderBy('name')->get();

        if (!count($roles)) {
            $this->info('Please the first add a role');
            $this->comment('You can run the "php artisan create:role" command to create new role');

            return 1;
        }

        $rolesNames = $roles->map(function ($role) {
            return $role->name;
        })->toArray();

        $selectedRoles = $this->choice(
            'Chose the roles (You can chose one or more role. example 0,1,2)',
            $rolesNames,
            null,
            $maxAttempts = null,
            $allowMultipleSelections = true
        );

        $roleIds = $roles->filter(function ($value) use ($selectedRoles) {
            return in_array($value->name, $selectedRoles);
        })->map(function ($role) {
            return $role->id;
        })->toArray();

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);

        $user->roles()->sync($roleIds);

        $this->info('User successfully created');

        return 0;
    }
}
