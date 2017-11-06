$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var calendar = $('#calendar');
    var calendar_tasks = $('.calendar-tasks');
    if(calendar.length > 0) {
        calendar.fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'agendaDay,agendaWeek,month'
            },
            events: function (start, end, timezone, callback) {
                $.ajax({
                    url: '/notes/events',
                    type: 'POST',
                    error: function () {
                        $('#script-warning').show();
                    },
                    success: function (response) {
                        var events = [];
                        calendar_tasks.empty();
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
                            });
                            var now = new Date();
                            var date = new Date(element.date);
                            if(now < date) {
                                calendar_tasks.append('<div class="external-event bg-light-blue " style="position: relative;"><p>'+date.getDate() + '-' + (date.getMonth() + 1) +  '-' + date.getFullYear()+'</p>'+element.title+'</div>');
                            }
                        });
                        if(calendar_tasks.children().length == 0) {
                            calendar_tasks.html('<p>Brak zadań</p>');
                        }
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
                url: '/notes/' + id,
                type: 'DELETE',
                success: function (result) {
                   location.reload();
                }
            });
        }
        $('.tooltip').remove();
    });
});