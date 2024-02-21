<?php

namespace App\Http\Controllers;

use App\Models\trialForm;
use Illuminate\Http\Request;

class TrialFormController extends Controller
{
    public function createForm(Request $request){
        $data = $request->all();
        TrialForm::create($data);
        return response()->json(['message'=> 'Form created successfully!']);
    }
}
