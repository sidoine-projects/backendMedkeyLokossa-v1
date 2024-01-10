<?php

namespace Modules\Hospitalization\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class RoomStoreRequest extends RoomRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() 
    {
        // return user_api()->isPermission("create $this->entite");
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() 
    {
        $rules = $this->reglesCommunes();
        return $rules;
    }
}
