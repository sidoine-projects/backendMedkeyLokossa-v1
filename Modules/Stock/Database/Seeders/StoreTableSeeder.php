<?php

namespace Modules\Stock\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Stock\Entities\Store;


class StoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->delete();

        Store::create([
            'id' => 1,
            'code' => 'MAG-67205',
            'name' => 'Magasin Gros',
            'location' => 'Emplacement du magasin gros',
            'user_id' => 1,
        ]);  
        Store::create([
            'id' => 2,
            'code' => 'MAG-67505',
            'name' => 'Officine',
            'location' => 'Emplacement du magasin Officine',
            'user_id' => 1,
        ]);   
    }
}
