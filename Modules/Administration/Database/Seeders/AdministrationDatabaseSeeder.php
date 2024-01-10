<?php

namespace Modules\Administration\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AdministrationDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call([

            //  PaysSeederTableSeeder::class,
            //  DepartementTableSeeder::class,
            //  CommuneTableSeeder::class,
            //  ArrondissementTableSeeder::class,

            InsuranceTableSeeder::class,
            ProductTypeTableSeeder::class,
            PackTableSeeder::class,

            DepartmentTableSeeder::class,
            ServiceTableSeeder::class,

            TypeMedicalActsTableSeeder::class,
            MedicalActTableSeeder::class

        ]);

    }
}
