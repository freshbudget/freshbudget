<?php

use Illuminate\Database\Migrations\Migration;

class SeedRolesAndPermissionTables extends Migration
{
    public function up()
    {
        $roles = [
            [
                'name' => 'owner',
                'display_name' => 'Owner',
                'description' => 'The owner of the budget.',
                'permissions' => [
                    'view budget',
                    'view calendar',
                    'view accounts',
                    'view expenses',
                    'view transactions',
                    'view files',
                    'view members',

                    'add calendar events',
                    'add accounts',
                    'add expenses',
                    'add transactions',
                    'add files',
                    'add members',

                    'edit budget',
                    'edit calendar events',
                    'edit accounts',
                    'edit expenses',
                    'edit transactions',
                    'edit files',
                    'edit members',

                    'delete budget',
                    'delete calendar events',
                    'delete accounts',
                    'delete expenses',
                    'delete transactions',
                    'delete files',
                    'delete members',

                    'force delete budget',
                    'force delete calendar events',
                    'force delete accounts',
                    'force delete expenses',
                    'force delete transactions',
                    'force delete files',
                    'force delete members',

                    'restore accounts',
                    'restore expenses',
                    'restore transactions',
                    'restore files',
                ],
            ],
            [
                'name' => 'member',
                'display_name' => 'Member',
                'description' => 'A member of the budget.',
                'permissions' => [
                    'view budget',
                    'view calendar',
                    'view accounts',
                    'view expenses',
                    'view transactions',
                    'view files',

                    'add calendar events',
                    'add accounts',
                    'add expenses',
                    'add transactions',
                    'add files',

                    'edit calendar events',
                    'edit accounts',
                    'edit expenses',
                    'edit transactions',
                    'edit files',

                    'delete calendar events',
                    'delete accounts',
                    'delete expenses',
                    'delete transactions',
                    'delete files',
                ],
            ],
        ];

        foreach ($roles as $data) {
            // $role = Role::create([
            //     'name' => $data['name'],
            //     'display_name' => $data['display_name'],
            //     'description' => $data['description']
            // ]);

            foreach ($data['permissions'] as $permission) {

                // Permission::firstOrCreate([
                //     'name' => $permission,
                //     'display_name' => Str::title($permission),
                //     'description' => 'The ability to ' . $permission . '.'
                // ]);

                // $role->givePermission($permission);
            }
        }
    }
}
