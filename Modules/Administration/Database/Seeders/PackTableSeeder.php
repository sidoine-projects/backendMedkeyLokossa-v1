<?php

namespace Modules\Administration\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Modules\Administration\Entities\Insurance;
use Modules\Administration\Entities\ProductType;
use Modules\Administration\Entities\Pack;
use Modules\Acl\Entities\User;

class PackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::beginTransaction();

        $data = loadJsonData("demo");
        $User = User::first();
        $Insurance = Insurance::first();
        $ProductType = ProductType::first();

        try {

            $packs = collect($data->packs)->map(
                function ($d) use ($User,$Insurance,$ProductType) {
                    $d->insurances_id = $Insurance->id;
                    $d->product_types_id = $ProductType->id;
                    $d->users_id = $User->id;
                    $d->uuid = Str::uuid();
                    $d->created_at = Carbon::now();
                    $d->updated_at = Carbon::now();
                    return (array)$d;
                }
            );

            Pack::insert($packs->toArray());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }
}
