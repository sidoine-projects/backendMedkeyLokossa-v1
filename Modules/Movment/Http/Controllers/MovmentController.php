<?php

namespace Modules\Movment\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Patient\Entities\Patiente;
use Modules\Administration\Entities\MedicalAct;
use Modules\Administration\Entities\Service;

use Modules\Movment\Entities\Movment;
use Carbon\Carbon;
use Illuminate\Support\Str;


use Illuminate\Support\Facades\DB;

class MovmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
      if(request('perPage')) { $perPage = request('perPage') ; }else{ $perPage = 50 ;};

      $q = request('q');

      $data = Movment::orderBy('created_at','desc')
      ->join('patients', 'patients.id', '=', 'movments.patients_id')
      ->join('services', 'services.id', '=', 'movments.active_services_id')
      ->whereNull('releasedate')
      ->where(function($query) use ( $q ) {
        $query->where('patients.ipp', 'like', "%$q%")
        ->OrWhere('patients.firstname', 'like', "%$q%")
        ->OrWhere('patients.lastname', 'like', "%$q%")
        ->OrWhere('patients.phone', 'like', "%$q%")
        ->OrWhere('services.name', 'like', "%$q%");
      })->select('patients_id',
      'movments.id',
      'movments.iep',
      'services.name as services_name',
      'movments.ipp',
      'movments.uuid as uuid',
      'lastname',
      'firstname',
      'date_birth',
      'age',
      'phone',
      'email',
      'gender',
      'arrivaldate',
      'movments.created_at')
      ->paginate($perPage,request('page'));

      return response()->json([
        'success' => true,
        'data' => $data,
        'message' => 'Liste des patients.'
      ]);

    }


    public function getConsultationMovments(Request $request)
    {

      $service = Service::where('code',$request->service_code)->first();


      if(request('perPage')) { $perPage = request('perPage') ; }else{ $perPage = 50 ;};

      $q = request('q');

      $data = Movment::orderBy('created_at','desc')
      ->join('patients', 'patients.id', '=', 'movments.patients_id')
      ->join('services', 'services.id', '=', 'movments.active_services_id')
      ->where('movments.active_services_id',$service->id)
      ->whereNull('releasedate')
      ->where(function($query) use ( $q ) {
        $query->where('patients.ipp', 'like', "%$q%")
        ->OrWhere('patients.firstname', 'like', "%$q%")
        ->OrWhere('patients.lastname', 'like', "%$q%")
        ->OrWhere('patients.phone', 'like', "%$q%")
        ->OrWhere('services.name', 'like', "%$q%");
      })->select('patients_id',
      'movments.id as id',
      'movments.iep',
      'services.name as services_name',
      'movments.ipp',
      'movments.uuid as uuid',
      'lastname',
      'firstname',
      'date_birth',
      'age',
      'phone',
      'email',
      'gender',
      'arrivaldate',
      'releasedate',
      'movments.created_at')
      ->paginate($perPage,request('page'));

      return response()->json([
        'success' => true,
        'data' => $data,
        'message' => 'Liste des patients.'
      ]);

    }

    public function getAll(Request $request)
    {
      if(request('perPage')) { $perPage = request('perPage') ; }else{ $perPage = 50 ;};

      $q = request('q');

      $data = Movment::orderBy('created_at','desc')
      ->join('patients', 'patients.id', '=', 'movments.patients_id')
      ->join('services', 'services.id', '=', 'movments.active_services_id')
      ->where(function($query) use ( $q ) {
        $query->where('patients.ipp', 'like', "%$q%")
        ->OrWhere('patients.firstname', 'like', "%$q%")
        ->OrWhere('patients.lastname', 'like', "%$q%")
        ->OrWhere('patients.phone', 'like', "%$q%")
        ->OrWhere('services.name', 'like', "%$q%");
      })->select('patients_id',
      'movments.id as id',
      'movments.iep',
      'services.name as services_name',
      'movments.ipp',
      'movments.uuid as uuid',
      'lastname',
      'firstname',
      'date_birth',
      'age',
      'phone',
      'email',
      'gender',
      'arrivaldate',
      'releasedate',
      'movments.created_at')
      ->paginate($perPage,request('page'));

      return response()->json([
        'success' => true,
        'data' => $data,
        'message' => 'Liste des patients.'
      ]);

    }


    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
      return view('movment::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {

     $request->validate([
       'patient_id' => 'required|numeric',
       'service_id' => 'required|numeric',
       'medical_acts_id' => 'required|numeric',
     ]);

     $existMovment  =   Movment::where('patients_id', $request->patient_id)
     ->where('releasedate',null)->first();
     if($existMovment){
       return response()->json([
        'code' =>302,
        'success' => true,
        'data' => $existMovment,
        'message' => 'Mouvement déja en cours !'
      ]);
     }

     DB::beginTransaction();

     $Movment = Movment::create([
      'patients_id'=> $request->patient_id,
      'iep'=> $this->getIEP(),
      'ipp'=> $this->getIPP($request->patient_id),
      'arrivaldate' => Carbon::now(),
      'incoming_reason' => $request->reason,
      'active_services_id' => $request->service_id
    ]);

     if($Movment){
      DB::table('patient_movement_details')->insert([
      'uuid' => Str::uuid(),
      'medical_acts_id'=> $request->medical_acts_id,
      'medical_acts_uuid'=> $this->getActUuid($request->medical_acts_id),
      'medical_acts_qte'=> 1,
      'percentage_patient_insurance' => $this->getPatientPackPpercentage($Movment->id),
      'medical_acts_price'=> $this->getAct($request->medical_acts_id),
      'type'=> "A",
      'services_id'=>  $request->service_id,
      'movments_id'=> $Movment->id
    ]);


    }

    DB::commit();

    $Movment = Movment::find($Movment->id);
    return response()->json([
      'success' => true,
      'data' =>  $Movment,
      'message' => 'Mouvement créé !'
    ]);
  }

  public function getIEP()
  {
   $m = Movment::latest()->first();
   if($m) {
    return $m->iep +1;
  }else{
   return 1;
 }

}

