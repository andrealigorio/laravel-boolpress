<?php

namespace App\Http\Controllers;

use App\Mail\SendNewMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Lead;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('guests.home');
    }

    public function contacts() {
        return view('guests.contacts');
    }
    
    public function thanks()
    {
        return view('guests.thanks');
    }
    
    public function contactSent(Request $request) {
        
        $data = $request->all();
        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        Mail::to('commerciale@boolpress.it')->send(new SendNewMail($new_lead));

        return redirect()->route('thanks');
    }

}
