<?php
namespace App\Repositories\Eloquent;
use App\Models\Design;
use App\Repositories\Contracts\IDesign;
use App\Repositories\Eloquent\BaseRepository;

class DesignRepository extends BaseRepository implements IDesign
{
    
    public function model()
    {
        return Design::class; 
    }

    public function allLive()
    {
        return $this->model->where('is_live', true)->get();
    }

    public function applyTags($id, array $data)
    {
        $design = $this->find($id);
        $design->retag($data);
    }
    

}