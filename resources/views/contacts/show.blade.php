@extends('layout')

@section('content')
<div class="card">
    <div class="card-header">
        <h2>Contact Details</h2>
    </div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $contact->name }}</p>
        <p><strong>Email:</strong> {{ $contact->email }}</p>
        <p><strong>Phone:</strong> {{ $contact->phone }}</p>
        <p><strong>Address:</strong> {{ $contact->address }}</p>
        <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>
    </div>
</div>
@endsection
