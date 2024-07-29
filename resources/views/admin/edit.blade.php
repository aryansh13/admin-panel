@extends('layouts.app')

@section('title', 'Edit User')

@section('contents')
    <hr />
    <form action="{{ route('admin.update', $admins->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Username"
                    value="{{ $admins->username }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $admins->email }}">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $admins->name }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Password</label>
                <input type="text" class="form-control" name="password" placeholder="Password"
                    value="{{ $admins->password }}">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Photo</label>
                <div>
                    @if ($admins->photo)
                        <img id="photo-preview" src="{{ asset('storage/photos/' . $admins->photo) }}"
                            alt="{{ $admins->name }}" style="max-width: 50%; height: auto;">
                    @else
                        <p id="photo-preview">No photo available</p>
                    @endif
                </div>
                <input type="file" name="photo" class="form-control mt-2" onchange="previewNewPhoto(event)">
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-warning">Update</button>
            </div>
            <div class="col mb-3">
                <a href="{{ route('admin') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </form>
    <script>
        function previewNewPhoto(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('photo-preview');
                if (output.tagName === 'IMG') {
                    output.src = reader.result;
                } else {
                    var img = document.createElement('img');
                    img.id = 'photo-preview';
                    img.src = reader.result;
                    img.style.maxWidth = '50%';
                    img.style.height = 'auto';
                    output.replaceWith(img);
                }
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
