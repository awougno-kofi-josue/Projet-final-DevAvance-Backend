<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageAdminController extends Controller
{
    // Affiche la liste des messages
    public function index()
    {
        $messages = Message::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    // Supprimer un message
    public function destroy(Message $message)
    {
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message supprimé avec succès.');
    }
}

