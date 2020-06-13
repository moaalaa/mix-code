{{-- full_name --}}
<div class="form-group my-4 row">
    <label class="col-sm-2 col-form-label" for="full_name">@lang('main.full_name')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="text" name="full_name" value="{{ $user->full_name }}" id="full_name" class="form-control @error('full_name') is-invalid @enderror" placeholder="@lang('main.full_name')" required>
        @error('full_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- Full Name --}}
{{-- <div class="form-group my-4 row">
    <label class="col-sm-2 col-form-label" for="full_name">@lang('main.full_name')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="text" name="full_name" value="{{ $user->full_name }}" id="full_name" class="form-control @error('full_name') is-invalid @enderror" placeholder="@lang('main.full_name')" required>
        @error('full_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div> --}}

{{-- Email --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="email">@lang('main.email')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="email" name="email" value="{{ $user->email }}" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="@lang('main.email')" required>
        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- Phone --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="phone">@lang('main.phone')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="text" name="phone" value="{{ $user->phone }}" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="@lang('main.phone')" required>
        @error('phone')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{--  
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="type">@lang('main.type')<span class="required"></span> </label>
    <div class="col-sm-10">
        <select name="type" id="type" class="form-control select2 @error('type') is-invalid @enderror" data-placeholder="@lang('main.type')" required>
            <option value="" disabled selected>@lang('main.type')</option>
            @foreach ($userTypes as $type)
                <option value="{{ $type }}" {{ $user->type == $type ? 'selected' : '' }}> @lang("main.{$type}") </option>
            @endforeach
        </select>
        @error('type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

 
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="status">@lang('main.status')<span class="required"></span> </label>
    <div class="col-sm-10">
        <select name="status" id="status" class="form-control select2 @error('status') is-invalid @enderror" data-placeholder="@lang('main.status')" required>
            <option value="" disabled selected>@lang('main.status')</option>
            @foreach ($userStatus as $status)
                <option value="{{ $status }}" {{ $user->status == $status ? 'selected' : '' }}> @lang("main.{$status}") </option>
            @endforeach
        </select>
        @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div> --}}
