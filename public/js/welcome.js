$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if($('#calendar').length > 0) {
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'agendaDay,agendaWeek,month'
            },
            events: function (start, end, timezone, callback) {
                $.ajax({
                    url: '/noteww/public/notes/events',
                    type: 'POST',
                    error: function () {
                        $('#script-warning').show();
                    },
                    success: function (response) {
                        var events = [];
                        $(response).each(function (index, element) {
                            var border_color = '#007bff';
                            events.push({
                                title: element.title,
                                start: element.date,
                                url: 'notes/' + element.id,
                                color: '#007bff',
                                textColor: 'white',
                                borderColor: border_color,
                                allDay: true
                            })
                        });
                        callback(events);
                    }
                });
            },
            loading: function (bool) {
                $('#loader').toggle(bool);
            }
        });
    }
    $('.content-wrapper').on("click", ".delete-note", function (e) {
        e.preventDefault();
        var element = $(this);
        if (confirm('Czy na pewno chcesz usunąć ' + element.closest('tr').find('td').first().text() + '?')) {
            var id = $(this).attr('data-id');
            $.ajax({
                url: '/noteww/public/notes/' + id,
                type: 'DELETE',
                success: function (result) {
                   location.reload();
                }
            });
        }
        $('.tooltip').remove();
    });
});