(function ($) {
    'use strict';
    $('#modal-tela').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient = button.data('whatever')
        var title = button.data('title')
        var route = button.data('route')

        var modal = $(this)
        var button_success = button.data('button-success')

        $.ajax({
            type: "GET",
            url: route,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function (data) {

                modal.find('.modal-content').html('<div class="col-12">\n' +
                    '                                <div class="dot-opacity-loader">\n' +
                    '                                    <span></span>\n' +
                    '                                    <span></span>\n' +
                    '                                    <span></span>\n' +
                    '                                </div>\n' +
                    '                        </div>')
            },
            success: function (data) {
                modal.find('.modal-content').html(data)
                modal.find('.modal-title').text(title)
                modal.find('.modal-button-success').text(button_success)
                modal.find('.modal-body input').val(recipient)
            },
            error: function (data) {
                console.log(data)
            }
        });

    })



})(jQuery);
