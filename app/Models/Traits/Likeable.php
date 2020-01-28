<?php 
namespace App\Models\Traits;

use App\Models\Like;

trait Likeable
{
    public static function bootLikeable()
    {
        static::deleting(function($model){
            $model->removeLikes();
        });
    }

    // delete likes when model is being deleted
    public function removeLikes()
    {
        if($this->likes()->count()){
            $this->likes()->delete();
        }
    }


    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like()
    {
        if(! auth()->check()) return;
    
        // check if the current user has already liked the model
        if($this->isLikedByUser(auth()->id())){
            return;
        };
       
        $this->likes()->create(['user_id' => auth()->id()]);
    }

    public function unlike()
    {
        if(! auth()->check()) return;

        if(! $this->isLikedByUser(auth()->id())){
            return;
        }

        $this->likes()
            ->where('user_id', auth()
            ->id())->delete();
    }

    public function isLikedByUser($user_id)
    {
        return (bool)$this->likes()
                ->where('user_id', $user_id)
                ->count();
    }

    

}