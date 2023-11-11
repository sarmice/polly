@extends('layouts.app')

@section('content')
    <h1 class="mb-3">Create a New Poll</h1>
    <form method="POST" action="{{ route('polls.store') }}" class="mb-3">
        @csrf
        <div class="form-group">
            <label for="title">Poll Title</label>
            <input type="text" class="form-control" id="title" name="title" placeholder="Enter Poll Title" required>
        </div>
        <div class="form-group">
            <label for="option1">Option 1</label>
            <input type="text" class="form-control" id="option1" name="options[]" placeholder="Enter Option 1" required>
        </div>
        <div class="form-group">
            <label for="option2">Option 2</label>
            <input type="text" class="form-control" id="option2" name="options[]" placeholder="Enter Option 2" required>
        </div>
        <!-- Add more options as needed -->
        <button type="submit" class="btn btn-primary">Create Poll</button>
    </form>
@endsection
