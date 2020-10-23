var dashboardLanguage = document.head.querySelector('meta[name="language"]').content;


$(document).ready(function () {

    // Select2 Init
    if ($().select2) {
        $('.select2').select2({
            theme: 'bootstrap',
        });
    }

    
    // Bootstrap Switch Init
    if ($().bootstrapSwitch) {
        $('.switch').bootstrapSwitch();
    }

    // CKEditor
    if (typeof CKEDITOR != 'undefined') {
        CKEDITOR.replaceAll(function (textarea, config) {
            config.language = dashboardLanguage;
            config.toolbar = [
                { name: 'clipboard', items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', '-', 'RemoveFormat' ] },
                { name: 'paragraph', items: [ 'NumberedList', 'BulletedList', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', '-', 'Outdent', 'Indent'] },
                { name: 'styles', items: [ 'Styles', 'Format' ] },
                { name: 'tools', items: [ 'Maximize' ] },
            ];
            
            config.basicEntities = false;
            config.entities = false;
            config.entities_greek = false;
            config.entities_latin = false;
            config.htmlEncodeOutput = false;
            config.entities_processNumerical = false;       

            return true;
        });

        
        
        
        
        
        
    }
    
    
});


// Select All Rows For Multi Delete
function select_all() {
    $('input[class=selected_data]:checkbox').each(function () {
        if ($('input[class=select-all]:checkbox:checked').length == 0) {
            $(this).prop("checked", false);
        } else {
            $(this).prop("checked", true);
        }
    });
}

function notifyMessage(type, message) {
    Swal.fire({
        title: message,
        type: type,
        timer: 5000,
        toast: true,
        position: 'top-end',
        width: '32rem',
        // heightAuto: true, Not Compatible with Toast
        padding: '1.25rem',
        animation: true,
        showCloseButton: true,
        showConfirmButton: false,
        
    });
}