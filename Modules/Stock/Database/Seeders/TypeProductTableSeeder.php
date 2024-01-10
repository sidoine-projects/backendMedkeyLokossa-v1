<?php

namespace Modules\Stock\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Stock\Entities\TypeProduct;


class TypeProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_products')->delete();

        TypeProduct::create([
            'id' => 1,
            'name' => 'Drugs',
            'user_id' => 1,
        ]);  
        TypeProduct::create([
            'id' => 2,
            'name' => 'Consumables',
            'user_id' => 1,
        ]);   
        TypeProduct::create([
            'id' => 3,
            'name' => 'Notebooks and cards',
            'user_id' => 1,
        ]);   
    }
}
