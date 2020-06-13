{{-- Adults --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="adults">@lang('main.adults')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="number" name="adults" value="{{ old('adults') }}" id="adults" class="form-control @error('adults') is-invalid @enderror" placeholder="@lang('main.adults')" required>
        @error('adults')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- Children --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="children">@lang('main.children')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="number" name="children" value="{{ old('children') }}" id="children" class="form-control @error('children') is-invalid @enderror" placeholder="@lang('main.children')" required>
        @error('children')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- Infant --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="infant">@lang('main.infant')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="number" name="infant" value="{{ old('infant') }}" id="infant" class="form-control @error('infant') is-invalid @enderror" placeholder="@lang('main.infant')" required>
        @error('infant')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- Group Size --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="group_size">@lang('main.group_size')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="number" name="group_size" value="{{ old('group_size') }}" id="group_size" class="form-control @error('group_size') is-invalid @enderror" placeholder="@lang('main.group_size')" required>
        @error('group_size')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>