<?php

namespace Modules\Stock\Http\Requests;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class StockTransferRequest extends BaseRequest {

    protected $entite = "StockTransfer"; //Nom de l'objet, pour les permissions par exemple
    protected $nom_param_route = "stock_transfer"; //request route parameter
    protected $nom_table_suffixe = "stock_transfers"; //le nom de la table sans prefixe
    protected $prefixe_table = null;   //prefixe des tables du module
    protected $nom_table = null; //le nom de la table sans prefixe

    public function __construct() {
        parent::__construct();
        $this->prefixe_table = config('stock.prefixe_table');
        $this->nom_table = $this->prefixe_table.$this->nom_table_suffixe;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function reglesCommunes() {
        $rules = [
            'model_name' => [
                'bail',
                'required',
                'string',
                'in:Service,Stock'
            ],
            'model_id ' => [
                'bail',
                'required',
                'uuid',
            ],
            'from_stock_id ' => [
                'bail',
                'required',
                'uuid',
                'exists:Modules\Stock\Entities\Stock,uuid',
            ],
            'stockTransferProducts' => [
                'bail',
                'required',
                'array',
            ],
            'stockTransferProducts.*.product_id' => [
                'bail',
                'required',
                'uuid',
                'exists:Modules\Stock\Entities\Product,uuid',
            ],
            'stockTransferProducts.*.quantity_to_transfer' => [
                'bail',
                'required',
                'integer',
                'min:1',
                'max:999999999',
            ],
        ];
        return $rules;
    }
}
