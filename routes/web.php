<?php

use Illuminate\Http\Request;


Route::get('/', function (Request $request) {
    // $query = (new \App\Models\Design)->newQuery();
    // if ($request->q) {
    //     $query->orWhere(function($q) use ($request){
    //         $q->where('title', 'LIKE', '%'.$request->q.'%')
    //             ->orWhere('description', 'LIKE', '%'.$request->q.'%');
    //     });
    // }
    // $query->has('comments');
    // $q->has('team');
    // $q->withCount('likes')
    //     ->orderByDesc('likes_count');
    
    
    // get by tag
    //$q->withAllTags('adobe-photoshop');
    // dd($query->get());




    return view('welcome');
});
