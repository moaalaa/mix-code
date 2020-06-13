
<div class="col-md-12 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang("main.logo"): </span>

        <span class="text-muted">
            <img class="fixed-image-size img-thumbnail" src="{{ $user->mainMediaUrl('logo') }}">
        </span>

    </div>
    <hr>
</div>

{{-- @foreach ($media as $media_name => $media_link)
    @if (strpos($media_link, 'placehold.co') === false)
    <div class="col-md-6 col-sm-12">
        <div class="h6">
            <span class="font-weight-bold">@lang("main.{$media_name}"): </span>

            <span class="text-muted">
                <a href="{{ $media_link }}" class="btn btn-danger btn-sm" target="_blank">
                    <i class="fas fa-link"></i>
                    @lang('main.visit_url')
                </a>
            </span>

        </div>
        <hr>
    </div>
    
    @endif
@endforeach --}}
    
