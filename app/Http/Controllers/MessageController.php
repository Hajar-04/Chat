<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Envoyer un message.
     */
    public function sendMessage(Request $request)
    {
        // Valider les données de la requête
        $validated = $request->validate([
            'text' => 'required|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:2048',
        ]);

        // Créer le message
        $message = new Message([
            'text' => $validated['text'],
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('public/files');
            $message->file_path = $path;
        }

        $message->save();

        // Émettre l'événement
        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message);
    }

    /**
     * Obtenir tous les messages.
     */
    public function getMessages()
    {
        // Récupérer les messages avec les informations de l'utilisateur
        $messages = Message::with('user')->latest()->get();
        return response()->json($messages);
    }
    public function show($friendId)
    {
        $friend = User::findOrFail($friendId);
        $messages = Message::where(function ($query) use ($friendId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $friendId);
        })->orWhere(function ($query) use ($friendId) {
            $query->where('sender_id', $friendId)
                  ->where('receiver_id', Auth::id());
        })->get();

        return view('chat.show', compact('friend', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'message' => 'required|string|max:255',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return response()->json(['success' => true]);
    }
}
