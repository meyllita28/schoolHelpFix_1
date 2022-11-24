$(document).ready(function (){
    $('.btn-modal').click(function (e) {
        e.preventDefault();

        $.ajax({
            url: $(this).data('route'),
            type: 'GET',
            data: {},
            success: function (data) {
                $('#modal-container').html(data);
                $('#modal').modal('show');

            }
        });
    });
})