public function getIPP($patient_id)
{
  return Patiente::find($patient_id)->ipp;
}

public function getServiceCode($service_id)
{
  return Service::find($service_id)->code;
}

public function getAct($medical_acts_id)
{
  return  DB::table('medical_acts')->where('id',$medical_acts_id)->first()->price;
}

public function getActUuid($medical_acts_id)
{
  return  DB::table('medical_acts')->where('id',$medical_acts_id)->first()->uuid;
}


public function getProductPrice($product_id)
{
  return  0;
  // DB::table('products')
  /*->join('stock_products', 'products.id', '=', 'stock_products.product_id')
  ->where('products.id', $product_id)->first()->selling_price;*/
}

public function getProductId($product_uuid){
 return DB::table('products')->where('products.uuid', $product_uuid)->first()->id;
}


public function getProductUuid($product_uuid){
 return DB::table('products')->where('products.uuid', $product_uuid)->first()->uuid;
}


public function getPatientPackPpercentage($movments_id){

  $patient = DB::table('movments')->where('id',$movments_id)->first();
 return 0;

 /* if($patient_id){
    $patient_insurances =  DB::table('patient_insurances')
    ->join('patients', 'patients.id', '=', 'patient_insurances.patients_id')
    ->join('packs', 'packs.id', '=', 'patient_insurances.pack_id')
    ->where('patients.id',$patient_id)
    ->first();
    return $patient_insurances->percentage;
  }else{
    return 0;
  }*/
}





