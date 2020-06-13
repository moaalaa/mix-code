<div class="modal" tabindex="-1" role="dialog" id="create">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('main.add')</h5>
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
                    
                    <button type="submit" class="btn btn-success"> @lang('main.add') </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> @lang('main.cancel') </button>            
                </form>
            </div>
        </div>
    </div>
</div>