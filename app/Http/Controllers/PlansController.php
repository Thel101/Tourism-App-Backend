<?php

namespace App\Http\Controllers;

use App\Models\Plans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PlansController extends Controller
{
    public function createPlan(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone_no' => 'required|min:10|max:15',
                'trip_details' => 'required',
                'destination' => 'required',
                'travel_date' => 'required',
                'budget_range' => 'required'
            ]

        );
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $plan = $request->all();
        Plans::create($plan);
        return response()->json(['message' => 'Plans submitted successfully!'],200);
    }
    public function getPlans()
    {
        $plans = Plans::all();
        return $plans;
    }
    public function getPlanRequest($id)
    {
        $plan = Plans::find($id);
        if ($plan) {
            return $plan;
        } else {
            return response(['message' => 'Plan not Found!'], 400);
        }
    }
}
