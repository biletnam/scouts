<?php

use Illuminate\Database\Seeder;

class RolePermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permissions')->insert([
            // Webmaster
            [
                'role_id'       => 1,
                'permission_id' => 1,
            ],
            [
                'role_id'       => 1,
                'permission_id' => 2,
            ],
            [
                'role_id'       => 1,
                'permission_id' => 3,
            ],
            [
                'role_id'       => 1,
                'permission_id' => 4,
            ],

            // VGA
            [
                'role_id'       => 2,
                'permission_id' => 1,
            ],

            // Redactie
            [
                'role_id'       => 3,
                'permission_id' => 3,
            ],
            [
                'role_id'       => 3,
                'permission_id' => 4,
            ],

            // Groepsleiding
            [
                'role_id'       => 4,
                'permission_id' => 1,
            ],
            [
                'role_id'       => 4,
                'permission_id' => 2,
            ],
            [
                'role_id'       => 4,
                'permission_id' => 3,
            ],
            [
                'role_id'       => 4,
                'permission_id' => 4,
            ]
        ]);
    }
}
