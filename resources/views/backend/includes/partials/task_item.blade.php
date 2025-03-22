<li class="dd-item" data-id="{{ $task->id }} ">
    <div class="dd-handle edit-task-btn " 
            data-id="{{ $task->id }}" 
            data-project-id="{{ $task->project_id }}" 
            data-bs-toggle="modal" 
            data-bs-target="#edittask">
        <div class="task-info d-flex align-items-center justify-content-between">
            <h6 class="light-success-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">
                {{ $task->task_name }}
                
            </h6>
            <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                <div class="avatar-list avatar-list-stacked m-0">
                    <img class="avatar rounded-circle small-avt" src="{{ url('/images/xs/avatar2.jpg') }}" alt="">
                    <img class="avatar rounded-circle small-avt" src="{{ url('/images/xs/avatar1.jpg') }}" alt="">
                </div>
                <span class="badge bg-warning text-end mt-2">{{ $task->taskCategoryName }}</span>
            </div>
        </div>
        <p class="py-2 mb-0">{{ $task->description }}</p>
        <div class="tikit-info row g-3 align-items-center">
            <div class="col-sm">
                <ul class="d-flex list-unstyled align-items-center flex-wrap">
                    <li class="me-2">
                        <div class="d-flex align-items-center">
                            <i class="icofont-flag"></i>
                            <span class="ms-1">{{ $task->formatted_end_date }}</span>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-sm text-end">
                <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small">
                    {{ $task->project->project_name ?? 'N/A' }}
                </div>
            </div>
        </div>
    </div>
</li>



