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
        "timeOut": "3000",
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

    $('.save-note').on("click", function (e) {
        e.preventDefault();
        var errors = $('.errors-list');
        var element = $(this);
        var data = {
            "title": $('#title').val(),
            "content": $('#content').val(),
            "date": $('#date').val(),
            "important_note": $('.important-note:checked').length,
            "scale_level": $('#scale').val(),
            "ajax": true
        };
        $.ajax({
            url: '/notes',
            type: 'POST',
            data: data,
            success: function (result) {
                errors.parent().hide();
                clearInputs();
                // create new item elements
                var $items = generateNote(result);
                // prepend items to grid
                $grid.prepend($items)
                // add and lay out newly prepended items
                    .masonry('prepended', $items);
                $('[data-toggle="tooltip"]').tooltip();

                toastr["success"]("Sukces!");
                // location.reload();
            },
            error: function (data) {
                errors.empty();
                errors.parent().show();
                $.each(data.responseJSON.errors, function (key, value) {
                    errors.append('<li>' + value + '</li>')
                });
            }
        });
    });

    notes_container.on("click", ".delete-note", function (e) {
        e.preventDefault();
        var element = $(this);
        if (confirm('Czy na pewno chcesz usunąć ' + element.closest('.card').find('.card-title').text() + '?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/notes/' + id,
                type: 'DELETE',
                success: function (result) {
                    $grid.masonry('remove', element.closest('.grid-item'))
                    // layout remaining item elements
                        .masonry('layout');
                    toastr["success"]("Sukces!");
                }
            });
        }
    });

    notes_container.on("click", ".disable-note", function (e) {
        e.preventDefault();
        var element = $(this);
        if (confirm('Czy na pewno chcesz zablokować ' + element.closest('.card').find('.card-title').text() + '?')) {
            window.location = element.attr('href');
        }
        $('.tooltip').remove();
    });

    $('.lang-menu').on("click", function () {
        $('.lang-options').slideToggle();
    });

    $('.search-menu').on("click", function () {
        $('#note-search-form').slideToggle();
        $('.search-menu').hide()
    });
    $('.refresh-filters').on("click", function () {
        window.location = $(this).attr('data-url')
    });

    //ADD EDIT PAGE
    $('.important-note').on("click", function () {
        $('.scale-handle').slideToggle();
        if ($(this).is(':checked')) {
            $('#scale').prop('disabled', false);
        } else {
            $('#scale').prop('disabled', true);
        }
    });
    if ($('#scale').length > 0) {
        $("#scale").ionRangeSlider({
            type: "single",
            min: 1,
            max: 10,
            onFinish: function (data) {

            }
        });
    }
});

function generateNote(data) {
    var note = [];

    note += '<div class="grid-item notes-list">';
    note += '<div class="card bg-light mb-3" style="max-width: 20rem;">';
    if (data.important >= 1 && data.important <= 10) {
        note += '<div class="ribbon-important"><span>WAŻNA (' + data.important + ')</span></div>';
    }
    note += '<div class="card-body">';
    note += '<h4 class="card-title">' + data.title + '</h4>';
    note += '<p class="card-text">' + data.content + '</p>';
    note += '<small class="additional-info text-muted">Data: ' + data.date + '</small>';
    note += '<small class="additional-info text-muted">Przez: ' + data.name + '</small>';
    note += '</div>';
    note += '<div class="card-footer">';
    note += '<small class="text-muted note-timestamps"><i class="fa fa-calendar" data-toggle="tooltip" data-placement="top" title="Data dodania"></i> ' + data.created_at + '</small>';
    note += '</div>';
    note += '<div class="card-actions no-wrap">';
    note += '<a href="/notes/' + data.id + '/disable" class="btn btn-light disable-note" data-toggle="tooltip" data-placement="top" title="Zablokuj"><i class="fa fa-ban"></i></a>';
    note += '<a href="/notes/' + data.id + '" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Podgląd"><i class="fa fa-eye"></i></a>';
    note += '<a href="/notes/' + data.id + '/edit" class="btn btn-light" data-toggle="tooltip" data-placement="top" title="Edycja"><i class="fa fa-edit"></i></a>';
    note += '<button data-id="' + data.id + '" type="button" class="btn btn-light delete-note" data-toggle="tooltip" data-placement="top" title="Usuń"><i class="fa fa-trash"></i></button>';
    note += '</div></div></div>';

    return $(note);
}
function clearInputs() {
    $('input, textarea').val('');
    $('input[type="checkbox"]').prop('checked', false);
}