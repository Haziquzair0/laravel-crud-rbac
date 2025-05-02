@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">
                    <h4>{{ __('Register') }}</h4>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Name Field -->
                        <div class="form-group mb-3">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <!-- Nickname Field -->
                        <div class="form-group mb-3">
                            <label for="nickname">{{ __('Nickname') }}</label>
                            <input type="text" name="nickname" id="nickname" class="form-control" value="{{ old('nickname') }}" required>
                        </div>

                        <!-- Avatar Field -->
                        <div class="form-group mb-3">
                            <label for="avatar">{{ __('Avatar') }}</label>
                            <input type="file" name="avatar" id="avatar" class="form-control">
                        </div>

                        <!-- Email Field -->
                        <div class="form-group mb-3">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                        </div>

                        <!-- Phone Number Field -->
                        <div class="form-group mb-3">
                            <label for="phone_no">{{ __('Phone Number') }}</label>
                            <input type="text" name="phone_no" id="phone_no" class="form-control" value="{{ old('phone_no') }}">
                        </div>

                        <!-- City Field -->
                        <div class="form-group mb-3">
                            <label for="city">{{ __('City') }}</label>
                            <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}">
                        </div>

                        <!-- Password Field -->
                        <div class="form-group mb-3">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <!-- Password Confirmation Field -->
                        <div class="form-group mb-3">
                            <label for="password_confirmation">{{ __('Password Confirmation') }}</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg">{{ __('Register') }}</button>
                            <a href="{{ route('login') }}" class="btn btn-link">{{ __('Already have an account? Login') }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection