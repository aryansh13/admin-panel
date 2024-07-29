@extends('layouts.app')

@section('title', 'Show User')

@section('contents')
    <hr />
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">ID</label>
            <input type="text" name="id" class="form-control" placeholder="Id" value="{{ $admins->id }}"
                readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Username" value="{{ $admins->username }}"
                readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Email</label>
            <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $admins->email }}"
                readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $admins->name }}"
                readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" name="password" placeholder="Password" value="{{ $admins->password }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Photo</label>
            @if ($admins->photo)
                <div>
                    <img src="{{ asset('storage/photos/' . $admins->photo) }}" alt="{{ $admins->name }}"
                        style="max-width: 50%; height: auto;">
                </div>
            @else
                <p>No photo available</p>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <label class="form-label">Created At</label>
            <input type="text" name="created_at" class="form-control" placeholder="Created At"
                value="{{ $admins->created_at }}" readonly>
        </div>
        <div class="col mb-3">
            <label class="form-label">Updated At</label>
            <input type="text" name="updated_at" class="form-control" placeholder="Updated At"
                value="{{ $admins->updated_at }}" readonly>
        </div>
    </div>
    <div class="row">
        <div class="col mb-3">
            <a href="{{ route('admin') }}" class="btn btn-primary">Back</a>
        </div>
    </div>
@endsection
