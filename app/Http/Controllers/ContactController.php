<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\contact;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request){
        $data =  $request->validated();
            contact::create($data);
            return back()->with('status-message' , 'Your message sent Successfuly');
        }
}
