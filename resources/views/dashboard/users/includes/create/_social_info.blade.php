{{-- Facebook --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="facebook">@lang('main.facebook') </label>
    <div class="col-sm-10">
        <input type="url" name="facebook" value="{{ old('facebook') }}" id="facebook" class="form-control @error('facebook') is-invalid @enderror" placeholder="@lang('main.facebook')">
        @error('facebook')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- Twitter --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="twitter">@lang('main.twitter') </label>
    <div class="col-sm-10">
        <input type="url" name="twitter" value="{{ old('twitter') }}" id="twitter" class="form-control @error('twitter') is-invalid @enderror" placeholder="@lang('main.twitter')">
        @error('twitter')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- Linkedin --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="linkedin">@lang('main.linkedin') </label>
    <div class="col-sm-10">
        <input type="url" name="linkedin" value="{{ old('linkedin') }}" id="linkedin" class="form-control @error('linkedin') is-invalid @enderror" placeholder="@lang('main.linkedin')">
        @error('linkedin')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- Instagram --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="instagram">@lang('main.instagram') </label>
    <div class="col-sm-10">
        <input type="url" name="instagram" value="{{ old('instagram') }}" id="instagram" class="form-control @error('instagram') is-invalid @enderror" placeholder="@lang('main.instagram')">
        @error('instagram')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- Snapchat --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="snapchat">@lang('main.snapchat') </label>
    <div class="col-sm-10">
        <input type="url" name="snapchat" value="{{ old('snapchat') }}" id="snapchat" class="form-control @error('snapchat') is-invalid @enderror" placeholder="@lang('main.snapchat')">
        @error('snapchat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- Youtube --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="youtube">@lang('main.youtube') </label>
    <div class="col-sm-10">
        <input type="url" name="youtube" value="{{ old('youtube') }}" id="youtube" class="form-control @error('youtube') is-invalid @enderror" placeholder="@lang('main.youtube')">
        @error('youtube')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>