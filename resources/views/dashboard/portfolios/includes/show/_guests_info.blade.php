{{-- Adults --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.adults'): </span>

        <span class="text-muted">{{ $card->adults }}</span>
    </div>
    <hr>
</div>

{{-- Children --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.children'): </span>

        <span class="text-muted">{{ $card->children }}</span>
    </div>
    <hr>
</div>

{{-- Infant --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.infant'): </span>

        <span class="text-muted">{{ $card->infant }}</span>
    </div>
    <hr>
</div>

{{-- Group Size --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.group_size'): </span>

        <span class="text-muted">{{ $card->group_size }}</span>
    </div>
    <hr>
</div>
