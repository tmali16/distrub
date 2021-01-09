<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Role Types
         *
         */
        $RoleItems = [
            [
                'name'        => 'Администратор',
                'slug'        => 'admin',
                'description' => 'Администратор системы',
                'level'       => 5,
            ],
            [
                'name'        => 'Инспектор',
                'slug'        => 'inspector',
                'description' => 'иснпектор системы',
                'level'       => 2,
            ],
            [
                'name'        => 'Оператор',
                'slug'        => 'operator',
                'description' => 'Оператор системы',
                'level'       => 1,
            ]
        ];

        /*
         * Add Role Items
         *
         */
        foreach ($RoleItems as $RoleItem) {
            $newRoleItem = config('roles.models.role')::where('slug', '=', $RoleItem['slug'])->first();
            if ($newRoleItem === null) {
                $newRoleItem = config('roles.models.role')::create([
                    'name'          => $RoleItem['name'],
                    'slug'          => $RoleItem['slug'],
                    'description'   => $RoleItem['description'],
                    'level'         => $RoleItem['level'],
                ]);
            }
        }
    }
}
