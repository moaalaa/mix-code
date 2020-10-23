<script>
    @if(session()->has('success'))
        swal({
            title              : "{{trans('main.success')}}",
            text               : "{{session()->get('success') }}",
            icon               : "success",
            type               : "success",
            customClass        : "sweet-alert showSweetAlert",
            closeOnCancel      : true,
            confirmButtonText  : "{{trans('main.close')}}",
            cancelButtonText   : "{{trans('main.close')}}",
            timer              : "3000"
        });
    @endif
    @if(session()->has('info'))
        swal({
            title              : "{{trans('main.info')}}",
            text               : "{{session()->get('info') }}",
            type               : "info",
            customClass        : "sweet-alert showSweetAlert",
            confirmButtonClass : "btn-info",
            cancelButtonClass  : "btn-info",
            closeOnCancel      : true,
            icon               : "info",
            confirmButtonText  : "{{trans('main.close')}}",
            cancelButtonText   : "{{trans('main.close')}}",
            timer              : "3000"
        });
    @endif
    @if(session()->has('warning'))
        swal({
            title              : "{{trans('main.warning')}}",
            text               : "{{session()->get('warning') }}",
            type               : "warning",
            customClass        : "sweet-alert showSweetAlert",
            confirmButtonClass : "btn-warning",
            cancelButtonClass  : "btn-warning",
            closeOnCancel      : true,
            icon               : "warning",
            confirmButtonText  : "{{trans('main.close')}}",
            cancelButtonText   : "{{trans('main.close')}}",
            timer              : "3000"
        });
    @endif
    @if(session()->has('error'))
        swal({
            title              : "{{trans('main.error')}}",
            text               : "{{session()->get('error') }}",
            type               : "error",
            customClass        : "sweet-alert showSweetAlert",
            confirmButtonClass : "btn-danger",
            cancelButtonClass  : "btn-danger",
            closeOnCancel      : true,
            icon               : "error",
            confirmButtonText  : "{{trans('main.close')}}",
            cancelButtonText   : "{{trans('main.close')}}",
            timer              : "3000"
        });
    @endif
</script>
