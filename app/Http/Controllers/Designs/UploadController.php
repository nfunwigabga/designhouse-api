<?php

namespace App\Http\Controllers\Designs;

use App\Jobs\UploadImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\IDesign;

class UploadController extends Controller
{
    protected $designs;

    public function __construct(IDesign $designs)
    {
        $this->designs = $designs;
    }

    public function upload(Request $request)
    {
        // validate the request
        $this->validate($request, [
            'image' => ['required', 'mimes:jpeg,gif,bmp,png', 'max:2048']
        ]); 

        // get the image
        $image = $request->file('image');
        $image_path = $image->getPathName();


        // get the original file name and replace any spaces with _
        // Business Cards.png = timestamp()_business_cards.png
        $filename = time()."_". preg_replace('/\s+/', '_', strtolower($image->getClientOriginalName()));
        
        // move the image to the temporary location (tmp)
        $tmp = $image->storeAs('uploads/original', $filename, 'tmp');

        // create the database record for the design
        // $design = auth()->user()->designs()->create([
        //     'image' => $filename,
        //     'disk' => config('site.upload_disk')
        // ]);

        $design = $this->designs->create([
            'user_id' => auth()->id(),
            'image' => $filename,
            'disk' => config('site.upload_disk')
        ]);

        // dispatch a job to handle the image manipulation
        $this->dispatch(new UploadImage($design));
        
        return response()->json($design, 200);

    }
}
