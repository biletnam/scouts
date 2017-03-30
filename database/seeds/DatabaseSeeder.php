<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $this->call(TakkenTableSeeder::class);
	    $this->call(MembersTableSeeder::class);

        $this->call(UsersTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserRolesTableSeeder::class);

        $this->call(PermissionsTableSeeder::class);
        $this->call(RolePermissionsTableSeeder::class);
    }
}
