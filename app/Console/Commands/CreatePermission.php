<?php

namespace App\Console\Commands;

use App\Models\Permission;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;

class CreatePermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a permission';


    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Enter permission name');

        $validator = Validator::make([
            'name' => $name,
        ], ['name' => ['required', 'unique:permissions']]);

        if ($validator->fails()) {
            $this->warn('Permission not created. See error messages below');

            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return 1;
        }

        Permission::create($validator->validated());

        $this->info('Permission successfully created');

        return 0;
    }

}
