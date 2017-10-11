$(document).ready(function() {
    $('.logout').on("click", function(e) {
        e.preventDefault();
       $('#logout-form').submit();
    });
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
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