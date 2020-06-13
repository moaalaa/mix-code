@if (!! $user->facebook && strpos($user->facebook, 'placehold.co') === false)
{{-- Facebook --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang("main.facebook"): </span>

        <span class="text-muted">
            <a href="{{ $user->facebook }}" class="btn btn-primary btn-sm" target="_blank">
                <i class="fas fa-link"></i>
                @lang('main.visit_url')
            </a>
        </span>

    </div>
    <hr>
</div>
@endif

@if (!! $user->twitter && strpos($user->twitter, 'placehold.co') === false)
{{-- Twitter --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang("main.twitter"): </span>

        <span class="text-muted">
            <a href="{{ $user->twitter }}" class="btn btn-primary btn-sm" target="_blank">
                <i class="fas fa-link"></i>
                @lang('main.visit_url')
            </a>
        </span>

    </div>
    <hr>
</div>
@endif

@if (!! $user->linkedin && strpos($user->linkedin, 'placehold.co') === false)
{{-- Linkedin --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang("main.linkedin"): </span>

        <span class="text-muted">
            <a href="{{ $user->linkedin }}" class="btn btn-primary btn-sm" target="_blank">
                <i class="fas fa-link"></i>
                @lang('main.visit_url')
            </a>
        </span>

    </div>
    <hr>
</div>
@endif

@if (!! $user->instagram && strpos($user->instagram, 'placehold.co') === false)
{{-- Instagram --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang("main.instagram"): </span>

        <span class="text-muted">
            <a href="{{ $user->instagram }}" class="btn btn-primary btn-sm" target="_blank">
                <i class="fas fa-link"></i>
                @lang('main.visit_url')
            </a>
        </span>

    </div>
    <hr>
</div>
@endif

@if (!! $user->snapchat && strpos($user->snapchat, 'placehold.co') === false)
{{-- Snapchat --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang("main.snapchat"): </span>

        <span class="text-muted">
            <a href="{{ $user->snapchat }}" class="btn btn-primary btn-sm" target="_blank">
                <i class="fas fa-link"></i>
                @lang('main.visit_url')
            </a>
        </span>

    </div>
    <hr>
</div>
@endif

@if (!! $user->youtube && strpos($user->youtube, 'placehold.co') === false)
{{-- YouTube --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang("main.youtube"): </span>

        <span class="text-muted">
            <a href="{{ $user->youtube }}" class="btn btn-primary btn-sm" target="_blank">
                <i class="fas fa-link"></i>
                @lang('main.visit_url')
            </a>
        </span>

    </div>
    <hr>
</div>
@endif