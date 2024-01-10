<?php

namespace Modules\Stock\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Stock\Entities\ConditioningUnit;


class ConditioningUnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conditioning_units')->delete();

        ConditioningUnit::create([
            'id' => 1,
            'name' => 'Ampoule',
            'user_id' => 1,
        ]);  
        ConditioningUnit::create([
            'id' => 2,
            'name' => 'Plaquette',
            'user_id' => 1,
        ]);   
        ConditioningUnit::create([
            'id' => 3,
            'name' => 'Sachet',
            'user_id' => 1,
        ]);  
        ConditioningUnit::create([
            'id' => 4,
            'name' => 'Carton',
            'user_id' => 1,
        ]);   
        ConditioningUnit::create([
            'id' => 5,
            'name' => 'Autres',
            'user_id' => 1,
        ]);   
        ConditioningUnit::create([
            'id' => 6,
            'name' => 'Boîte',
            'user_id' => 1,
        ]);   
        ConditioningUnit::create([
            'id' => 7,
            'name' => 'Bouteille',
            'user_id' => 1,
        ]);   
        ConditioningUnit::create([
            'id' => 8,
            'name' => 'Tube',
            'user_id' => 1,
        ]);   
    }
}
