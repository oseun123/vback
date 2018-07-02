<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Images;

class ImagesController extends Controller
{
    public function uploadImages(Request $request){
   
        if ($request->hasFile('images')) {
            // return 'ok';
            foreach ($request->images as  $image) {
                $imagename=$image->getClientOriginalName();
                $image->storeAs('public/images', $imagename);
               $upload = Images::firstOrCreate(['name' => $imagename ]);
            //    $upload->name = $imagename;
            //    $upload->save();

                return response()->json(['data' => 'Data uploaded Successfully'], Response::HTTP_CREATED);

            };

           
        }

    }
}
