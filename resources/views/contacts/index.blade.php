<!-- resources/views/contacts/index.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Contacts</h1>

        <!-- Search Form -->
        <form action="{{ url('/contacts') }}" method="GET" class="mb-4">
            <input type="text" name="search" placeholder="Search by name or email" value="{{ request()->query('search') }}" class="form-control mb-2">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Sort Links -->
        <div class="mb-4">
            <a href="{{ url('/contacts?sort=name') }}" class="btn btn-link">Sort by Name</a>
            <a href="{{ url('/contacts?sort=created_at') }}" class="btn btn-link">Sort by Date</a>
        </div>

        <!-- Contacts Table -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->address }}</td>
                        <td>
                            <a href="{{ url('/contacts/' . $contact->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ url('/contacts/' . $contact->id . '/edit') }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ url('/contacts/' . $contact->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        {{ $contacts->appends(request()->query())->links() }}
    </div>
@endsection
