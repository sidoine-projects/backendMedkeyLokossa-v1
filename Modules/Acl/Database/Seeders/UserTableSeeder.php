<?php

namespace Modules\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Modules\Acl\Entities\User;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

       $user = User::create([
                    'name' => 'Super',
                    'prenom' => 'Formation',
                    'email' => 'super@formation.com',
                    'password' => Hash::make('MotDePasse'),
                    'email_verified_at' => now()->toDateTimeString(),
        ]);
    }
}
