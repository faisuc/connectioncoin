<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Schema::disableForeignKeyConstraints();

        Role::truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();

        $adminRole = Role::create(['name' => 'admin']);
        $clientRole = Role::create(['name' => 'client']);

        DB::table('users')->truncate();

        $user = new User;
        $user->first_name = 'Neil Carlo';
        $user->last_name = 'Sucuangco';
        $user->email = 'succute@yahoo.com';
        $user->password = bcrypt('password');
        $user->email_verified_at = now();
        $user->save();

        $user->assignRole($adminRole);

        Schema::enableForeignKeyConstraints();

    }
}
