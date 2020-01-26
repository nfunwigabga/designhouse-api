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


    public function applyTags($id, array $data)
    {
        $design = $this->find($id);
        $design->retag($data);
    }

    public function addComment($designId, array $data)
    {
        // get the design for which we want to create a comment
        $design = $this->find($designId);

        // create the comment for the design
        $comment = $design->comments()->create($data);

        return $comment;
    }
    

}