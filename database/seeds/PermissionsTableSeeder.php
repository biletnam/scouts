<?php

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
        DB::table('permissions')->insert([
            [
                'name'          => 'administratie',
                'description'   => 'role_permissions',
            ],
            [
                'name'          => 'account-management',
                'description'   => 'Machtiging toevoegen, wijzigen en verwijderen van leidingsaccounts',
            ],
            [
                'name'          => 'nieuws',
                'description'   => 'Rechten om nieuwsberichten te plaatsen, wijzigen of verwijderen',
            ],
            [
                'name'          => 'schakeltjes',
                'description'   => 'Rechten om Schakeltjes te uploaden en beheren',
            ]
        ]);
    }
}
