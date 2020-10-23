<div class="modal animated--grow-in" tabindex="-1" role="dialog" id="restoreModel-{{ $id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('main.restore') {{ $restoreTitle ?? '' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body border-left-success">
                
                <h5 class="font-weight-bold"> @lang('main.ask-restore') </h5>
                <h6 class="h5">{{ $restoreTitle ?? '' }}</h6>

                
            </div>
            <div class="modal-footer">
                <form action="{{ $url }}" method="post">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn btn-success"> @lang('main.restore') </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> @lang('main.cancel') </button>
                </form>
            </div>
        </div>
    </div>
</div>