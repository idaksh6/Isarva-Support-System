@extends('backend.layouts.app')

@section('title', 'Edit Daily Task | Isarva Support')

@section('content')

<style>
    span.select2-selection.select2-selection--single{
        height:40px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 38px !important;
    }
    
    .dynamic-fields .error-message {
        margin-top: 8px;
        font-size: 14px;
    }

    .main {
            scrollbar-width: none;
            overflow-y: auto;
            /* height: 100vh; */
            height: 100%;
            order: 3;
            flex: 1;
    }

    /* Add this to your style section for select 2 validation msg */ 
        .dynamic-fields .error-message {
            margin-top: 8px;
            font-size: 14px;
        }
    @media(min-width:1280px){

            .main {
            scrollbar-width: none;
            overflow-y: auto;
            /* height: 100vh; */
            height: 100%;
            order: 3;
            flex: 1;
        }
        .sidebar {
            position: sticky;
            top: 25px;
        }
    }


    @media(max-width:600px){

        form#globalProjectSearch {
            flex-direction: column;
        }

        form#ticketIdSearch {
            padding: 0;
            border: 0;
        }

        .ms-2{
        margin:0 !important;
        }
    }
</style>

<div class="container dailytaskfield" id="editdailytask">
    <form id="taskEditForm" class="dailytaskform" action="{{ route('admin.daily-task.update', $task->id) }}" method="POST">
        @csrf
        @method('POST')
        
        <!-- Display Validation Errors -->
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div id="taskContainer">
            <!-- Main task block (the one being edited) -->
            <div class="task-block taskbox border rounded p-3 mb-3">
                <!-- Type Selection -->
                <div class="mb-3">
                    <label>Type <span class="required">*</span></label>
                    <select class="form-control inputtaskbox type-select" name="type[]">
                        <option value="">Select</option>
                        <option value="1" {{ $task->type == 1 ? 'selected' : '' }}>Project</option>
                        <option value="2" {{ $task->type == 2 ? 'selected' : '' }}>Ticket</option>
                    </select>
                    <div class="text-danger" id="dailytask_error-type"></div>
                </div>

                <!-- Dynamic Project/Ticket Container -->
                <div class="mb-3 dynamic-fields">
                    @if($task->type == 1)
                        <label>Project Name <span class="required">*</span></label>
                        <select class="form-control select2-field inputtaskbox" name="project_id[]">
                            <option value="">Select Project</option>
                            @foreach($projects as $id => $name)
                                <option value="{{ $id }}" {{ $task->project_ticket_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    @elseif($task->type == 2)
                        <label>Ticket Name <span class="required">*</span></label>
                        <select class="form-control select2-field inputtaskbox" name="ticket_id[]">
                            <option value="">Select Ticket</option>
                            @foreach($tickets as $id => $name)
                                <option value="{{ $id }}" {{ $task->project_ticket_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>

                <!-- Description Field -->
                <div class="mb-3 description-group">
                    <label>Description <span class="required">*</span></label>
                    <textarea class="form-control inputtaskbox" rows="2" name="description[]">{{ $task->description }}</textarea>
                    <div class="text-danger" id="dailytask_error-description"></div>
                </div>

                <!-- Notes -->
                <div class="mb-3">
                    <label>Notes</label>
                    <textarea class="form-control inputtaskbox" rows="2" name="notes[]">{{ $task->notes }}</textarea>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label>Status <span class="required">*</span></label>
                    <select class="form-control inputtaskbox" name="status[]">
                        <option value="">None</option>
                        <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Waiting for client</option>
                        <option value="2" {{ $task->status == 2 ? 'selected' : '' }}>Pending</option>
                        <option value="3" {{ $task->status == 3 ? 'selected' : '' }}>Client Review</option>
                        <option value="4" {{ $task->status == 4 ? 'selected' : '' }}>Progress</option>
                        <option value="5" {{ $task->status == 5 ? 'selected' : '' }}>Completed</option>
                        <option value="6" {{ $task->status == 6 ? 'selected' : '' }}>Review</option>
                        <option value="7" {{ $task->status == 7 ? 'selected' : '' }}>Not Started</option>
                    </select>
                    <div class="text-danger" id="dailytask_error-status"></div>
                </div>

                <!-- Hidden field to identify existing tasks -->
                <input type="hidden" name="task_ids[]" value="{{ $task->id }}">
                
                <!-- Add/Remove Buttons -->
                <div class="mb-3 d-flex gap-2 justify-content-end action-buttons">
                    <button type="button" class="btn-circle btn-add add-btn"><i class="icofont-plus-circle"></i></button>
                    <button type="button" class="btn-circle btn-remove remove-btn"><i class="icofont-minus-circle"></i></button>
                </div>
            </div>
            
            <!-- Additional task blocks (if any) -->
            @foreach($additionalTasks as $additionalTask)
            <div class="task-block taskbox border rounded p-3 mb-3">
                <!-- Type Selection -->
                <div class="mb-3">
                    <label>Type <span class="required">*</span></label>
                    <select class="form-control inputtaskbox type-select" name="type[]">
                        <option value="">Select</option>
                        <option value="1" {{ $additionalTask->type == 1 ? 'selected' : '' }}>Project</option>
                        <option value="2" {{ $additionalTask->type == 2 ? 'selected' : '' }}>Ticket</option>
                    </select>
                    <div class="text-danger" id="dailytask_error-type"></div>
                </div>

                <!-- Dynamic Project/Ticket Container -->
                <div class="mb-3 dynamic-fields">
                    @if($additionalTask->type == 1)
                        <label>Project Name <span class="required">*</span></label>
                        <select class="form-control select2-field inputtaskbox" name="project_id[]">
                            <option value="">Select Project</option>
                            @foreach($projects as $id => $name)
                                <option value="{{ $id }}" {{ $additionalTask->project_ticket_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    @elseif($additionalTask->type == 2)
                        <label>Ticket Name <span class="required">*</span></label>
                        <select class="form-control select2-field inputtaskbox" name="ticket_id[]">
                            <option value="">Select Ticket</option>
                            @foreach($tickets as $id => $name)
                                <option value="{{ $id }}" {{ $additionalTask->project_ticket_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    @endif
                </div>

                <!-- Description Field -->
                <div class="mb-3 description-group">
                    <label>Description <span class="required">*</span></label>
                    <textarea class="form-control inputtaskbox" rows="2" name="description[]">{{ $additionalTask->description }}</textarea>
                    <div class="text-danger" id="dailytask_error-description"></div>
                </div>

                <!-- Notes -->
                <div class="mb-3">
                    <label>Notes</label>
                    <textarea class="form-control inputtaskbox" rows="2" name="notes[]">{{ $additionalTask->notes }}</textarea>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label>Status <span class="required">*</span></label>
                    <select class="form-control inputtaskbox" name="status[]">
                        <option value="">None</option>
                        <option value="1" {{ $additionalTask->status == 1 ? 'selected' : '' }}>Waiting for client</option>
                        <option value="2" {{ $additionalTask->status == 2 ? 'selected' : '' }}>Pending</option>
                        <option value="3" {{ $additionalTask->status == 3 ? 'selected' : '' }}>Client Review</option>
                        <option value="4" {{ $additionalTask->status == 4 ? 'selected' : '' }}>Progress</option>
                        <option value="5" {{ $additionalTask->status == 5 ? 'selected' : '' }}>Completed</option>
                        <option value="6" {{ $additionalTask->status == 6 ? 'selected' : '' }}>Review</option>
                        <option value="7" {{ $additionalTask->status == 7 ? 'selected' : '' }}>Not Started</option>
                    </select>
                    <div class="text-danger" id="dailytask_error-status"></div>
                </div>

                <!-- Hidden field to identify existing tasks -->
                <input type="hidden" name="task_ids[]" value="{{ $additionalTask->id }}">
                
                <!-- Add/Remove Buttons -->
                <div class="mb-3 d-flex gap-2 justify-content-end action-buttons">
                    <button type="button" class="btn-circle btn-add add-btn"><i class="icofont-plus-circle"></i></button>
                    <button type="button" class="btn-circle btn-remove remove-btn"><i class="icofont-minus-circle"></i></button>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="subbtn gap-2">
            <button type="submit" class="btn dailytsksybbtn fw-bold">Update</button>
            <a href="{{ route('admin.add_dailytask') }}" class="btn btn-secondary fw-bold">Cancel</a>
        </div> 
    </form>
</div>

<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>

<script>
    const projectOptions = @json($projects);
    const ticketOptions = @json($tickets);

    $(document).ready(function () {
        // Initialize Select2 for existing selects
        $('.select2-field').select2({ width: '100%' });

        // Handle type selection change
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
                        <select class="form-control select2-field inputtaskbox" name="project_id[]">
                            <option value="">Select Project</option>`;
                    $.each(projectOptions, function (id, name) {
                        dropdownHtml += `<option value="${id}">${name}</option>`;
                    });
                    dropdownHtml += `</select>`;
                }
                else if (selected === '2') {
                    dropdownHtml += `<label>Ticket Name <span class="required">*</span></label>
                        <select class="form-control select2-field inputtaskbox" name="ticket_id[]">
                            <option value="">Select Ticket</option>`;
                    $.each(ticketOptions, function (id, name) {
                        dropdownHtml += `<option value="${id}">${name}</option>`;
                    });
                    dropdownHtml += `</select>`;
                }

                dynamicContainer.html(dropdownHtml).show();
                dynamicContainer.find('select.select2-field').select2({ width: '100%' });
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
            clone.find('input[name="task_ids[]"]').remove(); // Remove task ID for new tasks
            $('#taskContainer').append(clone);
        });

        // Remove Task Block
        $(document).on('click', '.btn-remove', function () {
            if ($('.task-block').length > 1) {
                $(this).closest('.task-block').remove();
            }
        });

        // Form Submission Handler
        $('#taskEditForm').on('submit', function (e) {
            e.preventDefault();
            
            // Clear previous error messages
            $('.error-message').remove();
            
            // Reindex all array inputs to maintain proper order
            $('.task-block').each(function(index) {
                $(this).find('[name^="type"]').attr('name', `type[${index}]`);
                $(this).find('[name^="description"]').attr('name', `description[${index}]`);
                $(this).find('[name^="notes"]').attr('name', `notes[${index}]`);
                $(this).find('[name^="status"]').attr('name', `status[${index}]`);
                $(this).find('[name^="task_ids"]').attr('name', `task_ids[${index}]`);
                
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
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Tasks updated successfully!',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = "{{ route('admin.add_dailytask') }}";
                    });
                },
                error: function (xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        $.each(errors, function (field, messages) {
                            const matches = field.match(/^(\w+)\.(\d+)$/);
                            if (matches) {
                                const fieldName = matches[1];
                                const index = matches[2];
                                const taskBlock = $('.task-block').eq(index);
                                
                                if (fieldName === 'project_id' || fieldName === 'ticket_id') {
                                    const select2Container = taskBlock.find(`select[name="${fieldName}[${index}]"]`).closest('.dynamic-fields');
                                    if (select2Container.length) {
                                        select2Container.append(`<p class="error-message text-danger mt-2">${messages[0]}</p>`);
                                    }
                                } else {
                                    const input = taskBlock.find(`[name="${fieldName}[${index}]"]`);
                                    if (input.length) {
                                        input.after(`<p class="error-message text-danger">${messages[0]}</p>`);
                                    }
                                }
                            }
                        });
                    } else {
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
</script>

@endsection