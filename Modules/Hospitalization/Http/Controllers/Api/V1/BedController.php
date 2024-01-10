<?php

namespace Modules\Hospitalization\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\DB;
use Modules\Hospitalization\Entities\Bed;
use Modules\Hospitalization\Entities\Room;
use Modules\Acl\Repositories\UserRepository;
use Modules\Hospitalization\Http\Resources\BedResource;
use Modules\Hospitalization\Http\Resources\BedsResource;
use Modules\Hospitalization\Http\Requests\BedIndexRequest;
use Modules\Hospitalization\Http\Requests\BedStoreRequest;
use Modules\Hospitalization\Http\Requests\BedDeleteRequest;
use Modules\Hospitalization\Http\Requests\BedUpdateRequest;
use Modules\Patient\Repositories\PatienteRepositoryEloquent;
use Modules\Hospitalization\Repositories\BedRepositoryEloquent;
use Modules\Hospitalization\Repositories\RoomRepositoryEloquent;
use Modules\Hospitalization\Http\Controllers\HospitalizationController;

class BedController extends HospitalizationController {

    /**
     * @var BedRepositoryEloquent
     */
    protected $bedRepositoryEloquent;

    /**
     * @var RoomRepositoryEloquent
     */
    protected $roomRepositoryEloquent;

    /**
     * @var PatienteRepositoryEloquent
     */
    protected $patienteRepositoryEloquent;

    /**
     * @var UserRepository
     */
    protected $userRepositoryEloquent;

    public function __construct(
        BedRepositoryEloquent $bedRepositoryEloquent,
        RoomRepositoryEloquent $roomRepositoryEloquent,
        PatienteRepositoryEloquent $patienteRepositoryEloquent,
        UserRepository $userRepositoryEloquent,
    ) {
        parent::__construct();
        $this->bedRepositoryEloquent = $bedRepositoryEloquent;
        $this->roomRepositoryEloquent = $roomRepositoryEloquent;
        $this->patienteRepositoryEloquent = $patienteRepositoryEloquent;
        $this->userRepositoryEloquent = $userRepositoryEloquent;
    }

    
    /**
     * Return a listing of the resource.
     * @param BedIndexRequest $request
     * @return BedsResource
     */
    public function index(BedIndexRequest $request)
    {
        $data = $this->bedRepositoryEloquent->paginate($this->nombrePage);
        return new BedsResource($data);
    }

    /**
     * Show the specified resource.
     * @param BedIndexRequest $request
     * @param string $uuid
     * @return BedResource
     */ 
    public function show(BedIndexRequest $request, $uuid) 
    {
        try {
            $item = $this->bedRepositoryEloquent->findByUuid($uuid)->first();

            if (!$item) {
                return reponse_json_transform(['message' => 'Lit non trouvé'], 404);
            }

            return new BedResource($item);
        } catch (\Exception $e) {
            return reponse_json_transform(['message' => 'Erreur interne du serveur'], 500);
        }
    }
    
    /**
     * Store a newly created resource in storage.
     * @param BedStoreRequest $request
     * @return BedResource
     */
    public function store(BedStoreRequest $request)
    {
        try {
            $attributes = $request->all();
            $room = $this->roomRepositoryEloquent->findByUuid($attributes['room_id'] )->first();

            // Check if the room's bed capacity is reached
            if ($room->beds->count() >= $room->bed_capacity) {
                return reponse_json_transform(['message' => 'La capacité de lit maximale pour cette salle est atteinte.'], 400);
            }

            $item = DB::transaction(function () use ($attributes) {
                $room = $this->roomRepositoryEloquent->findByUuid($attributes['room_id'] )->first();

                $attributes['user_id'] = auth()->user()->id;
                $attributes['room_id'] = $room->id;

                //Generate the bed code based on:
                //The prefix LIT
                //Then followed by five random number
                $prefix = "LIT";

                $generatedCode = '';

                do {
                    $randomNumbers = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
                    $generatedCode = $prefix . '-' . $randomNumbers;

                    // Check if a product with this code already exists
                    $existingCode = $this->roomRepositoryEloquent->findByCode($generatedCode);
                } while ($existingCode);

                // Add the generated code to the attributs
                $attributes['code'] = $generatedCode;

                $item = $this->bedRepositoryEloquent->create($attributes);
                return $item;
            });

            $item = $item->fresh();

            return new BedResource($item);
        } catch (\Exception $e) {
            return reponse_json_transform(['message' => 'Erreur interne du serveur'], 500);
        }
    }
    
