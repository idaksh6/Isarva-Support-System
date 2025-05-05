$(document).ready(function() {
    $('.select2').select2();

    $('#type_selector').on('change', function() {
        let value = $(this).val();
        $('#project_select_div, #ticket_select_div').addClass('d-none');
        if (value === '1') {
            $('#project_select_div').removeClass('d-none');
        } else if (value === '2') {
            $('#ticket_select_div').removeClass('d-none');
        }
    });

    // Trigger change on page load to restore state after validation error
    if ($('#type_selector').val() != '') {
        $('#type_selector').trigger('change');
    }
});
