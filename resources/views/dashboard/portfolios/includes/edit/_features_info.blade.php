{{-- Categories --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="categories_id">@lang('main.categories')<span class="required"></span> </label>
    <div class="col-sm-10">
        <select name="categories_id[]" id="categories_id" class="form-control select2 @error('categories_id') is-invalid @enderror" data-placeholder="@lang('main.categories')" multiple required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ in_array($category->id, $card->categories->pluck('id')->toArray()) ? 'selected' : '' }}>
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

{{-- companies --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="company_id">@lang('main.companies')<span class="required"></span> </label>
    <div class="col-sm-10">
        <select name="company_id" id="company_id" class="form-control select2 @error('company_id') is-invalid @enderror" data-placeholder="@lang('main.companies')"  required>
            @foreach ($companies as $company)
                <option value="{{ $company->id }}" {{  $company->id == $card->companies->pluck('id') ? 'selected' : '' }}>
                    {{ $company->name_by_lang }} 
                </option>
            @endforeach
        </select>

        @error('company_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>
 
 