    /**
     * Update the specified resource in storage.
     * @param BedUpdateRequest $request
     * @return BedResource
     */
    public function update(BedUpdateRequest $request, $uuid)
    {
        try {
            $item = $this->bedRepositoryEloquent->findByUuid($uuid)->first();

            if (!$item) {
                return reponse_json_transform(['message' => 'Lit non trouvé'], 404);
            }

            $attributes = $request->all();

            $room = $this->roomRepositoryEloquent->findByUuid($attributes['room_id'] )->first();

            $attributes['user_id'] = auth()->user()->id;
            $attributes['room_id'] = $room->id;

            // Check if the room's bed capacity is reached
            if ($room->beds->count() >= $room->bed_capacity) {
                return reponse_json_transform(['message' => 'La capacité de lit maximale pour cette salle est atteinte.'], 400);
            }
    
            $item = $this->bedRepositoryEloquent->update($attributes, $item->id);
            $item = $item->fresh();

            return new BedResource($item);
        } catch (\Exception $e) {
            return reponse_json_transform(['message' => 'Erreur interne du serveur'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param BedDeleteRequest $request
     * @param string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy(BedDeleteRequest $request, $uuid)
    {
        try {
            $item = $this->bedRepositoryEloquent->findByUuid($uuid)->first();

            if (!$item) {
                return reponse_json_transform(['message' => 'Lit non trouvé'], 404);
            }

            if ($item->allPatients->count() > 0) {
                $data = ["message" => __("Impossible de supprimer ce lit ! Il est lié à au moins un patient.")];
                return reponse_json_transform($data, 400);
            } else {
                $this->bedRepositoryEloquent->delete($item->id);
                $data = ["message" => __("Lit supprimé avec succès !")];
                return reponse_json_transform($data);
            } 
        } catch (\Exception $e) {
            return reponse_json_transform(['message' => 'Erreur interne du serveur'], 500);
        }
    }    

    //Not yet verified
    public function affectPatient($bedUuid, $patientUuid)
    {
        try {
            $bed = $this->bedRepositoryEloquent->findByUuid($bedUuid)->first();

            if (!$bed) {
                return reponse_json_transform(['message' => 'Lit non trouvé'], 404);
            }

            $patient = $this->patienteRepositoryEloquent->findByUuid($patientUuid)->first();
            if (!$patient) {
                return reponse_json_transform(['message' => 'Patient non trouvé'], 404);
            }

            $attributes['patient_id'] = $patient->id;
            $attributes['state'] = 'busy';
    
            $bed = $this->bedRepositoryEloquent->update($attributes, $bed->id);
            $bed = $bed->fresh();

            return new BedResource($bed);
        } catch (\Exception $e) {
            return reponse_json_transform(['message' => 'Erreur interne du serveur'], 500);
        }
    }

    public function countCurrentlyHospitalizedPatients()
    {
        try {
            // Retrieve all beds
            $beds = Bed::all();

            // Initialize a variable to keep track of the total count
            $totalCurrentlyHospitalizedPatients = 0;

            // Iterate over each bed
            foreach ($beds as $bed) {
                // Check if the bed is currently occupied (based on the 'state' attribute)
                if ($bed->state === 'busy') {
                    // Increment the count for currently hospitalized patients
                    $totalCurrentlyHospitalizedPatients++;
                }
            }
          
            return response()->json(['total_currently_hospitalized_patients' => $totalCurrentlyHospitalizedPatients], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
