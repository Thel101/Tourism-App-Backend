<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactsController extends Controller
{
    public function createContact(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'reason' => 'required',
                'comments' => 'required',

            ]
        );

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $contactData = $request->all();
        Contacts::create($contactData);
<<<<<<< HEAD
        return response()->json(['message' => 'Contacts submitted successfully!'],200);
=======
        return response(['message'=> 'Contact successfully submitted!']);
>>>>>>> c1392d5 (added DestinationImage)
    }
    public function getContacts()
    {
        $contacts = Contacts::all();
        return $contacts;
    }
    public function getContactDetail($id)
    {
        $contact = Contacts::find($id);
        if ($contact) {
            return $contact;
        } else {
            return response(['message' => 'Contact form not found!']);
        }
    }
}
