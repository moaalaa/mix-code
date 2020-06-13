{{-- English Overview --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="en_overview">@lang('main.en_overview')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea type="text" name="en_overview" id="en_overview" class="form-control @error('en_overview') is-invalid @enderror" placeholder="@lang('main.en_overview')" required>
            {{ $card->en_overview }}
        </textarea>
        @error('en_overview')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- Arabic Overview --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="ar_overview">@lang('main.ar_overview')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea type="text" name="ar_overview" id="ar_overview" class="form-control @error('ar_overview') is-invalid @enderror" placeholder="@lang('main.ar_overview')" required>
            {{ $card->ar_overview }}
        </textarea>
        @error('ar_overview')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- English Highlights --}}
{{-- <div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="en_highlights">@lang('main.en_highlights')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea type="text" name="en_highlights" id="en_highlights" class="form-control @error('en_highlights') is-invalid @enderror" placeholder="@lang('main.en_highlights')" required>
            {{ $card->en_highlights }}
        </textarea>
        @error('en_highlights')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div> --}}

{{-- Arabic Highlights --}}
{{-- <div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="ar_highlights">@lang('main.ar_highlights')<span class="required"></span> </label>
    <div class="col-sm-10">
        <textarea type="text" name="ar_highlights" id="ar_highlights" class="form-control @error('ar_highlights') is-invalid @enderror" placeholder="@lang('main.ar_highlights')" required>
            {{ $card->ar_highlights }}
        </textarea>
        @error('ar_highlights')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
</div> --}}
