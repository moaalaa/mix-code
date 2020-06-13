{{-- En Name --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.en_name'): </span>

        <span class="text-muted">{{ $card->en_name }}</span>
    </div>
    <hr>
</div>

{{-- Ar Name --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.ar_name'): </span>

        <span class="text-muted">{{ $card->ar_name }}</span>
    </div>
    <hr>
</div>

{{-- Price --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.price'): </span>

        <span class="text-muted">{{ $card->price }}</span>
    </div>
    <hr>
</div>

{{-- Duration --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.discount'): </span>

        <span class="text-muted">{{ $card->discount }}</span>
    </div>
    <hr>
</div>

{{-- Duration --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.limitations'): </span>

        <span class="text-muted"> @lang('main.'.$card->limitations)</span>
    </div>
    <hr>
</div>

{{-- frequency --}}
@if ($card->limitations == 'limited')
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.frequency'): </span>

        <span class="text-muted">{{ $card->frequency }}</span>
    </div>
    <hr>
</div>
@endif


{{-- Date From --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.date_from'): </span>

        <span class="text-muted">{{ $card->date_from }}</span>
    </div>
    <hr>
</div>

{{-- Date To --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.date_to'): </span>

        <span class="text-muted">{{ $card->date_to }}</span>
    </div>
    <hr>
</div>
