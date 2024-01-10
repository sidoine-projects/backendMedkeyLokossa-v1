<?php

namespace Modules\Absence\Http\Requests;

use Illuminate\Validation\Rule;

class VacationUpdateRequest extends VacationRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        // return user_api()->isPermission("update $this->entite");
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $uuid = request()->route($this->nom_param_route);
        $rules = $this->reglesCommunes();
        
        return $rules;
    }

}