{{-- Intro Image --}}
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="intro_image">@lang('main.intro_image')</label>
    <div class="col-sm-10">


        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                <img src="{{ getSettings()->mainMediaUrl('intro_image') }}" alt="" />
            </div>
            <div>
                <span class="btn blue btn-outline btn-file">
                    <span class="fileinput-new btn btn-success"> @lang('main.select_main_logo') </span>
                    <span class="fileinput-exists btn btn-info"> @lang('main.change') </span>
                    <input type="file" name="intro_image" id="intro_image">
                </span>
                <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> @lang('main.remove') </a>
            </div>
        </div>
        
        

        @error('intro_image')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- About Us Image --}}
{{-- No Need For it --}}
{{-- <div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="about_us_image">@lang('main.about_us_image')</label>
    <div class="col-sm-10">


        <div class="fileinput fileinput-new" data-provides="fileinput">
            <div class="fileinput-preview thumbnail" data-trigger="fileinput">
                <img src="{{ getSettings()->mainMediaUrl('about_us_image') }}" alt="" />
            </div>
            <div>
                <span class="btn blue btn-outline btn-file">
                    <span class="fileinput-new btn btn-success"> @lang('main.select_image') </span>
                    <span class="fileinput-exists btn btn-info"> @lang('main.change') </span>
                    <input type="file" name="about_us_image" id="about_us_image">
                </span>
                <a href="javascript:;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"> @lang('main.remove') </a>
            </div>
        </div>

        @error('about_us_image')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div> --}}

{{-- Slider --}}
<hr>
<div class="form-group mb-4 row">
    <label class="col-sm-2 col-form-label" for="slider">@lang('main.slider_images')</label>
    <div class="col-sm-10">
        <input type="file" name="slider_images[]"  class="fileinput-new btn btn-deafult"  id="image" multiple>

        @error('slider')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>

{{-- NOTE: Change This Design to mansory layout, Already Found In Portfolio --}}

<section>
    <div class="row">
        @php
            $media = getSettings()->getMedia('setting_image_slider_image');
        @endphp

        @foreach ($media as $image)
            <div class="col-md-3 col-sm-12 mb-3 image-container">
                <div class="card">
                    
                    <img class="card-img settings-image" src="{{ $image->getUrl() }}">
                    
                    <button type="button" class="btn btn-danger btn-sm delete-settings-image" data-id="{{ $image->id }}">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>

            </div>
            
        @endforeach

    </div>
</section>