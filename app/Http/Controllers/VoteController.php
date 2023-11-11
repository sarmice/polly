<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class VoteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'option_id' => 'required|exists:options,id',
        ]);

        $sessionId = $request->cookie('session_id') ?? (string) Str::uuid();
        $userId = auth()->id();

        $vote = new Vote([
            'option_id' => $request->input('option_id'),
            'user_id' => $userId, // This will be null if the user is not logged in
            'session_id' => $userId ? null : $sessionId, // Use session_id only if user is not authenticated
        ]);

        $vote->save();

        // If the user is not logged in, store the session_id in a cookie to remember the user
        $cookie = Cookie::forever('session_id', $sessionId);

        return back()->withCookie($cookie);
    }
}
