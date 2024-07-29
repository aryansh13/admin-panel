@extends('layouts.app')

@section('title', 'Add User')

@section('contents')
    <hr />
    <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
            <div class="col">
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="col">
                <input type="text" class="form-control" name="password" placeholder="Password">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="file" name="photo" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
