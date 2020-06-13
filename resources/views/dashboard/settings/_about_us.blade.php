{{-- En About Us --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="en_about_us">@lang('main.en_about_us')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea name="en_about_us" id="en_about_us" class="form-control @error('en_about_us') is-invalid @enderror"
            placeholder="@lang('main.en_about_us')" required>
            {{ $settings->en_about_us }}
        </textarea>
        @error('en_about_us')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

{{-- Ar About Us --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="ar_about_us">@lang('main.ar_about_us')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea name="ar_about_us" id="ar_about_us" class="form-control @error('ar_about_us') is-invalid @enderror"
            placeholder="@lang('main.ar_about_us')" required>
            {{ $settings->ar_about_us }}
        </textarea>
        @error('ar_about_us')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

{{-- En Vision --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="en_vision">@lang('site.en_vision')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea name="en_vision" id="en_vision" class="form-control @error('en_vision') is-invalid @enderror"
            placeholder="@lang('site.en_vision')" required>
            {{ $settings->en_vision }}
        </textarea>
        @error('en_vision')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

{{-- Ar Vision --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="ar_vision">@lang('site.ar_vision')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea name="ar_vision" id="ar_vision" class="form-control @error('ar_vision') is-invalid @enderror"
            placeholder="@lang('site.ar_vision')" required>
            {{ $settings->ar_vision }}
        </textarea>
        @error('ar_vision')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

{{-- En Mission --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="en_mission">@lang('site.en_mission')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea name="en_mission" id="en_mission" class="form-control @error('en_mission') is-invalid @enderror"
            placeholder="@lang('site.en_mission')" required>
            {{ $settings->en_mission }}
        </textarea>
        @error('en_mission')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

{{-- Ar Mission --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="ar_mission">@lang('site.ar_mission')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea name="ar_mission" id="ar_mission" class="form-control @error('ar_mission') is-invalid @enderror"
            placeholder="@lang('site.ar_mission')" required>
            {{ $settings->ar_mission }}
        </textarea>
        @error('ar_mission')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

{{-- En Values --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="en_values">@lang('site.en_values')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea name="en_values" id="en_values" class="form-control @error('en_values') is-invalid @enderror"
            placeholder="@lang('site.en_values')" required>
            {{ $settings->en_values }}
        </textarea>
        @error('en_values')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

{{-- Ar Values --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="ar_values">@lang('site.ar_values')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea name="ar_values" id="ar_values" class="form-control @error('ar_values') is-invalid @enderror"
            placeholder="@lang('site.ar_values')" required>
            {{ $settings->ar_values }}
        </textarea>
        @error('ar_values')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

{{-- En Terms And Conditions --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="en_terms_and_conditions">@lang('site.en_terms_and_conditions')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea name="en_terms_and_conditions" id="en_terms_and_conditions" class="form-control @error('en_terms_and_conditions') is-invalid @enderror"
            placeholder="@lang('site.en_terms_and_conditions')" required>
            {{ $settings->en_terms_and_conditions }}
        </textarea>
        @error('en_terms_and_conditions')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

{{-- En Terms And Conditions --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="ar_terms_and_conditions">@lang('site.ar_terms_and_conditions')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea name="ar_terms_and_conditions" id="ar_terms_and_conditions" class="form-control @error('ar_terms_and_conditions') is-invalid @enderror"
            placeholder="@lang('site.ar_terms_and_conditions')" required>
            {{ $settings->ar_terms_and_conditions }}
        </textarea>
        @error('ar_terms_and_conditions')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>