public function show($id)
{
 return response()->json([
  'success' => true,
  'data' =>
  Movment::join('patients', 'patients.id', '=', 'movments.patients_id')
  ->join('services', 'services.id', '=', 'movments.active_services_id')
  ->where('movments.id',$id)
  ->select('patients_id',
    'movments.id as movments_id',
    'movments.iep',
    'services.id as services_id',
    'services.name as services_name',
    'services.code as services_code',
    'movments.ipp',
    'movments.incoming_reason',
    'movments.outgoing_reason',
    'movments.uuid as uuid',
    'lastname',
    'firstname',
    'date_birth',
    'age',
    'phone',
    'emergency_contac',
    'email',
    'gender',
    'profession',
    'marital_status',
    'arrivaldate',
    'releasedate',
    'movments.created_at'

  )
  ->first(),
  'message' => 'Mouvement'
]);

}

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        //return view('movment::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */

    public function updateOut(Request $request)
    {

     $request->validate([
       'movments_id' => 'required|numeric',
       'outgoing_reason' => 'required'
     ]);

     $Movment =   Movment::find($request->movments_id);

     $Movment->update([
      'releasedate'=> Carbon::now(),
      'outgoing_reason'=>$request->outgoing_reason
    ]);

     return response()->json([
      'success' => true,
      'data' =>  $Movment,
      'message' => 'Mouvement mise à jour !'
    ]);

   }


   public function update(Request $request,$id)
   {


   }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }

    public function getMovmentsByService(Request $request)
    {
     return response()->json([

      'success' => true,
      'data' => Movment::join('service_movments', 'movments.id', '=', 'service_movments.movments_id')
      ->join('patients', 'patients.id', '=', 'movments.patients_id')
      ->where('service_movments.services_id', $request->service_id)
      ->where('movments.releasedate',null)
      ->get(['movments.id','services_id','movments.iep','movments.ipp','lastname','firstname','movments.created_at']),

      'message' => 'Liste des patients.'
    ]);

   }


   public function getMovmentActes(Request $request)
   {
     return response()->json([
      'success' => true,
      'data' => DB::table('medical_acts')->join('patient_movement_details', 'patient_movement_details.medical_acts_id', '=', 'medical_acts.id')
      ->where('patient_movement_details.movments_id', $request->movment_id)
      ->where('patient_movement_details.type',"A")
      ->get(),

      'message' => 'Liste des actes par mouvement.'
    ]);

   }


   public function getMovmentProducts(Request $request)
   {
     return response()->json([
      'success' => true,
      'data' => DB::table('products')->join('patient_movement_details', 'patient_movement_details.medical_acts_id', '=', 'products.id')
      ->where('patient_movement_details.movments_id', $request->movment_id)
      ->where('patient_movement_details.type',"P")
      ->get(),

      'message' => 'Liste des actes par mouvement.'
    ]);

   }



   public function storeActe(Request $request)
   {


    $request->validate([
     'movments_id' => 'required|numeric',
     'medical_acts_id' => 'required|numeric',
     'medical_acts_qte' => 'required|numeric',
     'services_id' => 'required|numeric'
   ]);

    DB::beginTransaction();

    $movment_detail =  DB::table('patient_movement_details')->insert([
      'uuid' => Str::uuid(),
      'medical_acts_id'=> $request->medical_acts_id,
      'medical_acts_uuid'=> $this->getActUuid($request->medical_acts_id),
      'medical_acts_qte'=>  $request->medical_acts_qte,
      'percentage_patient_insurance' => $this->getPatientPackPpercentage($request->movments_id),
      'medical_acts_price'=> $this->getAct($request->medical_acts_id),
      'type'=> "A",
      'services_id'=>  $request->services_id,
      'movments_id'=> $request->movments_id
    ]);

    DB::commit();


    return response()->json([
      'success' => true,
      'data' => $movment_detail,
      'message' => 'Mouvement créé !'
    ]);


  }

  public function storeProduct(Request $request)
  {

   $request->validate([
     'movments_id' => 'required|numeric',
     'product_id' => 'required',
     'product_qte' => 'required|numeric',
     'services_id' => 'required|numeric'

   ]);

   DB::beginTransaction();

   $product = DB::table('products')->where("products.uuid", $request->product_id)->first();

   $movment_detail =  DB::table('patient_movement_details')->insert([
    'uuid' => Str::uuid(),
    'medical_acts_id'=> $this->getProductId($request->product_id),
    'medical_acts_uuid'=> $request->product_id,
    'percentage_patient_insurance'=> $this->getPatientPackPpercentage($request->movments_id),
    'medical_acts_qte'=>  $request->product_qte,
    'medical_acts_price'=> $this->getProductPrice($this->getProductId($request->product_id)),
    'type'=> "P",
    'services_id'=>  $request->services_id,
    'movments_id'=> $request->movments_id
  ]);

   DB::commit();

   return response()->json([
    'success' => true,
    'data' => $movment_detail,
    'message' => 'Mouvement créé !'
  ]);

 }



 public function deleteActe(Request $request)
 {

  $request->validate([
   'act_id' => 'required|numeric'
 ]);

  DB::beginTransaction();

  $movment_detail =  DB::table('patient_movement_details')
  ->where('id', $request->act_id)->delete();

  DB::commit();

  return response()->json([
    'success' => true,
    'data' => $movment_detail,
    'message' => 'Mouvement créé !'
  ]);


}




