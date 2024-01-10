<?php

namespace Modules\Hospitalization\Repositories;

use App\Repositories\AppBaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;
use Modules\Hospitalization\Entities\Bed;

/**
 * Class BedRepositoryEloquent.
 *
 * @package namespace Modules\Hospitalization\Repositories;
 */
class BedRepositoryEloquent extends AppBaseRepository implements RepositoryInterface {

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model() {
        return Bed::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot() {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
