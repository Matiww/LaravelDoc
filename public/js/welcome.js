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
                        console.log(response);
                        var events = [];
                        $(response).each(function( index, element ) {
                          events.push({
                              title: element.title,
                              start: element.date,
                              url: 'notes/'+element.id,
                              color: '#007bff',
                              textColor: 'white',
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