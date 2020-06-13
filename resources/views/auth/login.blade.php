@extends('layouts.app')

 

@section('content')


<!-- Start Page -->


<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-50 p-r-50 p-t-20 p-b-30 text-center">
                <form class="form  login100-form validate-form" action="{{ route('login') }}" method="post">
                    @csrf
                <span class="login100-form-title p-b-20  ">
                    {{-- {{ getSettings()->mainMediaUrl('intro_image') }} --}}
                    <img  class="login-logo" src=" {{ asset('/assets/dist/images/logo/android-chrome-96x96.png')  }}" alt="{{ config('app.name') }}">
                </span>

                <div class="wrap-input100 validate-input m-b-16">
                    <h4>@lang('main.login') </h4> 
               </div>


                <div class="wrap-input100 validate-input m-b-16" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="email" name="email" @error('email') is-invalid @enderror" placeholder="@lang('main.email')" value="{{ old('email') }}" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <span class="lnr lnr-envelope"></span>
                    </span>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

                <div class="wrap-input100 validate-input m-b-16" data-validate = "Password is required">
                    <input class="input100" type="password" name="password" @error('password') is-invalid @enderror" id="password" placeholder="@lang('main.password')" required>
                    <span class="focus-input100"></span>
                    <span class="symbol-input100">
                        <span class="lnr lnr-lock"></span>
                    </span>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>

         
                
                <div class="container-login100-form-btn p-t-25">
                    <button type="submit" class="login100-form-btn">@lang('main.login')</button>
                </div>
 
            </form>
        </div>
    </div>
</div>
<!-- End Page -->
@endsection