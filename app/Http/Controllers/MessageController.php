<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function showChat($id)
    {
        $userId1 = $id;
        $userId2 = auth()->user()->id;

        $messages = Message::where(function ($query) use ($userId1, $userId2) {
            $query->where('sender_id', $userId1)->where('receiver_id', $userId2);
        })->orWhere(function ($query) use ($userId1, $userId2) {
            $query->where('sender_id', $userId2)->where('receiver_id', $userId1);
        })->orderBy('created_at')->get();

        $user = User::findOrFail($id);

        return view('pages.auth.profile.variants.messages', compact('messages', 'user'));
    }
    public function showChats($id)
    {
        $user = User::findOrFail($id);

        // Получаем все чаты пользователя
        $chats = Message::where('sender_id', $user->id)
            ->orWhere('receiver_id', $user->id)
            ->selectRaw('CASE WHEN sender_id = ? THEN receiver_id ELSE sender_id END AS chat_user_id', [$user->id])
            ->distinct()
            ->get();

        $chatUsers = User::whereIn('id', $chats->pluck('chat_user_id'))->get();

        return view('pages.auth.profile.variants.chats', compact('user', 'chatUsers'));
    }
    public function sendMessage(Request $request, $id)
    {
        $validatedData = $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:255',
        ]);

        $message = Message::create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $id,
            'content' => $validatedData['content'],
        ]);

        return response()->json($message);
    }
}
