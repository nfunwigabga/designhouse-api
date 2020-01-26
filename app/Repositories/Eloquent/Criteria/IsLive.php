<?php 
namespace App\Repositories\Eloquent\Criteria;

use App\Repositories\Criteria\ICriterion;

class IsLive implements ICriterion
{

    public function apply($model)
    {
        return $model->where('is_live', true);
    }
}