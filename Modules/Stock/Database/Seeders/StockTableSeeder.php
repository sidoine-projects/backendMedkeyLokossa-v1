<?php

namespace Modules\Stock\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Stock\Entities\Stock;


class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->delete();

        Stock::create([
            'id' => 1,
            'name' => 'Stock Gros',
            'store_id' => '1',
            'user_id' => 1,
        ]);  
        Stock::create([
            'id' => 2,
            'name' => 'Stock Pharmacie',
            'for_pharmacy_sale' => 1,
            'store_id' => '2',
            'user_id' => 1,
        ]);   
        Stock::create([
            'id' => 3,
            'name' => 'Stock Arch',
            'store_id' => '2',
            'user_id' => 1,
        ]);   
    }
}
