<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DestinationImages;
use Illuminate\Support\Facades\Storage;

class DestinationImagesController extends Controller
{
    // public function uploadImages(Request $request)
    // {
    //     $info = $request->all();

    //     if ($request->hasFile('destination_image')) {
    //         foreach($request->file('destination_image') as $image){
    //             $filename = uniqid() . $image->getClientOriginalName();
    //             $image->storeAs('public/images/', $filename); // Store the file in storage/app/uploads
    //             $info['destination_image'] = $filename;
    //         }

    //     }
    //     logger($info);
    //     DestinationImages::create($info);
    //     return response(['message'=> 'image uploaded']);
    // }
    public function uploadImages(Request $request)
    {
        $info = $request->all();
        $destinationId = $request->destination_id;
        if ($request->hasFile('destination_image')) {


            foreach ($request->file('destination_image') as $image) {
                $filename = uniqid() . $image->getClientOriginalName();
                $image->storeAs('public/images/', $filename);

                DestinationImages::create([
                    'destination_id' => $destinationId,
                    'destination_image' => $filename, // Store the filename in the destination_image column
                ]);
            }
        }

        return response(['message' => 'Images uploaded']);
    }
    public function getImages($id)
    {
        $images = DestinationImages::where('destination_id', $id)->pluck('destination_image');
        return $images;
    }
}
