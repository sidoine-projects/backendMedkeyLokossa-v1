<?php

namespace Modules\Stock\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Stock\Entities\SaleUnit;


class SaleUnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sale_units')->delete();

        SaleUnit::create([
            'id' => 1,
            'name' => 'U',
            'user_id' => 1,
        ]);  
        SaleUnit::create([
            'id' => 2,
            'name' => 'MG',
            'user_id' => 1,
        ]);   
        SaleUnit::create([
            'id' => 3,
            'name' => 'ML',
            'user_id' => 1,
        ]);  
        SaleUnit::create([
            'id' => 4,
            'name' => 'µg',
            'user_id' => 1,
        ]);   
        SaleUnit::create([
            'id' => 5,
            'name' => 'g',
            'user_id' => 1,
        ]);   
        SaleUnit::create([
            'id' => 6,
            'name' => 'MMOL',
            'user_id' => 1,
        ]);   
        SaleUnit::create([
            'id' => 7,
            'name' => 'M',
            'user_id' => 1,
        ]);      
        SaleUnit::create([
            'id' => 8,
            'name' => 'CM',
            'user_id' => 1,
        ]);      
    }
}
