<?php

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
        DB::table('roles')->insert([
            [
                'name'          => 'webmaster',
                'description'   => 'Beheerder van de website en al zijn modules: Volledige toegang',
            ],
            [
                'name'          => 'VGA',
                'description'   => 'Verantwoordelijke Groepsadministratie: volledige toegang tot ledenlijsten en wachtlijsten',
            ],
            [
                'name'          => 'Redactie',
                'description'   => 'Beheert de nieuwsberichten en de schakeltjes op de website',
            ],
            [
                'name'          => 'groepsleiding',
                'description'   => 'Volledige toegang tot administratie',
            ],
            [
                'name'          => 'takleiding',
                'description'   => 'Toegang tot ledenlijsten',
            ],
            [
                'name'          => 'leiding',
                'description'   => 'Toegang tot ledenlijsten',
            ]
        ]);
    }
}
