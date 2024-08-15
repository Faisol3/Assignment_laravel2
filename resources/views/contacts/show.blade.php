<!-- resources/views/contacts/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Contact Details</h1>

        <div class="card">
            <div class="card-header">
                {{ $contact->name }}
            </div>
            <div class="card-body">
                <p><strong>Email:</strong> {{ $contact->email }}</p>
                <p><strong>Phone:</strong> {{ $contact->phone }}</p>
                <p><strong>Address:</strong> {{ $contact->address }}</p>
                <p><strong>Created At:</strong> {{ $contact->created_at->format('Y-m-d H:i:s') }}</p>
                <p><strong>Updated At:</strong> {{ $contact->updated_at->format('Y-m-d H:i:s') }}</p>
            </div>
        </div>

        <a href="{{ url('/contacts') }}" class="btn btn-secondary mt-3">Back to Contacts</a>
    </div>
@endsection
