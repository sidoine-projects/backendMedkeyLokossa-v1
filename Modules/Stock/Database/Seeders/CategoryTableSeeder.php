<?php

namespace Modules\Stock\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Stock\Entities\Category;


class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();

        Category::create([
            'id' => 1,
            'name' => 'COMPRIME',
            'user_id' => 1,
        ]);  
        Category::create([
            'id' => 2,
            'name' => 'GELLULE',
            'user_id' => 1,
        ]);   
        Category::create([
            'id' => 3,
            'name' => 'GOUTTELETTE',
            'user_id' => 1,
        ]);  
        Category::create([
            'id' => 4,
            'name' => 'INJECTABLE',
            'user_id' => 1,
        ]);   
        Category::create([
            'id' => 5,
            'name' => 'POMMADE',
            'user_id' => 1,
        ]);   
        Category::create([
            'id' => 6,
            'name' => 'PRODUIT ALIMENTAIRE',
            'user_id' => 1,
        ]);   
        Category::create([
            'id' => 7,
            'name' => 'SIROP',
            'user_id' => 1,
        ]);   
        Category::create([
            'id' => 8,
            'name' => 'SUPPOSITOIRE',
            'user_id' => 1,
        ]);   
        Category::create([
            'id' => 9,
            'name' => 'AUTRES',
            'user_id' => 1,
        ]);   
        Category::create([
            'id' => 10,
            'name' => 'CONSOMMABLE',
            'user_id' => 1,
        ]);   
        Category::create([
            'id' => 11,
            'name' => 'SOLUTION',
            'user_id' => 1,
        ]);   
    }
}
