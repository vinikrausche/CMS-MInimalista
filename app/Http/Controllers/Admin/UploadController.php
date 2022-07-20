<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request){
        $request->validate([
            'file' => 'required|image|mimes:jpeg,jpg,png,gif'
        ]);

        $ext = $request->file->extension();
        $imageName = md5(time().rand()).'.'.$ext;

        $request->file->move(public_path('media/images'),$imageName);

        return [
            'location' => asset('media/images/'.$imageName)
        ];
    }
}
