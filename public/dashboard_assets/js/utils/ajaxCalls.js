function callAjaxOn (trigger, url, method, data, success, failed, event = 'change') {  
    $(trigger).on(event, function () {
        $.ajax({
            url,
            method,
            data: data(),
        })
        .done(success)
        .fail(failed);
    });    
};

function deleteMedia(trigger, url) {
    
    $(trigger).on('click', function () {
        var self = $(this);
        var parent = self.parents('.image-container');
        self.html('<i class="fas fa-spinner fa-spin"></i>')
        $.ajax({
            url,
            method: 'GET',
            data: {media_id: self.data('id')},
        })
        .done(function (response) {
            if (response.status) {
                parent.fadeOut();
                notifyMessage('success', response.message);
            } else {   
                self.html('<i class="fas fa-trash"></i>')
                notifyMessage('error', response.message);
            }
        })
        .fail(function (response) {
            self.html('<i class="fas fa-trash"></i>')
            notifyMessage('error', response.statusText);
        });
    });    
    
}