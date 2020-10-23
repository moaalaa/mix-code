{{-- full_name --}}
 

{{-- Full Name --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.full_name'): </span>

        <span class="text-muted">{{ $user->full_name }}</span>
    </div>
    <hr>
</div>

{{-- Email --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.email'): </span>

        <span class="text-muted">{{ $user->email }}</span>

    </div>
    <hr>
</div>

{{-- Phone --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.phone'): </span>

        <span class="text-muted">{{ $user->phone }}</span>

    </div>
    <hr>
</div>

{{-- Type --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.type'): </span>

        @if ($user->isAdmin())
            <span class="badge badge-danger">@lang("main.admin")</span>
        
        @else
            <span class="badge badge-success">@lang("main.customer")</span>
        @endif
    </div>
    <hr>
</div>

{{-- Status --}}
<div class="col-md-6 col-sm-12">
    <div class="h6">
        <span class="font-weight-bold">@lang('main.status'): </span>

        @if ($user->isActive())
            <span class="badge badge-success">@lang("main.active")</span>
        @elseif($user->isPending())
            <span class="badge badge-warning">@lang("main.pending")</span>
        @else
            <span class="badge badge-danger">@lang("main.disable")</span>
        @endif
    </div>
    <hr>
</div>