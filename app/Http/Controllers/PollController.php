<?php

namespace App\Http\Controllers;

use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class PollController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $sessionId = $request->cookie('session_id');

        $polls = Poll::query()
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            })
            ->when($sessionId && !$userId, function ($query) use ($sessionId) {
                return $query->where('session_id', $sessionId);
            })
            ->latest()
            ->get();

        return view('polls.index', compact('polls'));
    }

    public function create()
    {
        return view('polls.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'options.*' => 'required|string|max:255',
        ]);

        $userId = auth()->id();
        $sessionId = $request->cookie('session_id');

        if (!$sessionId && !$userId) {
            $sessionId = Str::uuid();
        }

        $poll = new Poll([
            'title' => $request->title,
            'user_id' => $userId,
            'session_id' => $userId ? null : $sessionId,
        ]);

        $poll->save();

        foreach ($request->options as $option) {
            $poll->options()->create(['text' => $option]);
        }

        $response = redirect()->route('polls.show', $poll->uuid);

        if (!$userId) {
            $cookie = Cookie::forever('session_id', $sessionId);
            $response = $response->withCookie($cookie);
        }

        return $response;
    }

    public function show($uuid)
    {
        $userId = auth()->id();
        $sessionId = request()->cookie('session_id');

        $poll = Poll::where('uuid', $uuid)
            ->when($userId, function ($query) use ($userId) {
                return $query->where('user_id', $userId);
            }, function ($query) use ($sessionId) {
                return $query->where('session_id', $sessionId);
            })
            ->firstOrFail();

        return view('polls.show', compact('poll'));
    }

}
