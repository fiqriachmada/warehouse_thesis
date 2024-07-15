$(document).on('click', '#admin-form-btn', function () {
    $('#add-admin-form').submit();
});

$('#add-admin-form').submit(function(event) { 
    event.preventDefault();

    const formData = new FormData(this);

    $.ajax({
        type: 'POST',
        url: '/master/admin',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            $("#modal-add-admin").modal('hide');

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Admin Created Successfully',
                showConfirmButton: false,
                timer: 1500
            });

            setTimeout(function() {
                window.location.reload();
            }, 2000);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            if (jqXHR.status == 422) {
                var errors = jqXHR.responseJSON.errors;
        
                $('.error-messages').empty();
        
                for (var field in errors) {
                    var errorMessages = errors[field];
                    var fieldName = field.split('.').pop();


                    $('[id^="'+fieldName+'"]').append(errorMessages);
                }
            } else {
                $('#error-message').html('Terjadi kesalahan saat mengirim formulir.');
            }
        }
    });
});

$(document).on('click', '#modal-edit-button', function() {
    const slug = $(this).attr('data-id');

    $.ajax({
        type: 'POST',
        url: '/ajax/admin-edit-modal/'+slug,
        contentType: false,
        processData: false,
        success: function(response) {
            
        }
    });
});