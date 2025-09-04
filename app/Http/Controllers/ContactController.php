<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


use App\Models\Message;




class ContactController extends Controller
{
        public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Message::create($data); // <- ça envoie dans la table messages

        return redirect()->back()->with('success', 'Message envoyé avec succès !');
    }
}
    