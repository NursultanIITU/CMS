@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">My Profile</div>

        <div class="card-body">
            @include('partials.error')
            <form action="{{route('users.update-profile')}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                </div>
                <div class="form-group">
                    <label for="about">About Me</label>
                    <input id="about" type="hidden" name="about" value="{{$user->about}}">
                    <trix-editor input="about"></trix-editor>
                </div>
                <button class="btn btn-success btn-sm" type="submit">Update Profile</button>
            </form>
        </div>
    </div>
@endsection
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css" />
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
@endsection