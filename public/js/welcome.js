$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'agendaDay,agendaWeek,month'
        },
        events: function(start, end, timezone, callback) {
            $.ajax({
                url: '/notes/events',
                type: 'POST',
                    error: function() {
                        $('#script-warning').show();
                    },
                    success: function(response){
                    console.log(response.important);
                        var events = [];
                        $(response).each(function( index, element ) {
                        var border_color = element.important == 1 ? '#ff0000' : '#007bff';
                          events.push({
                              title: element.title,
                              start: element.date,
                              url: 'notes/'+element.id,
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
        loading: function(bool) {
            $('#loader').toggle(bool);
        }
    });
});