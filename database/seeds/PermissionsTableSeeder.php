<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permission Types
         *
         */
        $perm = [
            [
                "ru"=>"плользователей",
                "model"=>"Users"
            ],
            [
                "ru"=>"сулужбу",
                "model"=>"Services"
            ],
            [
                "ru"=>"звание",
                "model"=>"Rank"
            ],
            [
                "ru"=>"учреждение",
                "model"=>"Prisions"
            ],
            [
                "ru"=>"оператора",
                "model"=>"Operators"
            ],
            [
                "ru"=>"файл",
                "model"=>"Media"
            ],
            [
                "ru"=>"типы нарушений",
                "model"=>"DistrubType"
            ],
            [
                "ru"=>"нарушения",
                "model"=>"Distrub"
            ],
            [
                "ru"=>"Полномочия",
                "model"=>"Permissions"
            ],
            [
                "ru"=>"Роли",
                "model"=>"Role"
            ],
            [
                "ru"=>"Журнал",
                "model"=>"Journal"
            ],
        ];
        $Permissionitems = [
            [
                'name'        => 'Может просмотреть ',
                'slug'        => 'view.',
                'description' => 'Может просмотреть ',
                'model'       => '',
            ],
            [
                'name'        => 'Может создать ',
                'slug'        => 'create.',
                'description' => 'Может создать ',
                'model'       => '',
            ],
            [
                'name'        => 'Может изменить ',
                'slug'        => 'edit.',
                'description' => 'Может изменить ',
                'model'       => '',
            ],
            [
                'name'        => 'Может удалить ',
                'slug'        => 'delete.',
                'description' => 'Может удалить ',
                'model'       => '',
            ]
        ];

        /*
         * Add Permission Items
         *
         */
        foreach ($perm as  $value) {
            foreach ($Permissionitems as $Permissionitem) {
                $newPermissionitem = config('roles.models.permission')::where('slug', '=', $Permissionitem['slug'].$value['model'])->first();
                if ($newPermissionitem === null) {
                    $newPermissionitem = config('roles.models.permission')::create([
                        'name'          => $Permissionitem['name'].$value['ru'],
                        'slug'          => $Permissionitem['slug'].$value['model'],
                        'description'   => $Permissionitem['description'].$value['ru'],
                        'model'         => $value['model'],
                    ]);
                }
            }
        }
    }
}
