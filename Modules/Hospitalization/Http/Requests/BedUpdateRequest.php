<?php

namespace Modules\Hospitalization\Http\Requests;

use Illuminate\Validation\Rule;

class BedUpdateRequest extends BedRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() 
    {
        // return user_api()->isPermission("update $this->entite");
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() 
    {
        $uuid = request()->route($this->nom_param_route);
        $rules = $this->reglesCommunes();

        $rules['name'] = [
            'bail',
            'required',
            'string',
            'min:3',
            'max:15',
            Rule::unique($this->nom_table)->ignore($uuid, 'uuid'),
        ];

        return $rules;
    }
}
