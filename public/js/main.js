$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.logout').on("click", function(e) {
        e.preventDefault();
       $('#logout-form').submit();
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });

    $('.delete-note').on("click", function() {
        var element = $(this);
        var notes_container = $('.notes-container');
        if(confirm('Czy na pewno chcesz usunąć '+element.closest('.card').find('.card-title').text()+'?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/notes/'+id,
                type: 'DELETE',
                success: function(result) {
                    element.closest('.notes-list').fadeOut(function() {
                        $('.tooltip').remove();
                        if($(this).remove()) {
                            if(notes_container.find('.notes-list').length == 0) {
                                notes_container.html(
                                    '<div class="col-md-4"></div>' +
                                    '<div class="col-md-4 notes-list">' +
                                    '<div class="alert alert-info" role="alert">Brak notatek</div>' +
                                    '</div>' +
                                    '<div class="col-md-4"></div>'
                                );
                            }
                        }
                    });
                }
            });
        }
    });
    //var multi_select = $('#optgroup');
    //multi_select.multiSelect({ selectableOptgroup: true });
    //$('#select-all').on("click", function() {
    //    multi_select.multiSelect('select_all');
    //});
    //$('#deselect-all').on("click", function() {
    //    multi_select.multiSelect('deselect_all');
    //});
    //$('.private-note').on("click", function() {
    //    $('.responsible-select').toggle();
    //
    //    if($('.private-note:checked').length > 0) {
    //        $('#optgroup').attr('disabled', true);
    //    } else {
    //        $('#optgroup').removeAttr('disabled', false);
    //    }
    //});
});