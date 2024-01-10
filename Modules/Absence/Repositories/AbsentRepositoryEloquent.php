<?php

namespace Modules\Absence\Repositories;

use App\Repositories\AppBaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Contracts\RepositoryInterface;
use Modules\Absence\Entities\Absent;

/**
 * Class TenantRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AbsentRepositoryEloquent extends AppBaseRepository implements RepositoryInterface {

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model() {
        return Absent::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot() {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}