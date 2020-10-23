<div class="modal animated--grow-in" tabindex="-1" role="dialog" id="deleteModel-{{$id}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('main.delete') {{ $deleteTitle ?? '' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body border-left-danger">
                
                <h5 class="font-weight-bold"> @lang('main.ask-delete') </h5>
                <h6 class="h5">{{ $deleteTitle ?? '' }}</h6>

                
            </div>
            <div class="modal-footer">
                <form action="{{ $url }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger mr-1"> @lang('main.approval') </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> @lang('main.cancel') </button>
                </form>
            </div>
        </div>
    </div>
</div>