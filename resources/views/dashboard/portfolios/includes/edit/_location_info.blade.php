{{-- Country --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="country_id">@lang('main.country')<span class="required"></span> </label>
    <div class="col-sm-10">
        <select name="country_id" id="country_id" class="form-control select2 @error('country_id') is-invalid @enderror" data-placeholder="@lang('main.country')" required>
            <option value="" disabled selected>@lang('main.country_id')</option>
            @foreach ($countries as $country)
                <option value="{{ $country->id }}" {{ $trip->country_id == $country->id ? 'selected' : '' }}>
                    {{ $country->name_by_lang }} 
                </option>
            @endforeach
        </select>

        @error('country_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>

{{-- City --}}
<div id="cities_container">
    <div class="form-group mb-4 row">
        <label class="col-sm-2 col-form-label" for="city_id">@lang('main.city')<span class="required"></span> </label>
        <div class="col-sm-10">
            <select name="city_id" id="city_id" class="form-control select2 @error('city_id') is-invalid @enderror" data-placeholder="@lang('main.city')" required>
                <option value="" disabled selected>@lang('main.city_id')</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}" {{ $trip->city_id == $city->id ? 'selected' : '' }}>
                        {{ $city->name_by_lang }} 
                    </option>
                @endforeach
            </select>
    
            @error('city_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>
</div>