<?php

namespace Modules\Stock\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Stock\Entities\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->delete();

        //Drugs
        Product::create([
            'id' => 1,
            'code' => 'DRU-COM-15896',
            'name' => 'Paracetamol',
            'dosage' => 'Pour les adultes est généralement de 500 milligrammes (mg) à 1000 mg toutes les 4 à 6 heures au besoin.',
            'brand' => 'Febridol',
            'conditioning_unit_id' => 1,
            'administration_route_id' => 2,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 1,
            'user_id' => 1,
        ]);  
        Product::create([
            'id' => 2,
            'code' => 'DRU-COM-16896',
            'name' => 'Omeprazole',
            'dosage' => 'Pour les adultes est généralement de 500 milligrammes (mg) à 1000 mg toutes les 4 à 6 heures au besoin.',
            'brand' => 'Omep',
            'conditioning_unit_id' => 1,
            'administration_route_id' => 2,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 1,
            'user_id' => 1,
        ]);  
        Product::create([
            'id' => 3,
            'code' => 'DRU-COM-17896',
            'name' => 'Amoxicillin',
            'dosage' => 'Pour les adultes est généralement de 500 milligrammes (mg) à 1000 mg toutes les 4 à 6 heures au besoin.',
            'brand' => 'Febridol',
            'conditioning_unit_id' => 1,
            'administration_route_id' => 2,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 1,
            'user_id' => 1,
        ]);  
        Product::create([
            'id' => 4,
            'code' => 'DRU-COM-15256',
            'name' => 'CIPROFLOXACINE',
            'dosage' => 'Pour les adultes est généralement de 500 milligrammes (mg) à 1000 mg toutes les 4 à 6 heures au besoin.',
            'brand' => 'Blister',
            'conditioning_unit_id' => 1,
            'administration_route_id' => 2,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 1,
            'user_id' => 1,
        ]);
        Product::create([
            'id' => 5,
            'code' => 'DRU-COM-18896',
            'name' => 'Atorvastatin',
            'dosage' => 'Pour les adultes est généralement de 500 milligrammes (mg) à 1000 mg toutes les 4 à 6 heures au besoin.',
            'brand' => 'Febridol',
            'conditioning_unit_id' => 1,
            'administration_route_id' => 2,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 1,
            'user_id' => 1,
        ]);
        Product::create([
            'id' => 6,
            'code' => 'DRU-COM-19896',
            'name' => 'Aspirin',
            'dosage' => 'Pour les adultes est généralement de 500 milligrammes (mg) à 1000 mg toutes les 4 à 6 heures au besoin.',
            'brand' => 'Febridol',
            'conditioning_unit_id' => 1,
            'administration_route_id' => 2,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 1,
            'user_id' => 1,
        ]);
        Product::create([
            'id' => 7,
            'code' => 'DRU-COM-20896',
            'name' => 'Loratadine Syrup',
            'dosage' => 'Pour les adultes est généralement de 500 milligrammes (mg) à 1000 mg toutes les 4 à 6 heures au besoin.',
            'brand' => 'Febridol',
            'conditioning_unit_id' => 1,
            'administration_route_id' => 2,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 1,
            'user_id' => 1,
        ]);
        Product::create([
            'id' => 8,
            'code' => 'DRU-COM-21896',
            'name' => 'Lingettes désinfectantes',
            'dosage' => 'Pour les adultes est généralement de 500 milligrammes (mg) à 1000 mg toutes les 4 à 6 heures au besoin.',
            'brand' => 'Febridol',
            'conditioning_unit_id' => 1,
            'administration_route_id' => 2,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 1,
            'user_id' => 1,
        ]);
        Product::create([
            'id' => 9,
            'code' => 'DRU-COM-22896',
            'name' => 'Masques chirurgicaux',
            'dosage' => 'Pour les adultes est généralement de 500 milligrammes (mg) à 1000 mg toutes les 4 à 6 heures au besoin.',
            'brand' => 'Febridol',
            'conditioning_unit_id' => 1,
            'administration_route_id' => 2,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 1,
            'user_id' => 1,
        ]);
        Product::create([
            'id' => 10,
            'code' => 'DRU-COM-23896',
            'name' => 'Bandages',
            'dosage' => 'Pour les adultes est généralement de 500 milligrammes (mg) à 1000 mg toutes les 4 à 6 heures au besoin.',
            'brand' => 'Febridol',
            'conditioning_unit_id' => 1,
            'administration_route_id' => 2,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 1,
            'user_id' => 1,
        ]);

        // Notebooks and cards
        Product::create([
            'id' => 11,
            'code' => 'NOT-CAR-15896',
            'name' => 'Carte Infantile Fille',
            'conditioning_unit_id' => 4,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 3,
            'user_id' => 1,
        ]);  
        Product::create([
            'id' => 12,
            'code' => 'NOT-CAR-15996',
            'name' => 'Carnet de soins ',
            'conditioning_unit_id' => 4,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 3,
            'user_id' => 1,
        ]);  
        Product::create([
            'id' => 13,
            'code' => 'NOT-CAR-15836',
            'name' => 'Carnet de santé ',
            'conditioning_unit_id' => 4,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 3,
            'user_id' => 1,
        ]);  
        Product::create([
            'id' => 14,
            'code' => 'NOT-CAR-16836',
            'name' => 'Carte infantile garçon',
            'conditioning_unit_id' => 4,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 3,
            'user_id' => 1,
        ]);  
        Product::create([
            'id' => 15,
            'code' => 'NOT-CAR-16936',
            'name' => 'Carte PF',
            'conditioning_unit_id' => 4,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 3,
            'user_id' => 1,
        ]);  

        // Consumables
        Product::create([
            'id' => 16,
            'code' => 'CON-DEJ-15896',
            'name' => 'Paracetamol',
            'dosage' => 'NAN',
            'brand' => 'Febridol',
            'conditioning_unit_id' => 3,
            'administration_route_id' => 5,
            'sale_unit_id' => 3,
            'category_id' => 1,
            'type_id' => 1,
            'user_id' => 1,
        ]);   
    }
}
