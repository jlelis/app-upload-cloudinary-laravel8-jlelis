<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function showUploadForm()
    {
        $images = Upload::all();
        return view('upload', compact('images'));

    }


    public function storeUploads(Request $request)
    {
        //get file POST
        $image = $request->file('file');

        //get name original file
        $image_name = $image->getClientOriginalName();
        //test random create past oncloud
        $pastas = random_int(1,99);

        // $image_url = cloudinary()->upload($image->getRealPath())->getSecurePath();
        $image_url = $request->file('file')->storeOnCloudinary('deleteme/'.$pastas)->getSecurePath();

        //save local
        // $image->move(public_path('images'), $image_name);
       
        //method to save database
        $image = new Upload();
        $image->image_name = $image_name;
        $image->image_url = $image_url;

        $image->save();


        return back()
            ->with('success', 'File uploaded successfully');
    }

    public function saveImages(Request $request, $image_url)
    {
        $image = new Upload();
        $image->image_name = $request->file('image_name')->getClientOriginalName();
        $image->image_url = $image_url;
        $image->save();
    }
}
