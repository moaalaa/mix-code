{{-- EN Name --}}
<div class="form-group my-4 row">
    <label class="col-sm-2 col-form-label" for="en_type">@lang('main.en_type')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="text" name="en_type" value="{{ old('en_type') }}" id="en_type" class="form-control @error('en_type') is-invalid @enderror" placeholder="@lang('main.en_type')" required>
        @error('en_type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- AR Name --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="ar_type">@lang('main.ar_type')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="text" name="ar_type" value="{{ old('ar_type') }}" id="ar_type" class="form-control @error('ar_type') is-invalid @enderror" placeholder="@lang('main.ar_type')" required>
        @error('ar_type')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>




{{-- Categories --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="categories_id">@lang('main.categories')<span class="required"></span> </label>
    <div class="col-sm-10">
        <select name="categories_id[]" id="categories_id" class="form-control select2 @error('categories_id') is-invalid @enderror" data-placeholder="@lang('main.categories')" multiple required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ in_array($category->id, old('categories_id') ?? []) ? 'selected' : '' }}>
                    {{ $category->name_by_lang }} 
                </option>
            @endforeach
        </select>

        @error('categories_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>




 
 