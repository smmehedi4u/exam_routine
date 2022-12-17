@extends('layouts.app')

@section('title', 'Password Change')


@section('main')
<div class="card card-primary">
    <div class="card-header">
        <h4>Change Password</h4>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card-body">

        @if(session()->has('success'))
        <strong class="text-success">{{ session()->get('success') }}</strong>
        @endif

        @if(session()->has('error'))
        <strong class="text-danger">{{ session()->get('error') }}</strong>
        @endif

        <form method="POST" action="{{route('update.password')}}">
           @csrf

            <div class="form-group">
                <label for="email">Current Password</label>
                <input type="password" value="{{ old('current_password') }}" class="form-control"
                    name="current_password" tabindex="1" required autofocus="">


                @error('current_password')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">New Password</label>
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2"
                    @error('password') is-invalid @enderror required>


                @error('password')
                    <div class="text-danger">{{$message}}</div>
                @enderror
            </div>

            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control"
                    name="password_confirmation" tabindex="1" required autofocus="">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

