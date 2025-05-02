@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h4>{{ __('Two-Factor Authentication') }}</h4>
                </div>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('2fa.verify') }}">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="code">{{ __('Enter the verification code sent to your email') }}</label>
                            <input type="text" name="code" id="code" class="form-control" required>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">{{ __('Verify Code') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection