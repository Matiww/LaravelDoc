$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var calendar = $('#calendar')
    var today_tasks = $('.calendar-today');
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
                        var color;
                        calendar_tasks.empty();
                        $(response).each(function (index, element) {
                            switch(element.important) {
                                case 1:
                                    color = '#00c0ef ';
                                    break;
                                case 2:
                                    color = '#f39c12';
                                    break;
                                case 3:
                                    color = '#dd4b39';
                                    break;
                                default:
                                    color = '#c1bd90';
                            }
                            events.push({
                                title: element.title,
                                start: element.date,
                                url: 'notes/' + element.id,
                                color: color,
                                textColor: 'white',
                                borderColor: color,
                                allDay: true
                            });
                            var now = new Date();
                            var date = new Date(element.date);

                            if(isTodayDate(now, date)) {
                                today_tasks.append('<a href="notes/' +element.id+'"><div style="background-color: '+color+'" class="external-event" style="position: relative;"><p>'+date.getDate() + '-' + (date.getMonth() + 1) +  '-' + date.getFullYear()+'</p>'+element.title+'</div></a>');
                            }
                            if(isFutureDate(now, date)) {
                                calendar_tasks.append('<a href="notes/' +element.id+'"><div style="background-color: '+color+'" class="external-event" style="position: relative;"><p>'+date.getDate() + '-' + (date.getMonth() + 1) +  '-' + date.getFullYear()+'</p>'+element.title+'</div></a>');
                            }
                        });
                        if(today_tasks.children().length === 0) {
                            today_tasks.html('<p>Brak</p>');
                        }
                        if(calendar_tasks.children().length === 0) {
                            calendar_tasks.html('<p>Brak</p>');
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

function isTodayDate(now, date) {
    var same_day = false;

    if(date.getDate() === now.getDate()) {
        if(date.getMonth() === now.getMonth()){
            if(date.getFullYear() === now.getFullYear()){
                same_day = true;
            }
        }
    }
    return same_day;

}

function isFutureDate(now, date) {
    var future_day = false;

    if(date.getFullYear() > now.getFullYear() || (date.getFullYear() === now.getFullYear() && date.getMonth() > now.getMonth()) || (date.getFullYear() === now.getFullYear() && date.getMonth() === now.getMonth() && date.getDate() > now.getDate())) {
        future_day = true
    }

    return future_day;
}