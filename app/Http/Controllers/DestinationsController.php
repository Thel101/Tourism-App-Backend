<?php

namespace App\Http\Controllers;

use App\Models\Destinations;
use Illuminate\Http\Request;

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
    public function getDestinations(){

    }
}
