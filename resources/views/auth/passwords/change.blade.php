@extends('layouts.login')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Change Password') }}</div>

        <div class="card-body">
          <form class="" action="{{ route('password.change') }}" method="post">
            @csrf

            <div class="form-group row">
              <label for="current_password" class="col-md-4 col-form-label text-md-right">{{ __('Current Password') }}</label>

              <div class="col-md-6">
                <input id="current_password" class="form-control @error('current_password') is-invalid @enderror" type="text" name="current_password" value="" required autocomplete="new-new-password">

                @error('current_password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New Password') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" value="">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Comfirm New Password')}}</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password" class="from-control" name="password_confirmation" required autocomplete="new-password" value="">
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Change Password') }}
                </button>
              </div>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
