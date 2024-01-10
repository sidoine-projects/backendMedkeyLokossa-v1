<?php

namespace Modules\Patient\Http\Controllers\Api\V1;

use Illuminate\Http\Response;
use Modules\Patient\Entities\Patiente;
use App\Repositories\UserRepositoryEloquent;
use Modules\Patient\Http\Resources\PatienteResource;

use Modules\Patient\Http\Resources\PatientesResource;
use Modules\Patient\Http\Controllers\PatientController;
use Modules\Patient\Http\Requests\PatienteIndexRequest;
use Modules\Patient\Http\Requests\PatienteStoreRequest;
use Modules\Patient\Http\Requests\PatienteUpdateRequest;
use Modules\Patient\Repositories\PatienteRepositoryEloquent;
use Modules\Administration\Repositories\PackRepositoryEloquent;
use Modules\Administration\Repositories\PaysRepositoryEloquent;
use Modules\Patient\Http\Requests\PatientInsuranceStoreRequest;
use Modules\Patient\Http\Requests\PatientInsuranceUpdateRequest;
use Modules\Administration\Repositories\CommuneRepositoryEloquent;
use Modules\Patient\Repositories\PatientInsuranceRepositoryEloquent;
use Modules\Administration\Repositories\DepartementRepositoryEloquent;
use Modules\Patient\Http\Controllers\Api\V1\PatientInsuranceController;
use Modules\Administration\Repositories\ArrondissementRepositoryEloquent;

class PatienteController extends PatientController
{

    /**
     * @var PostRepository
     */
    protected $patienteRepositoryEloquent, $arrondissementRepositoryEloquent,
        $userRepositoryEloquent, $departementRepositoryEloquent, $communeRepositoryEloquent,
        $paysRepositoryEloquent, $patientInsuranceRepositoryEloquent, $packRepositoryEloquent;

    //  $patientInsuranceRepositoryEloquent;

    public function __construct(
        PatienteRepositoryEloquent $patienteRepositoryEloquent,
        ArrondissementRepositoryEloquent $arrondissementRepositoryEloquent,
        UserRepositoryEloquent $userRepositoryEloquent,
        DepartementRepositoryEloquent $departementRepositoryEloquent,
        CommuneRepositoryEloquent $communeRepositoryEloquent,
        PaysRepositoryEloquent $paysRepositoryEloquent,
        PatientInsuranceRepositoryEloquent $patientInsuranceRepositoryEloquent,
        PackRepositoryEloquent $packRepositoryEloquent,
        // PatientInsuranceRepositoryEloquent $patientInsuranceRepositoryEloquent
    ) {
        parent::__construct();
        $this->patienteRepositoryEloquent = $patienteRepositoryEloquent;
        $this->arrondissementRepositoryEloquent = $arrondissementRepositoryEloquent;
        $this->userRepositoryEloquent = $userRepositoryEloquent;
        $this->departementRepositoryEloquent = $departementRepositoryEloquent;
        $this->communeRepositoryEloquent = $communeRepositoryEloquent;
        $this->paysRepositoryEloquent = $paysRepositoryEloquent;
        $this->patientInsuranceRepositoryEloquent = $patientInsuranceRepositoryEloquent;
        $this->packRepositoryEloquent = $packRepositoryEloquent;
        // $this->patientInsuranceRepositoryEloquent = $patientInsuranceRepositoryEloquent;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(PatienteIndexRequest $request)
    {
        $donnees = $this->patienteRepositoryEloquent->orderBy('created_at', 'desc')->paginate($this->nombrePage);
        return new PatientesResource($donnees);
    }

    public function search($request)
    {
        $donnees = $this->patienteRepositoryEloquent->where('lastname', 'like', "%$request%")
        ->orWhere('firstname', 'like', "%$request%")->orWhere('email', 'like', "%$request%")
        ->orWhere('ipp', 'like', "%$request%")->orWhere('phone', 'like', "%$request%")
        ->orWhere('gender', 'like', "%$request%")->orWhere('nom_marital', 'like', "%$request%")
        ->orderBy('created_at', 'desc')->paginate($this->nombrePage);
        return new PatientesResource($donnees);
    }

    /**
     * Display resource.
     *
     * @return Response
     */
    public function show($uuid)
    {
        $item = $this->patienteRepositoryEloquent->findByUuidOrFail($uuid)->first();  //existe-il cet element?
        return new PatienteResource($item);
    }

    /**
     * Create a resource.
     *
     * @return Response
     */
    public function store(PatienteStoreRequest $request)
    {

        // Récupérez toutes les données du formulaire
        $attributs = $request->all();

        // $user = $this->userRepositoryEloquent->findByUuid($attributs['users_id'])->first();
        // $attributs['users_id'] = $user->id;

        // Créez un tableau pour les données du patient
        $patientData = [
            'lastname' => $attributs['lastname'],
            'firstname' => $attributs['firstname'],
            'date_birth' => $attributs['date_birth'],
            'age' => $attributs['age'],
            'maison' => $attributs['maison'],
            'phone' => $attributs['phone'],
            'email' => $attributs['email'],
            'whatsapp' => $attributs['whatsapp'],
            'profession' => $attributs['profession'],
            'gender' => $attributs['gender'],
            'emergency_contac' => $attributs['emergency_contac'],
            'marital_status' => $attributs['marital_status'],
            'autre' => $attributs['autre'],
            'nom_marital' => $attributs['nom_marital'],
            // 'date_deces' => $attributs['date_deces'],
            'code_postal' => $attributs['code_postal'],
            'nom_pere' => $attributs['nom_pere'],
            'phone_pere' => $attributs['phone_pere'],
            'nom_mere' => $attributs['nom_mere'],
            'phone_mere' => $attributs['phone_mere'],
            'quartier' => $attributs['quartier'],
            'pays_id' => 1,
            'departements_id' => $attributs['departements_id'],
            'communes_id' => $attributs['communes_id'],
            'arrondissements_id' => $attributs['arrondissements_id'],
            'quartier' => $attributs['quartier'],

            // 'users_id' => $attributs['users_id'],

            'users_id' => 1,
        ];

        $patient = $this->patienteRepositoryEloquent->create($patientData);

        // $patientinsuranceRequest = new PatientInsuranceStoreRequest();
        // $patientinsuranceRequest->patients_id = $patient->id;
        // $patientinsuranceRequest->pack_id = $attributs['pack_id'];
        // $patientinsuranceController = new PatientInsuranceController($this->patientInsuranceRepositoryEloquent, $this->patienteRepositoryEloquent, $this->packRepositoryEloquent);

        // $patientinsuranceController->store($patientinsuranceRequest);

        $patient = $patient->fresh();

        return new PatienteResource($patient);
    }



    /**
     * Update a resource.
     *
     * @return Response
     */
    // public function update(PatienteUpdateRequest $request, $uuid)
    // {
    //     $item = $this->patienteRepositoryEloquent->findByUuidOrFail($uuid)->first();  //existe-il cet element?
    //     $attributs = $request->all();
    //     $item = $this->patienteRepositoryEloquent->update($attributs, $item->id);
    //     $item = $item->fresh();
    //     return new PatienteResource($item);
    // }
    public function update(PatienteUpdateRequest $request, $uuid)
    {
        $patient = $this->patienteRepositoryEloquent->findByUuidOrFail($uuid)->first();  //existe-il cet element?
        $attributs = $request->all();
        \Log::info($attributs);
        // $item = $this->patienteRepositoryEloquent->update($attributs, $item->id);
        $patientData = [
            'lastname' => $attributs['lastname'],
            'firstname' => $attributs['firstname'],
            'date_birth' => $attributs['date_birth'],
            'age' => $attributs['age'],
            'maison' => $attributs['maison'],
            'phone' => $attributs['phone'],
            'email' => $attributs['email'],
            'whatsapp' => $attributs['whatsapp'],
            'profession' => $attributs['profession'],
            'gender' => $attributs['gender'],
            'emergency_contac' => $attributs['emergency_contac'],
            'marital_status' => $attributs['marital_status'],
            'autre' => $attributs['autre'],
            'nom_marital' => $attributs['nom_marital'],
            'date_deces' => $attributs['date_deces'],
            'code_postal' => $attributs['code_postal'],
            'nom_pere' => $attributs['nom_pere'],
            'nom_mere' => $attributs['nom_mere'],
            'phone_pere' => $attributs['phone_pere'],
            'phone_mere' => $attributs['phone_mere'],
            'quartier' => $attributs['quartier'],
            'pays_id' => 1,
            'departements_id' => $attributs['departements_id'],
            'communes_id' => $attributs['communes_id'],
            'arrondissements_id' => $attributs['arrondissements_id'],
            // 'users_id' => $attributs['users_id'],
        ];

        // $patient = $this->patienteRepositoryEloquent->create($patientData);
        $this->patienteRepositoryEloquent->update($patientData, $patient->id);

        // $patientinsuranceRequest = new PatientInsuranceUpdateRequest();
        // $patientinsuranceRequest->patients_id = $patient->id;
        // $patientinsuranceRequest->pack_id = $attributs['pack_id'];
        // $patientinsuranceRequest->date_debut = $attributs['date_debut'];
        // $patientinsuranceRequest->date_fin = $attributs['date_fin'];
        // return $request;
        // $patientinsuranceController = new PatientInsuranceController($this->patientInsuranceRepositoryEloquent, $this->patienteRepositoryEloquent, $this->packRepositoryEloquent);
        // $patientinsurance = $this->patientInsuranceRepositoryEloquent->where("patients_id", $patient->id)->first();
        // $patientinsuranceController->update($patientinsuranceRequest, $patientinsurance->uuid);

        $patient = $patient->fresh();

        return new PatienteResource($patient);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $patiente = $this->patienteRepositoryEloquent->findByUuidOrFail($uuid)->first();  //existe-il cet element?
        //@TODO : Implémenter les conditions de suppression
        $this->patienteRepositoryEloquent->delete($patiente->id);

        $data = [
            "message" => __("Patient supprimé avec succès"),
        ];
        return reponse_json_transform($data);
    }

    public function countPatients()
    {
        $patientsCount = Patiente::count();
        
        return response()->json($patientsCount, 200);
    }
}
