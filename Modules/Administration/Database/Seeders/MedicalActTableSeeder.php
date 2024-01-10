<?php

namespace Modules\Administration\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Str;

use Modules\Administration\Entities\MedicalAct;
use Modules\Administration\Entities\TypeMedicalActs;
use Modules\Administration\Entities\Service;

class MedicalActTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $data = loadJsonData("demo");
        $Service = Service::first();
        $TypeMedicalActs = TypeMedicalActs::first();

        try {

            $medical_acts = collect($data->medical_acts)->map(
                function ($d) use ($Service, $TypeMedicalActs) {
                    $d->services_id = $Service->id;
                    $d->type_medical_acts_id = $TypeMedicalActs->id;
                    $d->created_at = Carbon::now();
                    $d->updated_at = Carbon::now();
                    return (array)$d;
                }
            );

            MedicalAct::insert($medical_acts->toArray());

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th);
        }
    }
}
