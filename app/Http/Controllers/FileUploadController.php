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
        $image = $request->file('file');
        $image_name = $image->getClientOriginalName();

        // $image_url = cloudinary()->upload($image->getRealPath())->getSecurePath();
        $image_url = $request->file('file')->storeOnCloudinary()->getSecurePath();
        //save local
        $image->move(public_path('images'), $image_name);
        // Store the uploaded file in the "lambogini" directory on Cloudinary with the filename "prosper"
        // $result = $request->file->storeOnCloudinaryAs('imoveis', $image_name);
        // dd($image_url);

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
