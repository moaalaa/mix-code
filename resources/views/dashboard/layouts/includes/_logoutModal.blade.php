<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('main.ready_to_leave')</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">@lang('main.cancel')</button>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn btn-primary" type="submit">@lang('main.logout')</button>
                </form>
            </div>
        </div>
    </div>
</div>