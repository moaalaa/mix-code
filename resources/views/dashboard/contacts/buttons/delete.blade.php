<a href="#" data-toggle="modal" data-target="#deleteModel-{{ $id }}" class="btn btn-danger btn-sm" title="@lang('main.delete')">
    <i class="fas fa-trash"></i>
</a>

@component('dashboard.components.deleteModelForm') 
    @slot('id',  $id ) 
    @slot('deleteTitle', trans('main.contact') . ' ' . $name) 
    @slot('url', route('dashboard.contacts.destroy', $id) ) 
@endcomponent
