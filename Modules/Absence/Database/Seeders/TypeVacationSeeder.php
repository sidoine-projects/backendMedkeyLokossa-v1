<?php

namespace Modules\Absence\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Absence\Entities\TypeVacation;

class TypeVacationSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_vacations')->delete();
        
        TypeVacation::create([
            'id' => 1,
            'code' => 'ANN',
            'libelle' => 'Congés Annuels',
            'require_certify' => '1'
        ]);
        
        TypeVacation::create([
            'id' => 2,
            'code' => 'MAL',
            'libelle' => 'Congés Maladie',
            'require_certify' => '0'
        ]);
        
        TypeVacation::create([
            'id' => 3,
            'code' => 'COM',
            'libelle' => 'Congés de Compensation',
            'require_certify' => '1'
        ]);
        
        TypeVacation::create([
            'id' => 4,
            'code' => 'URG',
            'libelle' => 'Congés d\'Urgences',
            'require_certify' => '0'
        ]);
        
        TypeVacation::create([
            'id' => 5,
            'code' => 'PAT',
            'libelle' => 'Congés de Paternité',
            'require_certify' => '0'
        ]);
        
        TypeVacation::create([
            'id' => 6,
            'code' => 'MAT',
            'libelle' => 'Congés de Maternité',
            'require_certify' => '0'
        ]);        
    }
}
