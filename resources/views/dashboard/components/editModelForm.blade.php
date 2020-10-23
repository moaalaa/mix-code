<div class="modal" tabindex="-1" role="dialog" id="editModel-{{$id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('main.edit') {{ $editTitle ?? '' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                
                {{ $slot }}
                
            </div>
            <div class="modal-footer">
                <form action="{{ $url }}" method="post">
                    @csrf
                    @method('PATCH')
                    
                    <button type="submit" class="btn btn-danger"> @lang('main.edit') </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> @lang('main.cancel') </button>
                </form>
            </div>
        </div>
    </div>
</div>
