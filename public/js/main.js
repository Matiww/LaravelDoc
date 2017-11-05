$(document).ready(function () {
    var notes_container = $('.notes-container');
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-center",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "2000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    var grid = $('.grid');
    if (grid.length > 0) {
        var $grid = grid.masonry({
            itemSelector: '.grid-item',
            gutter: '.gutter-sizer',
            columnWidth: '.grid-sizer',
            //percentPosition: true,
            horizontalOrder: true,
            fitWidth: true
        })
    }
    $('.logout').on("click", function (e) {
        e.preventDefault();
        $('#logout-form').submit();
    });

    notes_container.on("click", ".delete-note", function (e) {
        e.preventDefault();
        var element = $(this);
        if (confirm('Czy na pewno chcesz usunąć ' + element.closest('.box').find('.box-title').text() + '?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/noteww/public/notes/' + id,
                type: 'DELETE',
                success: function (result) {
                    $grid.masonry('remove', element.closest('.grid-item'))
                    // layout remaining item elements
                        .masonry('layout');
                    $('.notesCount').text(result.notesCount);
                    if($('.grid-item').length - 1 == 0) {
                        notes_container.html(
                            '<div class="error-page">' +
                            '<div class="error-content">' +
                            '<h3><i class="ion-document text-blue"></i> Brak notatek do wyświetlenia.</h3>' +
                            '<p>Możesz je dodać <a href="'+$('.add-note').attr('href')+'">tutaj</a>.</p></div></div>'
                        );
                    }
                    toastr["success"]("Sukces!");
                }
            });
        }
        $('.tooltip').remove();
    });

    notes_container.on("click", ".disable-note", function (e) {
        e.preventDefault();
        var element = $(this);
        if (confirm('Czy na pewno chcesz zablokować ' + element.closest('tr').find('td').first().text() + '?')) {
            window.location = element.attr('href');
        }
        $('.tooltip').remove();
    });
});

function clearInputs() {
    $('input, textarea').val('');
    $('input[type="checkbox"]').prop('checked', false);
}