<?php

namespace Modules\Absence\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class AbsentStoreRequest extends AbsentRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        // return user_api()->isPermission("create $this->entite");
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $rules = $this->reglesCommunes();
        return $rules;
    }

}
