{{-- Terms And Conditions --}}
<div class="form-group{{ $errors->has('terms_and_conditions') ? ' has-error' : '' }}">
    <label class="col-md-2 control-label">{{ trans('frontend.terms_and_conditions') }} <span class="required"></span> </label>
    <div class="col-md-10">
        <textarea name="terms_and_conditions" class="form-control" placeholder="{{ trans('frontend.terms_and_conditions') }}" required>
            {{ $settings->terms_and_conditions }}
        </textarea>
        
        @if ($errors->has('terms_and_conditions'))
            <span class="help-block">
                <strong class="help-block">{{ $errors->first('terms_and_conditions') }}</strong>
            </span> 
        @endif
    </div>
</div>
