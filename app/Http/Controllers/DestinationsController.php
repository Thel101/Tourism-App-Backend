<?php

namespace App\Http\Controllers;

use App\Models\Destinations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinationsController extends Controller
{
    public function createDestination(Request $request){
        $request->validate([
            'country'=>'required',
            'description'=>'required',
            'body'=>'required',
            'country_image'=>'required'
        ]
        );
        $country = $request->all();
        if($request->hasFile('country_image')){
            $filename= uniqid().$request->file('country_image')->getClientOriginalName();
            $request->file('country_image')->storeAs('public/images/',$filename);
            $country['country_image']= $filename;
        }
        Destinations::create($country);
        return response()->json(['message'=> 'New Desintation created successfully']);

    }
    public function getDestinationImage($filename){
        $path= 'public/images/' . $filename;
        try{
            $image = Storage::get($path);
            $mimeType = Storage::mimeType($path);
            return response($image,200)->header('Content-Type', $mimeType);
        }
        catch(\Exception $e){
            return response('Error retrieving image'.$e->getMessage(),500);
        }
    }
    public function getDestinations(){
        $countries = Destinations::paginate(4);
        return $countries;
    }
    public function getDestination($id){
        $destination = Destinations::find($id);
        return $destination;
    }
    public function editDestination(Request $request){
        $destination = Destinations::where('id',$request->id)->first();

       $request->validate([
        'country' => 'required',
        'description' => 'required',
        'body' => 'required',
    ]);
    $updateData = $request->all();
    $photo = $request->file('country_image');
    if ($photo) {
        $existingImage = $destination->country_image;
        if(Storage::exists($existingImage)){
            Storage::delete($existingImage);
        }
        $filename = uniqid() . $photo->getClientOriginalName();
        $photo->storeAs('public/images/', $filename);
        $updateData['country_image'] = $filename;
    }
    else {
        // If no new image uploaded, retain the existing background image
        unset($updateData['country_image']); // Remove 'background' key from updateData
    }
    $destination->update($updateData);
    return response()->json(['message'=>'Destination Updated Successfully']);
    }
    public function deleteDestination($id){
        $destination = Destinations::find($id);
        if($destination){
            $photo = $destination->country_image;
            if($photo){
                $image = 'public/images/' . $photo;
                Storage::delete($image);
            }
            $destination->delete();
            return response()->json(['message'=> 'Destination deleted successfully!']);
        }
        else{
            return response()->json(['message'=> 'Destination not found']);
        }
    }
}
