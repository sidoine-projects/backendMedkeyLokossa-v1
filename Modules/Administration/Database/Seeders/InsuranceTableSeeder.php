<?php

namespace Modules\Administration\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Modules\Administration\Entities\Insurance;
use Modules\Acl\Entities\User;

class InsuranceTableSeeder extends Seeder
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

        try {

            $insurances = collect($data->insurances)->map(
                function ($d) use ($User) {
                    $d->users_id = $User->id;
                    $d->uuid = Str::uuid();
                    $d->created_at = Carbon::now();
                    $d->updated_at = Carbon::now();
                    return (array)$d;
                }
            );

            Insurance::insert($insurances->toArray());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }
}
