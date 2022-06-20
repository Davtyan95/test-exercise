<?php

namespace App\Console\Commands;

use App\Interfaces\PermissionInterface;
use App\Interfaces\RoleInterface;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CreateRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a role';

    /**
     * @var PermissionInterface
     */
    private PermissionInterface $permission;

    /**
     * @var RoleInterface
     */
    private RoleInterface $role;

    public function __construct(PermissionInterface $permission, RoleInterface $role)
    {
        parent::__construct();
        $this->permission = $permission;
        $this->role = $role;
    }


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $permissions = $this->permission->all();

        if (!count($permissions)) {
            $this->info('Please the first add a permission');
            $this->comment('You can run the "php artisan create:permission" command for create new permission');

            return 0;
        }

        $permissionsNames = $permissions->map(function ($permission) {
            return $permission->name;
        })->toArray();

        $name = $this->ask('Enter role name');

        $validator = Validator::make([
            'name' => $name,
        ], ['name' => ['required', 'unique:roles']]);

        if ($validator->fails()) {
            $this->warn('Role not created. See error messages below');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return 1;
        }

        $selectedPermissions = $this->choice(
            'Chose the permissions (You can chose one or more permission. example 0,1,2)',
            $permissionsNames,
            null,
            $maxAttempts = null,
            $allowMultipleSelections = true
        );

        $permissionIds = $permissions->filter(function ($value) use ($selectedPermissions) {
            return in_array($value->name, $selectedPermissions);
        })->map(function ($permission) {
            return $permission->id;
        })->toArray();

        $role = $this->role->create($validator->validated());
        $role->permissions()->sync($permissionIds);

        $this->info('Permission successfully created.');

        return 0;
    }

}
