@extends('layouts.app')

@section('content')
    <h1 class="mb-3">My Polls</h1>
    @forelse ($polls as $poll)
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">
                    <a href="{{ route('polls.show', $poll->uuid) }}">
                        {{ $poll->title }}
                    </a>
                </h5>
                <p class="card-text">
                    Created on {{ $poll->created_at->toFormattedDateString() }}
                </p>
            </div>
        </div>
    @empty
        <p>You haven't created any polls yet.</p>
    @endforelse
@endsection
