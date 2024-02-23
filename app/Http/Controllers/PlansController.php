<?php

namespace App\Http\Controllers;

use App\Models\Plans;
use Illuminate\Http\Request;

class PlansController extends Controller
{
    public function createPlan(Request $request){
    $request->validate([
        'name' => 'required',
        'email' => 'required',
        'phone_no'=> 'required',
        'trip_details' => 'required'
    ]);
    $plan = $request->all();
    Plans::create($plan);
    return response(['message'=> 'Plans submitted successfully!']);
    }
    public function getPlans(){
        $plans = Plans::all();
        return $plans;
    }
    public function getPlanRequest($id){
        $plan = Plans::find($id);
        if($plan){
            return $plan;
        }
        else{
            return response(['message'=> 'Plan not Found!'], 400);
        }
    }
}
