<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $admin = User::where('role', 'admin')->first();

        // Ambil semua chat antara jamaah dan admin
        $messages = Chat::where(function ($query) use ($user, $admin) {
            $query->where('sender_id', $user->id)
                  ->where('receiver_id', $admin->id);
        })->orWhere(function ($query) use ($user, $admin) {
            $query->where('sender_id', $admin->id)
                  ->where('receiver_id', $user->id);
        })->orderBy('created_at', 'asc')->get();

        return view('jamaah.chat', compact('messages', 'admin'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        $admin = User::where('role', 'admin')->first();

        Chat::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $admin->id,
            'message' => $request->message,
        ]);

        return redirect()->back();
    }
}
