@extends('layouts.app')

@section('content')
    <h1 class="mb-3">{{ $poll->title }}</h1>
    <form action="{{ route('votes.store') }}" method="post" class="mb-3">
        @csrf
        @foreach ($poll->options as $option)
            <div class="form-check">
                <input class="form-check-input" type="radio" name="option_id" id="option{{ $option->id }}" value="{{ $option->id }}">
                <label class="form-check-label" for="option{{ $option->id }}">
                    {{ $option->text }}
                </label>
            </div>
        @endforeach
        <button type="submit" class="btn btn-success mt-3">Vote</button>
    </form>
    <h2>Results</h2>
    <ul class="list-group">
        @foreach ($poll->options as $option)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $option->text }}
                <span class="badge badge-primary badge-pill">{{ $option->votes->count() }}</span>
            </li>
        @endforeach
    </ul>
@endsection
