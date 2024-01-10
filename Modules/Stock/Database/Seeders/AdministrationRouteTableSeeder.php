<?php

namespace Modules\Stock\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Stock\Entities\AdministrationRoute;


class AdministrationRouteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('administration_routes')->delete();
                
        AdministrationRoute::create([
            'id' => 1,
            'name' => 'Auriculaire',
            'user_id' => 1,
        ]);
        AdministrationRoute::create([
            'id' => 2,
            'name' => 'Buccale',
            'user_id' => 1,
            'is_synced' => 0,
        ]);  
        AdministrationRoute::create([
            'id' => 3,
            'name' => 'Nasale',
            'user_id' => 1,
        ]);  
         
        AdministrationRoute::create([
            'id' => 4,
            'name' => 'Oculaire',
            'user_id' => 1,
        ]);  
        AdministrationRoute::create([
            'id' => 5,
            'name' => 'Orale',
            'user_id' => 1,
        ]);  
        AdministrationRoute::create([
            'id' => 6,
            'name' => 'Rectum',
            'user_id' => 1,
        ]);   
        AdministrationRoute::create([
            'id' => 7,
            'name' => 'Vaginale',
            'user_id' => 1,
        ]);   
    }
}
