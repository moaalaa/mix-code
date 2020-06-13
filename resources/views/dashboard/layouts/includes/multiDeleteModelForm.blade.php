<div class="modal animated--grow-in" tabindex="-1" role="dialog" id="multi_delete">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('main.delete')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body border-left-danger">
                <div class="delete_done"> 
                   
                    @lang('main.ask-delete') 
                   
                    <span id="count"></span> 
                   
                    @lang('main.record') !

                </div>
                <div class="check_delete">@lang('main.check-delete')</div>
            </div>
            <div class="modal-footer">

                <button type="submit" class="btn btn-danger"> @lang('main.approval') </button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal"> @lang('main.cancel') </button>

            </div>
        </div>
    </div>
</div>
