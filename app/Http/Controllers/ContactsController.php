<?php

namespace App\Http\Controllers;

use App\Models\Contacts;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function createContact(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'reason' => 'required',
            'comments' => 'required',
        ]);
        $contactData= $request->all();
        Contacts::create($contactData);
        return response(['message'=> 'Contac successfully submitted!']);
    }
    public function getContacts(){
        $contacts = Contacts::all();
        return $contacts;
    }
    public function getContactDetail($id){
        $contact = Contacts::find($id);
        if($contact){
            return $contact;
        }
        else{
            return response(['message'=> 'Contact form not found!']);
        }
    }
}
