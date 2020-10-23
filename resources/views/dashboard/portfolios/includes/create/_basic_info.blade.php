{{-- EN Name --}}
<div class="form-group my-4 row">
    <label class="col-sm-2 col-form-label" for="en_name">@lang('main.en_name')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="text" name="en_name" value="{{ old('en_name') }}" id="en_name" class="form-control @error('en_name') is-invalid @enderror" placeholder="@lang('main.en_name')" required>
        @error('en_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- AR Name --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="ar_name">@lang('main.ar_name')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="text" name="ar_name" value="{{ old('ar_name') }}" id="ar_name" class="form-control @error('ar_name') is-invalid @enderror" placeholder="@lang('main.ar_name')" required>
        @error('ar_name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- Price --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="price">@lang('main.price')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="number" min=".1" step=".01" name="price" value="{{ old('price') }}" id="price" class="form-control @error('price') is-invalid @enderror" placeholder="@lang('main.price')" required>
        @error('price')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>


{{-- discount --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="discount">@lang('main.discount')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="text" name="discount" value="{{ old('discount') }}" id="discount" class="form-control @error('discount') is-invalid @enderror" placeholder="@lang('main.discount')" required>
        @error('discount')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>




{{-- limitations --}}

<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="limitations">@lang('main.limitations')<span class="required"></span> </label>
    
 
    <div class="col-sm-10">
        <select name="limitations" id="limitations" class="form-control select2 @error('limitations') is-invalid @enderror" data-placeholder="@lang('main.limitations')"   required>
            
            <option disabled selected>@lang('main.limitations') </option>
                 <option value="unlimited" >@lang('main.unlimited') </option>
                 <option value="limited" > @lang('main.limited')</option>
        </select>

        @error('limitations')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>
</div>



{{-- frequency --}}
<div id="frequency_container"  class="d-none">    <!--class="d-none"--->
 
<div class='form-group mb-4 row'>
    <label class='col-sm-2 col-form-label' for='frequency'>@lang('main.frequency')<span class='required'></span> </label>
    <div class='col-sm-10 input-append'>
        <input type='text' name='frequency' value="{{ old('frequency') }}" id='frequency' class="form-control @error('frequency') is-invalid @enderror" placeholder="@lang('main.frequency')" >
        @error('frequency')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
</div>
<div id="hiddden-input"></div>



{{-- Date From --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="date_from">@lang('main.date_from')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="text" name="date_from" value="{{ old('date_from') }}" id="date_from" class="form-control @error('date_from') is-invalid @enderror" placeholder="@lang('main.date_from')" autocomplete="off" required>
        
        @error('date_from')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- Date To --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="date_to">@lang('main.date_to')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="text" name="date_to" value="{{ old('date_to') }}" id="date_to" class="form-control @error('date_to') is-invalid @enderror" placeholder="@lang('main.date_to')"  autocomplete="off" required>
        
        @error('date_to')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>