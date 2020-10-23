<a href="#" data-toggle="modal" data-target="#restoreModel-{{ $id }}" class="btn btn-success btn-sm" title="@lang('main.restore')">
    <i class="fas fa-undo"></i>
</a>

@component('dashboard.components.restoreModelForm') 
    @slot('id',  $id ) 
    @slot('restoreTitle', trans('main.restore') . ' ' . $url) 
    @slot('url', route('dashboard.portfolios.restore', $id) ) 
@endcomponent
