@extends('layout')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Contacts</h1>
    <form class="d-flex" action="{{ route('contacts.index') }}" method="GET">
        <input class="form-control me-2" type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
</div>

@if($contacts->isEmpty())
    <div class="alert alert-warning" role="alert">
        No results found.
    </div>
@else
    <div class="alert alert-info" role="alert">
        {{ $contacts->count() }} {{ $contacts->count() > 1 ? 'results' : 'result' }} found.
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>
                    <a href="{{ route('contacts.index', [
                        'sort' => 'name', 
                        'direction' => (request('sort') === 'name' && request('direction') === 'asc') ? 'desc' : 'asc', 
                        'search' => request('search')
                    ]) }}">
                        Name
                        @if(request('sort') === 'name')
                            @if(request('direction') === 'asc')
                                <span class="badge bg-secondary">&#8593;</span>
                            @else
                                <span class="badge bg-secondary">&darr;</span>
                            @endif
                        @else
                            <span class="badge bg-secondary">&#8593;</span>
                        @endif
                    </a>
                </th>
                <th>Email</th>
                <th>Phone</th>
                <th>
                    <a href="{{ route('contacts.index', [
                        'sort' => 'created_at', 
                        'direction' => (request('sort') === 'created_at' && request('direction') === 'asc') ? 'desc' : 'asc', 
                        'search' => request('search')
                    ]) }}">
                        Created At
                        @if(request('sort') === 'created_at')
                            @if(request('direction') === 'asc')
                                <span class="badge bg-secondary up">&#8593;</span>
                            @else
                                <span class="badge bg-secondary down">&darr;</span>
                            @endif
                        @else
                            <span class="badge bg-secondary up">&#8593;</span>
                        @endif
                    </a>
                </th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->email }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->created_at->format('Y-m-d') }}</td>
                <td>
                    <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $contacts->appends(['search' => request('search'), 'sort' => request('sort'), 'direction' => request('direction')])->links() }}
@endif
@endsection