public function getRecord(Request $request)
{

$data = [
    'complaint'=> "",
    'exam'=>"",
    'observation'=>"",
    'reason'=> "",
    'exam'=> "",
    'summary'=>"",
    'operator'=>"",
    'services_id'=> "",
    'movments_id'=> ""
];


$record = DB::table('service_movments')
  ->where("services_id", $request->services_id)
  ->where("movments_id", $request->movments_id)
  ->first();

if($record ){ $data = $record ; }

 return response()->json([
  'success' => true,
  'data' =>  $data,
  'message' => 'Mouvement encours dans le service !'
]);

}



public function recordConsultation(Request $request)
{

  $request->validate([
   'reason' => 'required',
   'movments_id' => 'required|numeric',
   'services_id' => 'required|numeric'

 ]);

  $existServiceMovment = DB::table('service_movments')
  ->where("services_id", $request->services_id)
  ->where("movments_id", $request->movments_id)
  ->first();


  if($existServiceMovment){
    DB::table('service_movments')
    ->where("services_id", $request->services_id)
    ->where("movments_id", $request->movments_id)
    ->update([
      'complaint'=>  $request->complaint,
      'reason'=>  $request->reason,
      'exam'=>  $request->exam,
      'observation'=> $request->observation,
      'summary'=> $request->summary,
      'operator'=> getPatientIdByUuid(trim($request->operator))
    ]);

    return response()->json([
      'code' =>302,
      'success' => true,
      'data' => $existServiceMovment,
      'message' => 'Mouvement du service actif modifie !'
    ]);

  }else{

   $serviceMovment =  DB::table('service_movments')->insert([
    'complaint'=>  $request->complaint,
    'exam'=>  $request->exam,
    'observation'=> $request->observation,
    'reason'=>  $request->reason,
    'summary'=> $request->summary,
    'operator'=> getPatientIdByUuid(trim($request->operator)),
    'services_id'=>  $request->services_id,
    'movments_id'=> $request->movments_id
  ]);


   return response()->json([
    'code' =>200,
    'success' => true,
    'data' => $serviceMovment,
    'message' => 'Mouvement du service actif ajoute !'
  ]);

 }
}


public function switchServices(Request $request)
{
 $request->validate([
   'movments_id' => 'required|numeric',
   'selectedService_id' => 'required|numeric'
 ]);

 $movment = Movment::find($request->movments_id);
 $movment->active_services_id = $request->selectedService_id;
 $movment->save();

 return response()->json([
  'success' => true,
  'data' =>$movment,
  'message' => 'Mouvement affecté au un autre service !'
]);

}

public function checkGetout(Request $request)
{
  $request->validate([
   'movments_id' => 'required|numeric'
 ]);

  $paid = DB::table('patient_movement_details')
  ->where('movments_id',$request->movments_id)
  ->where('paid',1)->first();

  if($paid){
    return response()->json([
      'success' => true,
      'data' =>1,
      'message' => ' Treaitment effectuté sur le patient !'
    ]);

  }else{

    return response()->json([
      'success' => true,
      'data' =>0,
      'message' => 'Aucun traitement effectué !'
    ]);
  }
}


public function getPatientMedicalsRecords(Request $request){

   $patient = Patient::where('uuid', $request->patient_uuid)->first();
   return response()->json([
      'success' => true,
      'data' => $patient,
      'message' => 'Aucun traitement effectué !'
    ]);

}




}



