{{-- Country --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.country'): </span>

        @if (!! $card->country)
            <a href="{{ $card->country->path() }}" target="_blank">{{ $card->country->name_by_lang }}</a>
        @else 
            <span class="text-muted">@lang('main.not_found')</span>
        @endif
    </div>
    <hr>
</div>

{{-- City --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.city'): </span>

        @if (!! $card->city)
            <a href="{{ $card->city->path() }}" target="_blank">{{ $card->city->name_by_lang }}</a>
        @else 
            <span class="text-muted">@lang('main.not_found')</span>
        @endif
    </div>
    <hr>
</div>