


$(document).ready(function () {
    // Hide form initially
    $('#taskForm').hide();

    // Show form on button click
    $('#addTaskBtn').on('click', function () {
        $('#taskForm').show();
    });

    // Handle type selection (Project/Ticket)
    $(document).on('change', '.type-select', function () {
        const selected = $(this).val();
        const taskBlock = $(this).closest('.task-block');
        const dynamicContainer = taskBlock.find('.dynamic-fields');
        const descriptionField = taskBlock.find('.description-group');

        dynamicContainer.html('').hide();
        descriptionField.show();

        if (selected === '1' || selected === '2') {
            let dropdownHtml = '';
            
            if (selected === '1') {
                dropdownHtml += `<label>Project Name <span class="required">*</span></label>
                    <select class="form-control select2-field inputtaskbox" name="project_id[]" required>
                        <option value="">Select Project</option>`;
                $.each(projectOptions, function (id, name) {
                    dropdownHtml += `<option value="${id}">${name}</option>`;
                });
                dropdownHtml += `</select>`;
            }
            else if (selected === '2') {
                dropdownHtml += `<label>Ticket Name <span class="required">*</span></label>
                    <select class="form-control select2-field inputtaskbox" name="ticket_id[]" required>
                        <option value="">Select Ticket</option>`;
                $.each(ticketOptions, function (id, name) {
                    dropdownHtml += `<option value="${id}">${name}</option>`;
                });
                dropdownHtml += `</select>`;
            }

            dynamicContainer.html(dropdownHtml).show();
            descriptionField.hide();
            dynamicContainer.find('select.select2-field').select2({ width: '100%' });
            dynamicContainer.after(descriptionField.show());
        }
    });

    // Add Task Block
    $(document).on('click', '.btn-add', function () {
        var clone = $('.task-block').first().clone();
        clone.find('input, textarea, select').val('');
        clone.find('.select2-container').remove();
        clone.find('.select2-field').removeClass('select2-hidden-accessible').show();
        clone.find('.dynamic-fields').empty().hide();
        clone.find('.description-group').show();
        clone.find('.error-message').remove();
        $('#taskContainer').append(clone);
    });

    // Remove Task Block
    $(document).on('click', '.btn-remove', function () {
        if ($('.task-block').length > 1) {
            $(this).closest('.task-block').remove();
        }
    });

    // Form Submission Handler
    $('#taskForm').on('submit', function (e) {
        e.preventDefault();
        
        // Clear previous error messages
        $('.error-message').remove();
        
        // Reindex all array inputs to maintain proper order
        $('.task-block').each(function(index) {
            $(this).find('[name^="type"]').attr('name', `type[${index}]`);
            $(this).find('[name^="description"]').attr('name', `description[${index}]`);
            $(this).find('[name^="notes"]').attr('name', `notes[${index}]`);
            $(this).find('[name^="status"]').attr('name', `status[${index}]`);
            
            // Handle project/ticket IDs based on type
            const type = $(this).find('.type-select').val();
            if (type == '1') {
                $(this).find('[name^="project_id"]').attr('name', `project_id[${index}]`);
                $(this).find('[name^="ticket_id"]').removeAttr('name');
            } else if (type == '2') {
                $(this).find('[name^="ticket_id"]').attr('name', `ticket_id[${index}]`);
                $(this).find('[name^="project_id"]').removeAttr('name');
            }
        });

        // Prepare form data
        var formData = new FormData(this);
        
        // Submit via AJAX
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // Handle success response
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Tasks saved successfully!',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'OK'
                }).then(() => {
                    location.reload(); // Refresh the page
                });
            },
    
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Validation errors
                    const errors = xhr.responseJSON.errors;

                    $.each(errors, function (field, messages) {
                        // Match field names with proper index (e.g., description.0)
                        const matches = field.match(/^(\w+)\.(\d+)$/);
                        if (matches) {
                            const fieldName = matches[1]; // e.g., description
                            const index = matches[2];     // e.g., 0

                            const taskBlock = $('.task-block').eq(index);
                            const input = taskBlock.find(`[name="${fieldName}[${index}]"]`);

                            if (input.length) {
                                input.after(`<p class="error-message text-danger">${messages[0]}</p>`);
                            }
                        }
                    });
                } else {
                    // Other errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.'
                    });
                }
            }
        });
    });
});