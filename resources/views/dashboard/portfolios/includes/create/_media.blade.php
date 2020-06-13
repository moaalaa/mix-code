{{-- Images --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="images">@lang('main.images')<span class="required"></span> </label>
    <div class="col-sm-10">
        <input type="file" name="images" id="images" accept=".png,.jpg,.jpeg"  required>

        @error('images')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
