@extends('layouts.app')

@section('content')

<div class="page-header">
	<div class="container">
		<div class="row">
			<div class="col">
				<nav aria-label="breadcrumb">
				  <ol class="breadcrumb">
				    <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('site.home')</a></li>
				    <li class="breadcrumb-item active" aria-current="page">@lang('main.register')</li>
				  </ol>
				</nav>
			</div>
		</div>
	</div>
</div>
<div class="page register-page">
	<div class="container">
		<div class="row">
			<div class="content">
				<div class="heading">
					<h3>
						<span>@lang('main.register')</span>
					</h3>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="register-form">
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        
						<div class="row">
							<div class="col-sm-12">
                                <div class="form-group">
                                    <label class="input-group-addon">@lang('main.name')</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('main.name')" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="input-group-addon">@lang('main.email')</label>
                                    <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('main.email')" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="input-group-addon">@lang('main.phone')</label>
                                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="@lang('main.phone')" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="input-group-addon">@lang('main.address')</label>
                                    <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="@lang('main.address')" value="{{ old('address') }}" required>
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
							<div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-group-addon">@lang('main.password')</label>
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="@lang('main.password')" required>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="input-group-addon">@lang('main.password_confirmation')</label>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="@lang('main.password_confirmation')" required>
                                </div>
                            </div>

							<div class="col-sm-12 text-center">
								<button class="btn btn-default btn-submit" type="submit">@lang('main.register')</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
