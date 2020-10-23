<a href="#" data-toggle="modal" data-target="#restoreModel-{{ $id }}" class="btn btn-success btn-sm" title="@lang('main.restore')">
    <i class="fas fa-undo"></i>
</a>

@component('dashboard.components.restoreModelForm') 
    @slot('id',  $id ) 
    @slot('restoreTitle', trans('main.restore') . ' ' . $name_by_lang) 
    @slot('url', route('dashboard.services.restore', $id) ) 
@endcomponent
