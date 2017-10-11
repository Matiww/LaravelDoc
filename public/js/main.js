$(document).ready(function() {
    $('.logout').on("click", function(e) {
        e.preventDefault();
       $('#logout-form').submit();
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
});