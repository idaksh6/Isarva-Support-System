@extends('backend.layouts.app')


@section('title', __('Task Manage | Isarva Support'))

@section('content')

@php
    $tasks = $tasks ?? collect(); // Ensures $tasks is always defined
    $internalDocs = $internalDocs ?? collect(); // Ensures $internalDocs is always defined
@endphp


<!-- Create task-->
<div class="modal fade" id="createtask" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title  fw-bold" id="createprojectlLabel"> Create Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id= "createtaskform" action="{{ route('admin.project_task.store-task') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                      <!-- Ensures project_id is passed along with the form submission for the task.-->
                     <!-- Ensure project_id is only included when available -->
                     @if(isset($project))
                     <input type="hidden" name="project_id" value="{{ $project->id }}">
                     @endif
                     

                    <div class="mb-3">
                        <label class="form-label">Task Name <span class="required">*</span></label>
                        <input type="text" class="form-control" name="task_name" placeholder="Enter the Task name" value="{{ old('task_name') }}" >
                        <div class="text-danger" id="task-error-task_name"></div> <!-- Error container for "name" -->
                    </div>
                   
                    <div class="mb-3">
                        <label class="form-label">Task Category</label>
                        <select class="form-select" name="task_category" aria-label="Default select Project Category">
                            <option selected>None</option>
                            <option value="1" {{ old('category') == '1' ? 'selected' : '' }}>Website Design</option>
                            <option value="2" {{ old('category') == '2' ? 'selected' : '' }}>App Development</option>
                            <option value="3" {{ old('category') == '3' ? 'selected' : '' }}>Quality Assurance</option>
                            <option value="4" {{ old('category') == '4' ? 'selected' : '' }}>Development</option>
                            <option value="5" {{ old('category') == '5' ? 'selected' : '' }}>Backend Development</option>
                            <option value="6" {{ old('category') == '6' ? 'selected' : '' }}>Software Testing</option>
                            <option value="8" {{ old('category') == '8' ? 'selected' : '' }}>Marketing</option>
                            <option value="9" {{ old('category') == '9' ? 'selected' : '' }}>UI/UX Design</option>
                            <option value="10"{{ old('category') == '10' ? 'selected' : ''}}>Other</option>
                        </select>
                        <div class="text-danger" id="task-error-task_category"></div>
                    </div>
                    

                    <div class="mb-3">
                        <label class="form-label">Description<span class="required">*</span></label>
                        <textarea class="form-control" name="task_description" value="{{ old('task_description') }}" rows="3" placeholder="Enter the details about project"></textarea>
                        <div class="text-danger" id="task-error-task_description"></div>
                    </div>

                    {{-- <div class="mb-3">
                        <label for="formFileMultipleone" class="form-label">Task Images & Document</label>
                        <input class="form-control" type="file" id="formFileMultipleone" multiple>
                    </div> --}}

                    
                    <div class="mb-3">
                        <label  class="form-label">Task End Date</label>
                        <input type="date" class="form-control" name="task_end_date" value="{{ old('task_end_date') }}" >
                        <div class="text-danger" id="task-error-task_end_date"></div>
                    </div>
                        
                    <div class="mb-3 mt-4">
                        <label for="assigned_for" class="form-label">Assigned For <span class="required">*</span></label>
                        <select class="form-select" name="task_assigned_for">
                            <option value="">Select Member</option>
                            @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                                <option value="{{ $id }}">{{ $employeeName }}</option>
                            @endforeach
                        </select>                        
                        <div class="text-danger" id="task-error-task_assigned_for"></div>
                    </div>

                    <!-- Estimation Field -->
                    <div class="mb-3 mt-4">
                        <label class="form-label">Estimation Hr <span class="required">*</span></label>
                        <input type="number" class="form-control" name="task_estimation_hr"  value="{{ old('task_estimation') }}" placeholder="Enter the Task Estimation" >
                        <div class="text-danger" id="task-error-task_estimation_hr"></div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
                        <button type="Submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit task -->
<div class="modal fade" id="edittask" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
             <div class="modal-body">
                 <form id="editTaskForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="edit_project_id" name="project_id">
                    <input type="hidden" id="edit_task_id" name="task_id">

                    <!-- Task Name -->
                    <div class="mb-3">
                        <label for="edit_task_name" class="form-label">Task Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="edit_task_name" name="task_name">
                        <div class="text-danger" id="task_edit-error-task_name"></div>
                    </div>

                    
                     <!-- Project Category -->
                    <div class="mb-3">
                        <label class="form-label">Task Category</label>
                        <select class="form-select" name="task_category" id="edit_task_category">
                            <option value="">None</option>
                            <option value="1">Website Design</option>
                            <option value="2">App Development</option>
                            <option value="3">Quality Assurance</option>
                            <option value="4">Development</option>
                            <option value="5">Backend Development</option>
                            <option value="6">Software Testing</option>
                            <option value="7">Marketing</option>
                            <option value="8">UI/UX Design</option>
                            <option value="9">Other</option>
                        </select>
                        <div class="text-danger" id="task_edit-error-task_category"></div>
                    </div>

                      <!-- Description -->
                      <div class="mb-3">
                        <label for="edit_description" class="form-label">Description</label>
                        <textarea class="form-control" id="edit_task_description" name="task_description" rows="3"></textarea>
                        <div class="text-danger" id="task_edit-error-task_description"></div>
                    </div>

                

                    <!-- End Date -->
                    <div class="mb-3">
                        <label for="edit_end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="edit_task_end_date" name="task_end_date">
                        <div class="text-danger" id="task_edit-error-task_end_date"></div>
                    </div>
                    
                        <!-- Assigned To -->

                        <div class="mb-3">
                            <label for="edit_assigned_to" class="form-label">Assigned For <span class="text-danger">*</span></label>
                            <select class="form-select" name="task_assigned_for" id="edit_task_assigned_for">
                                <option value="">Select Employee</option>
                                @foreach(App\Helpers\EmployeeHelper::getEmployeeNames() as $id => $employeeName)
                                    <option value="{{ $id }}">{{ $employeeName }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger" id="task_edit-error-task_assigned_for"></div>
                        </div>
    
                      <!-- Estimation Field -->
                    <div class="mb-3 mt-4">
                        <label class="form-label">Estimation Hr <span class="required">*</span></label>
                        <input type="number" class="form-control" name="task_estimation_hr" id="edit_task_estimation" placeholder="Enter the Task Estimation" >
                        <div class="text-danger" id="task_edit-error-task_estimation_hr"></div>
                    </div>   

                    <!-- Submit Button -->
                    <div class="text-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Update Task</button>
                    </div> 
                </form> 
            </div>
        </div>
    </div>
</div>


    
    <!-- Body: Body -->
    <div class="body d-flex py-lg-3 py-md-2">
        <div class="container-xxl">

                <!-- First Row: Project Details -->
                <div class="d-flex justify-content-between align-items-center p-2 bg-light rounded">
                    <div class="w-100 ">
                        <h5 class="mb-0">
                            <strong>{{ $project->client_name ?? 'N/A' }}</strong> -
                            <strong>{{ $project->project_name }}</strong> -
                            <span class="badge bg-{{ $project->getStatusClass() }}">{{ $project->status_name }}</span> -
                            <strong>{{ \Carbon\Carbon::parse($project->end_date)->format('d-m-Y') }}</strong>
                        </h5>
                    </div>
                    <div class="editaddbtn">
                        <a href="#" class="btn btn-primary edit-project-btn" data-id="{{ $project->id }}" data-bs-toggle="modal" data-bs-target="#editproject">Edit Project</a>
                        <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createproject">+ Add Project</a>
                    </div>
                </div>

                <!-- Grey Separator Line -->
                <div class="my-2" style="border-bottom: 3px solid #ccc;"></div>

                <!-- Second Row: Project Description -->
                <div class="p-3 bg-white rounded shadow-sm">
                    <p class="mb-0">{{ $project->description }}</p>
                </div>
                
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Task Management</h3>
                            <div class="col-auto d-flex w-sm-100">
                                <button type="button" class="btn btn-dark btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#createtask">
                                    <i class="icofont-plus-circle me-2 fs-6"></i>Create Task
                                </button>
                                {{-- <button type="button" class="btn btn-success btn-set-task w-sm-100 ms-2" data-bs-toggle="modal" data-bs-target="#editTask">
                                    <i class="icofont-edit me-2 fs-6"></i>Edit Task
                                </button> --}}
                            </div>
                        </div>
                        
                    </div>
                </div> <!-- Row end  -->

            
                <!-- Tab Navigation -->
                <div class="d-flex gap-3 mt-3">
                    <button class="btn btn-outline-primary d-flex align-items-center" id="showTasks">
                        <i class="icofont-tasks me-2"></i> Tasks
                    </button>
                    <button class="btn btn-outline-primary d-flex align-items-center" id="showInternalDocs">
                        <i class="icofont-file-document me-2"></i> Internal Docs
                    </button>
                 
                    <button class="btn btn-outline-primary d-flex align-items-center" id="showAssets">
                        <i class="icofont-folder me-2"></i> Assets
                    </button>
                    
                </div>


                <!-- Sections (Initially Hidden) -->
                <div class="mt-3">

                  <!-- Internal Docs Section -->
                    <div id="internalDocsSection" class="tab-content shadow-sm p-3 rounded bg-white" style="display: none;">
                       <h5 class="fw-bold mb-3">Internal Docs</h5>

                        <!-- Success Message -->
                        {{-- @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif --}}

                    @if (session()->has('flash_success_docs'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
                            <i class="bi bi-check-circle-fill me-2 text-success"></i> 
                            <span>{{ session('flash_success_docs') }}</span>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                       <!-- Form to submit internal docs -->
                        <form id="internalDocsForm" action="{{ route('admin.internal-docs.store') }}" method="POST">
                            @csrf
                            <!-- Hidden input for project_id -->
                            <input type="hidden" name="project_id" value="{{ $project->id ?? '' }}">


                            <div class="table-responsive">
                                <table class="table table-bordered" id="internalDocsTable">
                                    <thead>
                                        <tr>
                                            <th>Si.No</th>
                                            <th>Date</th>
                                            <th>Title</th>
                                            <th>Link</th>
                                            <th>Comments</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <!-- Display Existing Internal Docs -->
                                        @php $count = 1; @endphp
                                        @foreach($internalDocs as $doc)
                                            <tr>
                                                <!-- Si.No and Hidden ID in the same <td> -->
                                                <td>
                                                    {{ $count }}
                                                    <input type="hidden" name="id[]" value="{{ $doc->id }}">
                                                </td>
                                                <td><input type="date" class="form-control" name="date[]" value="{{ \Carbon\Carbon::parse($doc->date)->format('Y-m-d') }}"></td>
                                                <td><input type="text" class="form-control" name="title[]" value="{{ $doc->title }}"></td>
                                                <td><input type="text" class="form-control" name="link[]" value="{{ $doc->link }}"></td>
                                                <td><input type="text" class="form-control" name="comments[]" value="{{ $doc->comments }}"></td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                                    <button type="button" class="btn btn-danger btn-sm remove-row">-</button>
                                                </td>
                                            </tr>
                                            @php $count++; @endphp
                                        @endforeach
                                        <!-- Add New Row (If no existing records) -->
                                        @if($count === 1)
                                            <tr>
                                                <!-- Si.No and Hidden ID in the same <td> -->
                                                <td>
                                                    1
                                                    <input type="hidden" name="id[]" value="">
                                                </td>
                                                <td><input type="date" class="form-control" name="date[]"></td>
                                                <td><input type="text" class="form-control" name="title[]"></td>
                                                <td><input type="text" class="form-control" name="link[]"></td>
                                                <td><input type="text" class="form-control" name="comments[]"></td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" id="saveInternalDocs" class="btn btn-primary mt-3">Save Changes</button>
                        </form>
                    </div>
                </div>




                    {{-- <!-- Assets Section -->
                 <div id="assetsSection" class="tab-content shadow-sm p-3 rounded bg-white" style="display: none;">
                        <h5 class="fw-bold mb-3">Assets</h5>
                        
                        <!-- Drag & Drop Upload Section -->
                        <div class="upload-container text-center p-4 border border-dashed rounded-3 position-relative" style="border-color: #ccc;">
                            <i class="icofont-cloud-upload display-4 text-muted"></i>
                            <p class="text-muted">Drag & Drop files here or</p>
                            <label class="btn btn-outline-primary mt-2 position-relative">
                                Select Files
                                <input type="file" multiple hidden id="fileInput">
                            </label>
                        </div>

                        <!-- Uploaded Files Preview -->
                        <div id="uploadedFiles" class="mt-4 d-flex flex-wrap gap-3">
                            <!-- Example file preview -->
                            <div class="file-preview d-flex flex-column align-items-center p-3 shadow-sm rounded bg-light position-relative">
                                <i class="icofont-file-alt display-6 text-muted"></i>
                                <p class="small text-truncate w-100 text-center mt-2">example.pdf</p>
                                <button class="btn btn-warning btn-sm mt-2">Download</button>
                            </div>
                        </div>
                    </div> --}} 

                    <!-- Assets Section -->

                  
                    {{-- <div id="assetsSection" class="tab-content shadow-sm p-3 rounded bg-white">
                        @if(session()->has('uploaded_files'))
                        @php $uploadedFiles = session('uploaded_files'); @endphp --}}
                        {{-- <pre>{{ print_r($uploadedFiles, true) }}</pre>  --}}
                        {{-- @endif --}}
                
                
                        {{-- <h5 class="fw-bold mb-3">Assets</h5> --}}

                        <!-- Drag & Drop Upload Section -->
                        {{-- <form action="{{ route('admin.task-asset.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id ?? '' }}">
                        
                            <div class="upload-container text-center p-4 border border-dashed rounded-3 position-relative" style="border-color: #ccc;">
                                <i class="icofont-cloud-upload display-4 text-muted"></i>
                                <p class="text-muted">Drag & Drop files here or</p>
                                <label class="btn btn-outline-primary mt-2 position-relative">
                                    Select Files
                                    <input type="file" name="assets[]" multiple hidden id="fileInput">
                                </label>
                            </div>
                        
                            <button type="submit" class="btn btn-success mt-3">Upload</button>
                        </form>
                        
                        <!-- Display Uploaded Files -->
                        <div class="mt-4">
                            <h5>Uploaded Files</h5>
                            <div class="row">
                                @foreach($assets as $file)
                                    <div class="col-md-3 mb-4">
                                        <div class="card shadow-sm">
                                            @if($file->is_image == 1)
                                                <!-- Display Image -->
                                                <img src="{{ asset('storage/images/taskasset_files/' . basename($file->image_path)) }}" class="card-img-top" alt="{{ $file->filename }}" style="height: 150px; object-fit: cover;">
                                            @else
                                                <!-- Display PDF Icon for Non-Image Files -->
                                                <div class="text-center p-4">
                                                    <i class="icofont-file-pdf display-4 text-danger"></i>
                                                    <p class="small text-truncate mt-2">{{ $file->filename }}</p>
                                                </div>
                                            @endif
                                            <div class="card-body text-center">
                                                <p class="card-text small">{{ $file->filename }}</p>
                                                <a href="{{ asset('storage/images/taskasset_files/' . basename($file->image_path)) }}" class="btn btn-sm btn-outline-primary" download>
                                                    <i class="icofont-download"></i> Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>  --}}

                    <!-- Assets Section -->
                    <div id="assetsSection" class="tab-content shadow-sm p-3 rounded bg-white">
                        @if (session()->has('flash_success_asset'))
                        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
                            <i class="bi bi-check-circle-fill me-2 text-success"></i> 
                            <span>{{ session('flash_success_asset') }}</span>
                            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                                        
                        <h5 class="fw-bold mb-3">Assets</h5>
                    
                        <!-- File Upload Section -->
                        <form action="{{ route('admin.task-asset.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id ?? '' }}">
                    
                            <!-- Custom File Upload UI -->
                            <div class="file-upload-container text-center p-4 border rounded-3 shadow-sm" style="background: #f9f9f9;">
                                <label class="btn btn-primary position-relative">
                                    <i class="icofont-upload"></i> Select Files
                                    <input type="file" name="assets[]" multiple hidden id="fileInput">
                                </label>
                                
                                <!-- Selected File List -->
                                <div id="selectedFiles" class="mt-3 text-start">
                                    <p class="text-muted">No files selected</p>
                                </div>
                            </div>
                    
                            <button type="submit" class="btn btn-success mt-3">Upload</button>
                        </form>
                    
                        <!-- Display Uploaded Files -->
                        <div class="mt-4">
                            <h5>Uploaded Files</h5>
                            <div class="row">
                                @foreach($assets as $file)
                                    <div class="col-md-3 mb-4">
                                        <div class="card shadow-sm">
                                            @if($file->is_image == 1)
                                                <img src="{{ asset('storage/images/taskasset_files/' . basename($file->image_path)) }}" class="card-img-top" alt="{{ $file->filename }}" style="height: 150px; object-fit: cover;">
                                            @else
                                                <div class="text-center p-4">
                                                    <i class="icofont-file-pdf display-4 text-danger"></i>
                                                    <p class="small text-truncate mt-2">{{ $file->filename }}</p>
                                                </div>
                                            @endif
                                            <div class="card-body text-center">
                                                <p class="card-text small">{{ $file->filename }}</p>
                                                <a href="{{ asset('storage/images/taskasset_files/' . basename($file->image_path)) }}" class="btn btn-sm btn-outline-primary" download>
                                                    <i class="icofont-download"></i> Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    {{-- <div id="assetsSection" class="tab-content shadow-sm p-3 rounded bg-white">
                        <h5 class="fw-bold mb-3">Assets</h5>
                    
                        <!-- Drag & Drop Upload Section -->
                        <form id="uploadForm" action="{{ route('admin.task-asset.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="project_id" value="{{ $project->id ?? '' }}">
                        
                            <div class="upload-container text-center p-4 border border-dashed rounded-3 position-relative" style="border-color: #ccc;" id="dropZone">
                                <i class="icofont-cloud-upload display-4 text-muted"></i>
                                <p class="text-muted">Drag & Drop files here or</p>
                                <label class="btn btn-outline-primary mt-2 position-relative">
                                    Select Files
                                    <input type="file" name="assets[]" multiple hidden id="fileInput">
                                </label>
                            </div>
                        
                            <!-- Display Selected Files Before Upload -->
                            <div id="selectedFiles" class="mt-3"></div>
                        
                            <button type="submit" class="btn btn-success mt-3">Upload</button>
                        </form>
                        
                        <!-- Display Uploaded Files -->
                        <div class="mt-4">
                            <h5>Uploaded Files</h5>
                            <div class="row" id="uploadedFiles">
                                @foreach($assets as $file)
                                    <div class="col-md-3 mb-4">
                                        <div class="card shadow-sm">
                                            @if($file->is_image == 1)
                                                <!-- Display Image -->
                                                <img src="{{ asset('storage/images/taskasset_files/' . basename($file->image_path)) }}" class="card-img-top" alt="{{ $file->filename }}" style="height: 150px; object-fit: cover;">
                                            @else
                                                <!-- Display PDF Icon for Non-Image Files -->
                                                <div class="text-center p-4">
                                                    <i class="icofont-file-pdf display-4 text-danger"></i>
                                                    <p class="small text-truncate mt-2">{{ $file->filename }}</p>
                                                </div>
                                            @endif
                                            <div class="card-body text-center">
                                                <p class="card-text small">{{ $file->filename }}</p>
                                                <a href="{{ asset('storage/images/taskasset_files/' . basename($file->image_path)) }}" class="btn btn-sm btn-outline-primary" download>
                                                    <i class="icofont-download"></i> Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                     --}}
                    <!-- Include SweetAlert -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        
                    <div id="taskSection" class="tab-content shadow-sm p-3 rounded bg-white">
                        <h5 class="fw-bold mb-3">Project Task section</h5>

                    
                       <div class="col-lg-12 col-md-12 flex-column">
                         {{-- <div class="row g-3 row-deck">
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-header py-3">
                                        <h6 class="mb-0 fw-bold ">Task Progress</h6>
                                    </div>
                                    <div class="card-body mem-list">
                                        <div class="progress-count mb-4">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h6 class="mb-0 fw-bold d-flex align-items-center">UI/UX Design</h6>
                                                <span class="small text-muted">02/07</span>
                                            </div>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar light-info-bg" role="progressbar" style="width: 92%" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-count mb-4">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h6 class="mb-0 fw-bold d-flex align-items-center">Website Design</h6>
                                                <span class="small text-muted">01/03</span>
                                            </div>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-lightgreen" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-count mb-4">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h6 class="mb-0 fw-bold d-flex align-items-center">Quality Assurance</h6>
                                                <span class="small text-muted">02/07</span>
                                            </div>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar light-success-bg" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-count mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h6 class="mb-0 fw-bold d-flex align-items-center">Development</h6>
                                                <span class="small text-muted">01/05</span>
                                            </div>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar light-orange-bg" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                        <div class="progress-count mb-4">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <h6 class="mb-0 fw-bold d-flex align-items-center">Testing</h6>
                                                <span class="small text-muted">01/08</span>
                                            </div>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar bg-lightyellow" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-header py-3">
                                        <h6 class="mb-0 fw-bold ">Recent Activity</h6>
                                    </div>
                                    <div class="card-body mem-list">
                                        <div class="timeline-item ti-danger border-bottom ms-2">
                                            <div class="d-flex">
                                                <span class="avatar d-flex justify-content-center align-items-center rounded-circle light-success-bg">RH</span>
                                                <div class="flex-fill ms-3">
                                                    <div class="mb-1"><strong>Rechard Add New Task</strong></div>
                                                    <span class="d-flex text-muted">20Min ago</span>
                                                </div>
                                            </div>
                                        </div> <!-- timeline item end  --> --}}
                                        {{-- <div class="timeline-item ti-info border-bottom ms-2">
                                            <div class="d-flex">
                                                <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink">SP</span>
                                                <div class="flex-fill ms-3">
                                                    <div class="mb-1"><strong>Shipa Review Completed</strong></div>
                                                    <span class="d-flex text-muted">40Min ago</span>
                                                </div>
                                            </div>
                                        </div> <!-- timeline item end  --> --}}
                                        {{-- <div class="timeline-item ti-info border-bottom ms-2">
                                            <div class="d-flex">
                                                <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-careys-pink">MR</span>
                                                <div class="flex-fill ms-3">
                                                    <div class="mb-1"><strong>Mora Task To Completed</strong></div>
                                                    <span class="d-flex text-muted">1Hr ago</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="timeline-item ti-success  ms-2">
                                            <div class="d-flex">
                                                <span class="avatar d-flex justify-content-center align-items-center rounded-circle bg-lavender-purple">FL</span>
                                                <div class="flex-fill ms-3">
                                                    <div class="mb-1"><strong>Fila Add New Task</strong></div>
                                                    <span class="d-flex text-muted">1Day ago</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- .card: My Timeline --> --}}
                            {{-- </div>
                            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12">
                                <div class="card">
                                    <div class="card-header py-3">
                                        <h6 class="mb-0 fw-bold ">Allocated Task Members</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="flex-grow-1 mem-list">
                                            <div class="py-2 d-flex align-items-center border-bottom">
                                                
                                                <div class="d-flex ms-2 align-items-center flex-fill">
                                                    <img src="{{ url('/').'/images/xs/avatar6.jpg' }}" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                                    <div class="d-flex flex-column ps-2">
                                                        <h6 class="fw-bold mb-0">Lucinda Massey</h6>
                                                        <span class="small text-muted">Ui/UX Designer</span>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn light-danger-bg text-end" data-bs-toggle="modal" data-bs-target="#dremovetask">Remove</button>
                                            </div>
                                            <div class="py-2 d-flex align-items-center border-bottom">
                                                
                                                <div class="d-flex ms-2 align-items-center flex-fill">
                                                    <img src="{{ url('/').'/images/xs/avatar4.jpg' }}" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                                    <div class="d-flex flex-column ps-2">
                                                        <h6 class="fw-bold mb-0">Ryan Nolan</h6>
                                                        <span class="small text-muted">Website Designer</span>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn light-danger-bg text-end" data-bs-toggle="modal" data-bs-target="#dremovetask">Remove</button>
                                            </div>
                                            <div class="py-2 d-flex align-items-center border-bottom">
                                                
                                                <div class="d-flex ms-2 align-items-center flex-fill">
                                                    <img src="{{ url('/').'/images/xs/avatar9.jpg' }}" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                                    <div class="d-flex flex-column ps-2">
                                                        <h6 class="fw-bold mb-0">Oliver	Black</h6>
                                                        <span class="small text-muted">App Developer</span>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn light-danger-bg text-end" data-bs-toggle="modal" data-bs-target="#dremovetask">Remove</button>
                                            </div>
                                            <div class="py-2 d-flex align-items-center border-bottom">
                                                
                                                <div class="d-flex ms-2 align-items-center flex-fill">
                                                    <img src="{{ url('/').'/images/xs/avatar10.jpg' }}" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                                    <div class="d-flex flex-column ps-2">
                                                        <h6 class="fw-bold mb-0">Adam Walker</h6>
                                                        <span class="small text-muted">Quality Checker</span>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn light-danger-bg text-end">Remove</button>
                                            </div>
                                            <div class="py-2 d-flex align-items-center border-bottom">
                                                
                                                <div class="d-flex ms-2 align-items-center flex-fill">
                                                    <img src="{{ url('/').'/images/xs/avatar4.jpg' }}" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                                    <div class="d-flex flex-column ps-2">
                                                        <h6 class="fw-bold mb-0">Brian Skinner</h6>
                                                        <span class="small text-muted">Quality Checker</span>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn light-danger-bg text-end" data-bs-toggle="modal" data-bs-target="#dremovetask">Remove</button>
                                            </div>
                                            <div class="py-2 d-flex align-items-center border-bottom">
                                                
                                                <div class="d-flex ms-2 align-items-center flex-fill">
                                                    <img src="{{ url('/').'/images/xs/avatar11.jpg' }}" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                                    <div class="d-flex flex-column ps-2">
                                                        <h6 class="fw-bold mb-0">Dan Short</h6>
                                                        <span class="small text-muted">App Developer</span>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn light-danger-bg text-end" data-bs-toggle="modal" data-bs-target="#dremovetask">Remove</button>
                                            </div>
                                            <div class="py-2 d-flex align-items-center border-bottom">
                                                
                                                <div class="d-flex ms-2 align-items-center flex-fill">
                                                    <img src="{{ url('/').'/images/xs/avatar3.jpg' }}" class="avatar lg rounded-circle img-thumbnail" alt="avatar">
                                                    <div class="d-flex flex-column ps-2">
                                                        <h6 class="fw-bold mb-0">Jack Glover</h6>
                                                        <span class="small text-muted">Ui/UX Designer</span>
                                                    </div>
                                                </div>
                                                <button type="button" class="btn light-danger-bg text-end" data-bs-toggle="modal" data-bs-target="#dremovetask">Remove</button>
                                            </div>
                                        </div>
                                    </div> --}}
                                {{-- </div> <!-- .card: My Timeline --> --}}
                            {{-- </div>
                         </div> --}}



                         {{-- <div class="row taskboard g-3 py-xxl-4"> --}}


                         {{-- <div class="col-xxl-3 col-xl-12 col-lg-12 col-md-12 mt-xxl-4 mt-xl-4 mt-lg-4 mt-md-4 mt-sm-4 mt-4">
                                <h6 class="fw-bold py-3 mb-0">Task Ready</h6>
                                <div class="planned_task">
                                    <div class="dd" data-plugin="nestable">
                                        <ol class="dd-list">
                                            <li class="dd-item" data-id="1">
                                                <div class="dd-handle">
                                                    <div class="task-info d-flex align-items-center justify-content-between">
                                                        <h6 class="light-info-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">UI/UX Design</h6>
                                                        <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                            <div class="avatar-list avatar-list-stacked m-0">
                                                                <img class="avatar rounded-circle small-avt" src="{{ url('/').'/images/xs/avatar2.jpg' }}" alt="">
                                                                <img class="avatar rounded-circle small-avt" src="{{ url('/').'/images/xs/avatar1.jpg' }}" alt="">
                                                            </div>
                                                            <span class="badge bg-warning text-end mt-2">MEDIUM</span>
                                                        </div>
                                                    </div>
                                                    <p class="py-2 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id
                                                        nec scelerisque massa.</p>
                                                    <div class="tikit-info row g-3 align-items-center">
                                                        <div class="col-sm">
                                                            <ul class="d-flex list-unstyled align-items-center flex-wrap">
                                                                <li class="me-2">
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="icofont-flag"></i>
                                                                        <span class="ms-1">25 Nov</span>
                                                                    </div>
                                                                </li>
                                                                <li class="me-2">
                                                                    <div class="d-flex align-items-center">
                                                                        
                                                                            <i class="icofont-ui-text-chat"></i>
                                                                            <span class="ms-1">4</span>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="icofont-paper-clip"></i>
                                                                        <span class="ms-1">5</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-sm text-end">
                                                            <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small"> Social Geek Made </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </li>
                                            <li class="dd-item" data-id="2">
                                                <div class="dd-handle">
                                                    <div class="task-info d-flex align-items-center justify-content-between">
                                                        <h6 class="bg-lightgreen py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">Website Design
                                                        </h6>
                                                        <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                            <div class="avatar-list avatar-list-stacked m-0">
                                                                <img class="avatar rounded-circle small-avt" src="{{ url('/').'/images/xs/avatar7.jpg' }}" alt="">
                                                            </div>
                                                            <span class="badge bg-success text-end mt-2">LOW</span>
                                                        </div>
                                                    </div>
                                                    <p class="py-2 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id
                                                        nec scelerisque massa.</p>
                                                    <div class="tikit-info row g-3 align-items-center">
                                                        <div class="col-sm">
                                                            <ul class="d-flex list-unstyled align-items-center flex-wrap">
                                                                <li class="me-2">
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="icofont-flag"></i>
                                                                        <span class="ms-1">12 Feb</span>
                                                                    </div>
                                                                </li>
                                                                <li class="me-2">
                                                                    <div class="d-flex align-items-center">
                                                                        
                                                                            <i class="icofont-ui-text-chat"></i>
                                                                            <span class="ms-1">3</span>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="icofont-paper-clip"></i>
                                                                        <span class="ms-1">4</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-sm text-end">
                                                            
                                                            <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small"> Practice to Perfect </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </li>
                                            <li class="dd-item" data-id="3">
                                                <div class="dd-handle">
                                                    <div class="task-info d-flex align-items-center justify-content-between">
                                                        <h6 class="light-success-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">Quality Assurance
                                                        </h6>
                                                        <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                            <div class="avatar-list avatar-list-stacked m-0">
                                                                <img class="avatar rounded-circle small-avt" src="{{ url('/').'/images/xs/avatar2.jpg' }}" alt="">
                                                                <img class="avatar rounded-circle small-avt" src="{{ url('/').'/images/xs/avatar1.jpg' }}" alt="">
                                                            </div>
                                                            <span class="badge bg-warning text-end mt-2">MEDIUM</span>
                                                        </div>
                                                    </div>
                                                    <p class="py-2 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id
                                                        nec scelerisque massa.</p>
                                                    <div class="tikit-info row g-3 align-items-center">
                                                        <div class="col-sm">
                                                            <ul class="d-flex list-unstyled align-items-center flex-wrap">
                                                                <li class="me-2">
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="icofont-flag"></i>
                                                                        <span class="ms-1">17 Mar</span>
                                                                    </div>
                                                                </li>
                                                                <li class="me-2">
                                                                    <div class="d-flex align-items-center">
                                                                        
                                                                            <i class="icofont-ui-text-chat"></i>
                                                                            <span class="ms-1">15</span>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="icofont-paper-clip"></i>
                                                                        <span class="ms-1">1</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-sm text-end">
                                                            
                                                            <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small"> Box of Crayons </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </li>
                                            <li class="dd-item" data-id="4">
                                                <div class="dd-handle">
                                                    <div class="task-info d-flex align-items-center justify-content-between">
                                                        <h6 class="light-orange-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">Development
                                                        </h6>
                                                        <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                            <div class="avatar-list avatar-list-stacked m-0">
                                                                <img class="avatar rounded-circle small-avt" src="{{ url('/').'/images/xs/avatar6.jpg' }}" alt="">
                                                                <img class="avatar rounded-circle small-avt" src="{{ url('/').'/images/xs/avatar5.jpg' }}" alt="">
                                                            </div>
                                                            <span class="badge bg-warning text-end mt-2">MEDIUM</span>
                                                        </div>
                                                    </div>
                                                    <p class="py-2 mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In id
                                                        nec scelerisque massa.</p>
                                                    <div class="tikit-info row g-3 align-items-center">
                                                        <div class="col-sm">
                                                            <ul class="d-flex list-unstyled align-items-center flex-wrap">
                                                                <li class="me-2">
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="icofont-flag"></i>
                                                                        <span class="ms-1">28 Nov</span>
                                                                    </div>
                                                                </li>
                                                                <li class="me-2">
                                                                    <div class="d-flex align-items-center">
                                                                        
                                                                            <i class="icofont-ui-text-chat"></i>
                                                                            <span class="ms-1">45</span>
                                                                        
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="d-flex align-items-center">
                                                                        <i class="icofont-paper-clip"></i>
                                                                        <span class="ms-1">1</span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-sm text-end">
                                                            
                                                            <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small"> Gob Geeklords </div>
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>  --}}

                            
                            {{-- <div class="row taskboard g-3 py-xxl-4">
                                @foreach ($tasksByStatus as $status => $tasks)
                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 mt-xxl-4 mt-xl-4 mt-lg-4 mt-md-4 mt-sm-4 mt-4" data-status="{{ $status }}">
                                        <h6 class="fw-bold py-3 mb-0">
                                            @if($status == 1)
                                                In Progress
                                            @elseif($status == 2)
                                                Needs Review
                                            @elseif($status == 3)
                                                Completed
                                            @endif
                                        </h6>
                                        <div class="@if($status == 1) progress_task @elseif($status == 2) review_task @elseif($status == 3) completed_task @endif">
                                            <div class="task-section">
                                                <div class="dd" data-plugin="nestable" data-group="tasks">
                                                    <ol class="dd-list">
                                                        @if ($tasks->isNotEmpty())
                                                            @foreach ($tasks as $task)
                                                                <li class="dd-item" data-id="{{ $task->id }}">
                                                                    <div class="dd-handle">
                                                                        <!-- Task info markup -->
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
                                                            @endforeach
                                                        @else
                                                            {{-- Optionally show a message if no tasks --}}
                                                        {{-- @endif
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div> --}}

                            {{-- <div class="row taskboard g-3 py-xxl-4"> --}}
                                <!-- In Progress -->
                                {{-- <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 mt-xxl-4 mt-xl-4 mt-lg-4 mt-md-4 mt-sm-4 mt-4" data-status="1">
                                    <h6 class="fw-bold py-3 mb-0">In Progress</h6>
                                    <div class="progress_task">
                                        <div class="task-section">
                                            <div class="dd" data-plugin="nestable" data-group="tasks">
                                                <ol class="dd-list">
                                                    @foreach ($tasksByStatus[1] as $task)

                                                         @include('backend.includes.partials.task_item', ['task' => $task])
                                                    @endforeach
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            
                                <!-- Needs Review -->
                                {{-- <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 mt-xxl-4 mt-xl-4 mt-lg-4 mt-md-4 mt-sm-4 mt-4" data-status="2">
                                    <h6 class="fw-bold py-3 mb-0">Needs Review</h6>
                                    <div class="review_task">
                                        <div class="task-section">
                                            <div class="dd" data-plugin="nestable" data-group="tasks">
                                                <ol class="dd-list">
                                                    @foreach ($tasksByStatus[2] as $task)
                                                      
                                                        @include('backend.includes.partials.task-item',['task' => $task])
                                                    @endforeach
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            
                                <!-- Completed -->
                                {{-- <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-12 mt-xxl-4 mt-xl-4 mt-lg-4 mt-md-4 mt-sm-4 mt-4" data-status="3">
                                    <h6 class="fw-bold py-3 mb-0">Completed</h6>
                                    <div class="completed_task">
                                        <div class="task-section">
                                            <div class="dd" data-plugin="nestable" data-group="tasks">
                                                <ol class="dd-list">
                                                    @foreach ($tasksByStatus[3] as $task)
                                                    @include('backend.includes.partials.task-item',['task' => $task])
                                                    
                                                    @endforeach
                                                </ol>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end section task div--> --}}


                           <!-- Drag and Drop which works fine -->

                            {{-- 
                            <div class="task-card">
                                <div class="row taskboard g-3 py-xxl-4">
                            
                                    <!-- In Progress -->
                                    <div class="col-xxl-4" data-status="1">
                                        <h6 class="fw-bold py-3 mb-0">In Progress</h6>
                                        <ol class="dd-list">
                                            @if(isset($tasksByStatus[1]) && count($tasksByStatus[1]) > 0)
                                                @foreach ($tasksByStatus[1] as $task)
                                                    <li class="task-item" data-id="{{ $task->id }}">
                                                        @include('backend.includes.partials.task_item', ['task' => $task])
                                                    </li>
                                                @endforeach
                                            @else
                                            <p class="notask_drag">No tasks available</p>
                                            @endif
                                        </ol>
                                    </div>
                             
                                    <!-- Needs Review -->
                                    <div class="col-xxl-4" data-status="2">
                                        <h6 class="fw-bold py-3 mb-0">Needs Review</h6>
                                        <ol class="dd-list">
                                            @if(isset($tasksByStatus[2]) && count($tasksByStatus[2]) > 0)
                                                @foreach ($tasksByStatus[2] as $task)
                                                    <li class="task-item" data-id="{{ $task->id }}">
                                                        @include('backend.includes.partials.task_item', ['task' => $task])
                                                    </li>
                                                @endforeach
                                            @else
                                            <p class="notask_drag">No tasks available</p>
                                            @endif
                                        </ol>
                                    </div>
                             
                                    <!-- Completed -->
                                     <div class="col-xxl-4" data-status="3">
                                        <h6 class="fw-bold py-3 mb-0">Completed</h6>
                                        <ol class="dd-list">
                                            @if(isset($tasksByStatus[3]) && count($tasksByStatus[3]) > 0)
                                                @foreach ($tasksByStatus[3] as $task)
                                                    <li class="task-item" data-id="{{ $task->id }}">
                                                        @include('backend.includes.partials.task_item', ['task' => $task])
                                                    </li>
                                                @endforeach
                                            @else
                                                <p class="notask_drag">No tasks available</p>
                                            @endif
                                        </ol>
                                    </div>
                            
                                </div>
                            </div>  --}}
                            {{-- <div class="task-card">
                                <div class="row taskboard g-3 py-xxl-4">
                                    <!-- In Progress -->
                                    <div class="col-xxl-4" data-status="1">
                                        <h6 class="fw-bold py-3 mb-0">In Progress</h6>
                                        <ol class="dd-list">
                                            @if(isset($tasksByStatus[1]) && count($tasksByStatus[1]) > 0)
                                                @foreach ($tasksByStatus[1] as $task)
                                                    <li class="task-item" data-id="{{ $task->id }}">
                                                        @include('backend.includes.partials.task_item', ['task' => $task])
                                                    </li>
                                                @endforeach
                                            @else
                                                <div class="empty-state">
                                                    <p class="notask_drag">No tasks available</p>
                                                </div>
                                            @endif
                                        </ol>
                                    </div>
                            
                                    <!-- Needs Review -->
                                    <div class="col-xxl-4" data-status="2">
                                        <h6 class="fw-bold py-3 mb-0">Needs Review</h6>
                                        <ol class="dd-list">
                                            @if(isset($tasksByStatus[2]) && count($tasksByStatus[2]) > 0)
                                                @foreach ($tasksByStatus[2] as $task)
                                                    <li class="task-item" data-id="{{ $task->id }}">
                                                        @include('backend.includes.partials.task_item', ['task' => $task])
                                                    </li>
                                                @endforeach
                                            @else
                                                <div class="empty-state">
                                                    <p class="notask_drag">No tasks available</p>
                                                </div>
                                            @endif
                                        </ol>
                                    </div>
                            
                                    <!-- Completed -->
                                    <div class="col-xxl-4" data-status="3">
                                        <h6 class="fw-bold py-3 mb-0">Completed</h6>
                                        <ol class="dd-list">
                                            @if(isset($tasksByStatus[3]) && count($tasksByStatus[3]) > 0)
                                                @foreach ($tasksByStatus[3] as $task)
                                                    <li class="task-item" data-id="{{ $task->id }}">
                                                        @include('backend.includes.partials.task_item', ['task' => $task])
                                                    </li>
                                                @endforeach
                                            @else
                                                <div class="empty-state">
                                                    <p class="notask_drag">No tasks available</p>
                                                </div>
                                            @endif
                                        </ol>
                                    </div>
                                </div>
                            </div>
                          --}}

                          <!-- TEST CASE DRAH AND DROP  1 works fine -->

                          {{-- <div class="task-card">
                            <div class="row taskboard g-3 py-xxl-4">
                                <!-- In Progress -->
                                <div class="col-xxl-4" data-status="1">
                                    <h6 class="fw-bold py-3 mb-0">In Progress</h6>
                                    <ol class="dd-list">
                                        <li class="task-item" data-id="1">
                                            <div class="dd-handle edit-task-btn">
                                                <div class="task-info d-flex align-items-center justify-content-between">
                                                    <h6 class="light-success-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">
                                                        Report module
                                                    </h6>
                                                    <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                        <div class="avatar-list avatar-list-stacked m-0">
                                                            <img class="avatar rounded-circle small-avt" src="/images/xs/avatar2.jpg" alt="">
                                                            <img class="avatar rounded-circle small-avt" src="/images/xs/avatar1.jpg" alt="">
                                                        </div>
                                                        <span class="badge bg-warning text-end mt-2">Category</span>
                                                    </div>
                                                </div>
                                                <p class="py-2 mb-0">Create a billable non billable report section</p>
                                                <div class="tikit-info row g-3 align-items-center">
                                                    <div class="col-sm">
                                                        <ul class="d-flex list-unstyled align-items-center flex-wrap">
                                                            <li class="me-2">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="icofont-flag"></i>
                                                                    <span class="ms-1">21 March</span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm text-end">
                                                        <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small">
                                                            Project Name
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                        
                                <!-- Needs Review -->
                                <div class="col-xxl-4" data-status="2">
                                    <h6 class="fw-bold py-3 mb-0">Needs Review</h6>
                                    <ol class="dd-list">
                                        <div class="empty-state">
                                            <p class="notask_drag">No tasks available</p>
                                        </div>
                                    </ol>
                                </div>
                        
                                <!-- Completed -->
                                <div class="col-xxl-4" data-status="3">
                                    <h6 class="fw-bold py-3 mb-0">Completed</h6>
                                    <ol class="dd-list">
                                        <li class="task-item" data-id="2">
                                            <div class="dd-handle edit-task-btn">
                                                <div class="task-info d-flex align-items-center justify-content-between">
                                                    <h6 class="light-success-bg py-1 px-2 rounded-1 d-inline-block fw-bold small-14 mb-0">
                                                        Purchase return
                                                    </h6>
                                                    <div class="task-priority d-flex flex-column align-items-center justify-content-center">
                                                        <div class="avatar-list avatar-list-stacked m-0">
                                                            <img class="avatar rounded-circle small-avt" src="/images/xs/avatar2.jpg" alt="">
                                                            <img class="avatar rounded-circle small-avt" src="/images/xs/avatar1.jpg" alt="">
                                                        </div>
                                                        <span class="badge bg-warning text-end mt-2">Category</span>
                                                    </div>
                                                </div>
                                                <p class="py-2 mb-0">Working on purchase return CRUD module</p>
                                                <div class="tikit-info row g-3 align-items-center">
                                                    <div class="col-sm">
                                                        <ul class="d-flex list-unstyled align-items-center flex-wrap">
                                                            <li class="me-2">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="icofont-flag"></i>
                                                                    <span class="ms-1">15 March</span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm text-end">
                                                        <div class="small text-truncate light-danger-bg py-1 px-2 rounded-1 d-inline-block fw-bold small">
                                                            Project Name
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div> --}}


                        <div class="task-card">
                            <div class="row taskboard g-3 py-xxl-4">
                                <!-- In Progress -->
                                <div class="col-xxl-4" data-status="1">
                                    <h6 class="fw-bold py-3 mb-0">In Progress</h6>
                                    <ol class="dd-list">
                                        @if(isset($tasksByStatus[1]) && count($tasksByStatus[1]) > 0)
                                            @foreach ($tasksByStatus[1] as $task)
                                                <li class="task-item" data-id="{{ $task->id }}">
                                                    <div class="dd-handle edit-task-btn" 
                                                         data-id="{{ $task->id }}" 
                                                         data-project-id="{{ $task->project_id }}" 
                                                         data-bs-toggle="modal" 
                                                         data-bs-target="#edittask">
                                                        <div class="task-info d-flex align-items-center gap-3 justify-content-between">
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
                                                                    {{ $task->assignedUser->name ?? 'N/A' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <div class="empty-state">
                                                <p class="notask_drag">No tasks available</p>
                                            </div>
                                        @endif
                                    </ol>
                                </div>
                        
                                <!-- Needs Review -->
                                <div class="col-xxl-4" data-status="2">
                                    <h6 class="fw-bold py-3 mb-0">Needs Review</h6>
                                    <ol class="dd-list">
                                        @if(isset($tasksByStatus[2]) && count($tasksByStatus[2]) > 0)
                                            @foreach ($tasksByStatus[2] as $task)
                                                <li class="task-item" data-id="{{ $task->id }}">
                                                    <div class="dd-handle edit-task-btn" 
                                                         data-id="{{ $task->id }}" 
                                                         data-project-id="{{ $task->project_id }}" 
                                                         data-bs-toggle="modal" 
                                                         data-bs-target="#edittask">
                                                        <div class="task-info d-flex align-items-center gap-3 justify-content-between">
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
                                                                    {{ $task->assignedUser->name ?? 'N/A' }}

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <div class="empty-state">
                                                <p class="notask_drag">No tasks available</p>
                                            </div>
                                        @endif
                                    </ol>
                                </div>
                        
                                <!-- Completed -->
                                <div class="col-xxl-4" data-status="3">
                                    <h6 class="fw-bold py-3 mb-0">Completed</h6>
                                    <ol class="dd-list">
                                        @if(isset($tasksByStatus[3]) && count($tasksByStatus[3]) > 0)
                                            @foreach ($tasksByStatus[3] as $task)
                                                <li class="task-item" data-id="{{ $task->id }}">
                                                    <div class="dd-handle edit-task-btn" 
                                                         data-id="{{ $task->id }}" 
                                                         data-project-id="{{ $task->project_id }}" 
                                                         data-bs-toggle="modal" 
                                                         data-bs-target="#edittask">
                                                        <div class="task-info d-flex align-items-center gap-3 justify-content-between">
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
                                                                    {{ $task->assignedUser->name ?? 'N/A' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @else
                                            <div class="empty-state">
                                                <p class="notask_drag">No tasks available</p>
                                            </div>
                                        @endif
                                    </ol>
                                </div>
                            </div>
                        </div>


                            {{-- <div class="task-card">
                                <div class="row taskboard g-3 py-xxl-4">
                                    <!-- In Progress -->
                                    <div class="col-xxl-4" data-status="1">
                                        <h6 class="fw-bold py-3 mb-0">In Progress</h6>
                                        <ol class="dd-list">
                                            @if(isset($tasksByStatus[1]) && count($tasksByStatus[1]) > 0)
                                                @foreach ($tasksByStatus[1] as $task)
                                                    <li class="task-item" data-id="{{ $task->id }}">
                                                        @include('backend.includes.partials.task_item', ['task' => $task])
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="task-placeholder">No Tasks Available</li>
                                            @endif
                                        </ol>
                                    </div>
                            
                                    <!-- Needs Review -->
                                    <div class="col-xxl-4" data-status="2">
                                        <h6 class="fw-bold py-3 mb-0">Needs Review</h6>
                                        <ol class="dd-list">
                                            @if(isset($tasksByStatus[2]) && count($tasksByStatus[2]) > 0)
                                                @foreach ($tasksByStatus[2] as $task)
                                                    <li class="task-item" data-id="{{ $task->id }}">
                                                        @include('backend.includes.partials.task_item', ['task' => $task])
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="task-placeholder">No tasks available</li>
                                            @endif
                                        </ol>
                                    </div>
                            
                                    <!-- Completed -->
                                    <div class="col-xxl-4" data-status="3">
                                        <h6 class="fw-bold py-3 mb-0">Completed</h6>
                                        <ol class="dd-list">
                                            @if(isset($tasksByStatus[3]) && count($tasksByStatus[3]) > 0)
                                                @foreach ($tasksByStatus[3] as $task)
                                                    <li class="task-item" data-id="{{ $task->id }}">
                                                        @include('backend.includes.partials.task_item', ['task' => $task])
                                                    </li>
                                                @endforeach
                                            @else
                                                <li class="task-placeholder">No tasks available</li>
                                            @endif
                                        </ol>
                                    </div>
                                </div>
                            </div> --}}


                            
                            
                             
                          
                        </div>
                    </div>
            
            </div>
         </div> <!-- div body end -->
    </div>
    <!-- SCRIPT for working of edit and create task model -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    
    <script src="{{ asset('js/template.js') }}"></script>

            <!-- jQuery (Make sure this is loaded first) -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

            <!-- jQuery UI (Required for Sortable) -->
            <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
            
           <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

            <!-- Nestable Plugin -->
            {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Nestable/2012-10-15/jquery.nestable.min.js"></script> --}}

            <!-- SweetAlert (Make sure it's a script, not a link) -->
            {{-- <script src="{{ asset('sweetalaertcdn/sweetalert2@11.js') }}"></script> --}}

            {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

            <!-- Sweet alert link-->
            <script src = " {{ asset('js/sweetalert2@11.js')}}"></script>

            <!-- jQuery -->
            {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

            <!-- jQuery UI -->
            {{-- <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.min.js"></script> --}}
            {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css"> --}}

            <!-- Your Custom Task Script -->
            {{-- <script src="{{ asset('js/task.js') }}"></script> --}}

<script>

    $(document).ready(function() {
        console.log("jQuery Version:", jQuery.fn.jquery);  // Debugging
        console.log("jQuery UI Version:", $.ui);  // Debugging

        // Check if .sortable() is available
        if ($.fn.sortable) {
            $(".sortable").sortable();
        } else {
            console.error("jQuery UI Sortable is not available!");
        }
    });


    console.log("jQuery Version:", jQuery.fn.jquery);
console.log("jQuery UI Version:", $.ui);
console.log("Sortable Available:", !!$.fn.sortable);
</script>


<script>
    var editTaskRoute = "{{ route('admin.task.edit', ':id') }}"; // id is the placeholder for emplyoee id which is replaced further
</script>


<script>

    

// $(document).ready(function () {

// // When edit button is clicked
// $('.edit-task-btn').on('click', function () {

//     var taskId = $(this).data('id'); 
//     console.log(taskId);

//     // Generate the URL using the route name and employee ID
//     var url = editTaskRoute.replace(':id', taskId);
//      console.log(url);

//                 // Fetch Employee data via AJAX
//                 $.ajax({

//                     url: url, // Use the dynamically generated URL
//                     method: 'GET',
//                     success: function (response) {    // callback function that runs only if the request is successful.
//                         console.log(response);
//                         // Populate the modal form with the fetched data
//                         $('#edit_task_name').val(response.task_name ?? '');
//                         $('#edit_task_category').val(response.task_category ?? '');
//                         $('#edit_task_description').val(response.task_description ?? '');
//                         $('#edit_task_end_date').val(response.task_end_date ?? '');
//                         $('#edit_task_assigned_for').val(response.task_assigned_for ?? '');
                      
//                         $('#edit_task_estimation').val(response.task_estimation_hr ?? '');
                       
                
                        
//                         // Set the form action URL for updating
//                         $('#editTaskForm').attr('action', "{{ route('admin.task.update', ':id') }}".replace(':id', taskId));
                        
        

//                     },
//                     error: function (xhr) {
//                         console.error('Error fetching Employee data:', xhr.responseText);
//                     }

//                 });
//             });
//             });

            // $(document).ready(function () {
            //     $('.edit-task-btn').on('click', function () {
            //         var taskId = $(this).data('id');
            //         var url = editTaskRoute.replace(':id', taskId);

            //         $.ajax({
            //             url: url,
            //             method: 'GET',
            //             success: function (response) {
            //                 console.log(response); // Debugging

            //                 // Access the nested 'task' object in the response
            //                 var task = response.task;
            //                 // Format the date to 'yyyy-MM-dd'
            //                 var endDate = new Date(task.end_date).toISOString().split('T')[0];

            //                    // Debugging: Check the values of project_id and task_id
            //                 console.log('Project ID:', task.project_id);
            //                 console.log('Task ID:', task.id);

            //                 // console.log('Assigned For:', task.task_assigned_for); // Debugging
            //                 // console.log('Dropdown Options:', $('#edit_task_assigned_for').html()); // Debugging

            //                 // Populate the form fields
            //                 // Ensure these values are set in the form
            //                 $('#edit_project_id').val(task.project_id);
            //                 $('#edit_task_id').val(task.id);
            //                     // Debugging: Verify the hidden fields are set correctly
            //                 console.log('Form Project ID:', $('#edit_project_id').val());
            //                 console.log('Form Task ID:', $('#edit_task_id').val());
            //                 $('#edit_task_name').val(task.task_name ?? '');
            //                 $('#edit_task_category').val(task.task_category ?? '').trigger('change');
            //                 $('#edit_task_description').val(task.description ?? '');
            //                 $('#edit_task_end_date').val(task.end_date);
            //                 $('#edit_task_assigned_for').val(task.task_assigned_for).trigger('change');
            //                 $('#edit_task_estimation').val(task.estimation_hrs ?? '');

            //                 // Set the form action URL for updating
            //                 $('#editTaskForm').attr('action', "{{ route('admin.task.update', ':id') }}".replace(':id', task.id));
                            

            //                 // Ensure modal is shown after data is set
            //                 $('#edittask').modal('show');
            //             },
            //             error: function (xhr) {
            //                 console.error('Error fetching task data:', xhr.responseText);
            //             }
            //         });
            //     });
            // });

           
               //  Script to edit and update the Project values
               var editProjectRoute = "{{ route('admin.project.edit-project', ':id') }}"; // id is the placeholder for Project id which is replaced further
                $(document).ready(function () {

                    // When edit button is clicked
                    $('.edit-project-btn').on('click', function () {
                    
                        var projectId = $(this).data('id'); 
                        console.log(projectId);

                        // Generate the URL using the route name and Project ID
                        var url = editProjectRoute.replace(':id', projectId);
                        //  console.log(url);
                    
                        // Fetch Employee data via AJAX
                        $.ajax({

                            url: url, // Use the dynamically generated URL
                            method: 'GET',
                            success: function (response) {    // callback function that runs only if the request is successful.
                                console.log(response);
                                // Populate the modal form with the fetched data from db column
                                $('#proj_client').val(response.client);
                                $('#proj_name').val(response.project_name);
                                $('#proj_category').val(response.category);
                                $('#project_image').val(response.project_image);
                                $('#proj_manager').val(response.manager);
                                $('#proj_team_leader').val(response.team_leader);
                                // $('#teamMembersInput').val(response.team_members);
                                $('#proj_start_date').val(response.start_date);
                                $('#proj_end_date').val(response.end_date);
                                $('#proj_department').val(response.department);
                                $('#proj_status').val(response.status);
                                $('#proj_budget').val(response.budget);
                                $('#proj_priority').val(response.priority);
                                $('#proj_type').val(response.type);
                                $('#proj_estimation').val(response.estimation);
                                $('#proj_biiling_company').val(response.biiling_company);
                                $('#proj_description').val(response.description);
                                
                                console.log("Team Members from Response:", response.team_members);
                                prefillEditTeamMembers(response.team_members);

                                // Set the form action URL for updating
                                $('#editprojectform').attr('action', "{{ route('admin.project.update-project', ':id') }}".replace(':id', projectId));
                                
                                // Display the existing profile image
                                if (response.profile_image) {
                                    $('#proj_current-profile-image img')
                                        .attr('src', "{{ asset('') }}" + response.profile_image) // Set the image source
                                        .show(); // Show the image
                                } else {
                                    $('#proj_current-profile-image img').hide(); // Hide the image if no profile image exists
                                }

                                // Dynamically populate the Estimation Change Log table
                                populateEstimationChangeLogTable(response.estimation_change_logs);

                            },
                            error: function (xhr) {
                                console.error('Error fetching Project data:', xhr.responseText);
                            }

                        });
                    });
                });
            // Task edit AJAX code
            $(document).ready(function () {
                // When edit button is clicked
                $('.edit-task-btn').on('click', function () {
                    var taskId = $(this).data('id');
                    var url = editTaskRoute.replace(':id', taskId);

                    // Fetch Task data via AJAX
                    $.ajax({
                        url: url,
                        method: 'GET',
                        success: function (response) {
                            console.log('AJAX Response:', response); // Debugging

                            // Access the nested 'task' object in the response
                            var task = response.task;

                            // Debugging: Check the values of project_id and task_id
                            console.log('Project ID:', task.project_id);
                            console.log('Task ID:', task.id);

                            // Set the hidden fields
                            $('#edit_project_id').val(task.project_id);
                            $('#edit_task_id').val(task.id);

                            // Debugging: Verify the hidden fields are set correctly
                            console.log('Form Project ID:', $('#edit_project_id').val());
                            console.log('Form Task ID:', $('#edit_task_id').val());

                            // Populate other form fields
                            $('#edit_task_name').val(task.task_name ?? '');
                            $('#edit_task_category').val(task.task_category ?? '').trigger('change');
                            $('#edit_task_description').val(task.description ?? '');

                            // Format the date to 'yyyy-MM-dd'
                            var endDate = new Date(task.end_date).toISOString().split('T')[0];
                            $('#edit_task_end_date').val(endDate); // Set the formatted date

                            $('#edit_task_assigned_for').val(task.task_assigned_for).trigger('change');
                            $('#edit_task_estimation').val(task.estimation_hrs ?? '');

                            // Set the form action URL for updating
                            $('#editTaskForm').attr('action', "{{ route('admin.task.update', ':id') }}".replace(':id', task.id));

                            // Ensure modal is shown after data is set
                            $('#edittask').modal('show');
                        },
                        error: function (xhr) {
                            console.error('Error fetching task data:', xhr.responseText);
                        }
                    });
                });

                // Handle form submission
                $('#editTaskForm').on('submit', function (e) {
                    e.preventDefault(); // Prevent default form submission

                    // Debugging: Log the form action URL
                    console.log('Form Action URL:', $(this).attr('action'));

                    // Debugging: Log the form data
                    var formData = $(this).serialize();
                    console.log('Form Data:', formData);

                    // Submit the form via AJAX
                    $.ajax({
                        url: $(this).attr('action'),
                        method: 'PUT',
                        data: formData,
                        success: function (response) {
                            console.log('Task updated successfully:', response);
                            // Handle success (e.g., close modal, show success message)

                            
                            // Show SweetAlert2 pop-up
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Task updated successfully!',
                                showConfirmButton: false,
                                timer: 2000 // Auto-close after 2 seconds
                            });

                            // Close the edit modal
                            $('#edittask').modal('hide');

                            // Optionally, reload the page to reflect changes
                            setTimeout(function () {
                                location.reload();
                            }, 2000); // Reload after 2 seconds

                            $('#edittask').modal('hide');
                            // location.reload(); // Reload the page to reflect changes
                        },
                        error: function (xhr) {
                            console.error('Error updating task:', xhr.responseText);
                            // Handle error (e.g., show error message)
                        }
                    });
                });
            });
            
                    //     $(document).ready(function () {
        //     $('.edit-task-btn').on('click', function () {
        //         var taskId = $(this).data('id');
        //         var url = editTaskRoute.replace(':id', taskId);

        //         $.ajax({
        //             url: url,
        //             method: 'GET',
        //             success: function (response) {
        //                 console.log(response); // Debugging

        //                 // Access the nested 'task' object in the response
        //                 var task = response.task;

        //                 console.log('Assigned For:', task.task_assigned_for); // Debugging
        //                 console.log('Dropdown Options:', $('#edit_task_assigned_for').html()); // Debugging


        //                 // Populate the form fields
        //                 $('#edit_task_name').val(task.task_name ?? '');
        //                 $('#edit_task_category').val(task.task_category ?? '').trigger('change');

        //                 // Format the date to 'yyyy-MM-dd'
        //                 var end_date = new Date(task.end_date).toISOString().split('T')[0];
        //                 $('#edit_task_end_date').val(end_date); // Corrected variable name

        //                 // Set the assigned_for dropdown value
        //                 setTimeout(function() {
        //                 var assignedFor = String(task.task_assigned_for); // Ensure it's a string
        //                 var dropdown = $('#edit_task_assigned_for');

        //                 if (dropdown.find('option[value="' + assignedFor + '"]').length) {
        //                     dropdown.val(assignedFor).trigger('change');
        //                 } else {
        //                     console.warn('Assigned user ID not found in dropdown:', assignedFor);
        //                 }
        //             }, 500);


        //                 $('#edit_task_estimation').val(task.estimation_hrs ?? '');

        //                 // Set the form action URL for updating
        //                 $('#editTaskForm').attr('action', "{{ route('admin.task.update', ':id') }}".replace(':id', taskId));

        //                 // Ensure modal is shown after data is set
        //                 $('#edittask').modal('show');
        //             },
        //             error: function (xhr) {
        //                 console.error('Error fetching task data:', xhr.responseText);
        //             }
        //         });
        //     });
        // });

</script>


    <script>

        // JS to Display selected file
        document.getElementById('fileInput').addEventListener('change', function(event) {
                const fileList = event.target.files;
                const fileDisplay = document.getElementById('selectedFiles');
                
                if (fileList.length > 0) {
                    let output = '<ul class="list-group mt-2">';
                    for (let i = 0; i < fileList.length; i++) {
                        output += `<li class="list-group-item d-flex justify-content-between align-items-center">
                            ${fileList[i].name}
                            <span class="badge bg-secondary">${(fileList[i].size / 1024).toFixed(1)} KB</span>
                        </li>`;
                    }
                    output += '</ul>';
                    fileDisplay.innerHTML = output;
                } else {
                    fileDisplay.innerHTML = '<p class="text-muted">No files selected</p>';
                }
            });

// JS FOR DRAG AND DROP
// document.addEventListener('DOMContentLoaded', function () {
//         const fileInput = document.getElementById('fileInput');
//         const dropZone = document.getElementById('dropZone');
//         const selectedFilesDiv = document.getElementById('selectedFiles');

//         // Handle file selection
//         fileInput.addEventListener('change', function (e) {
//             const files = e.target.files;
//             displayFiles(files);
//         });

//         // Handle drag and drop
//         dropZone.addEventListener('dragover', function (e) {
//             e.preventDefault();
//             dropZone.style.backgroundColor = '#f8f9fa';
//         });

//         dropZone.addEventListener('dragleave', function (e) {
//             e.preventDefault();
//             dropZone.style.backgroundColor = '';
//         });

//         dropZone.addEventListener('drop', function (e) {
//             e.preventDefault();
//             dropZone.style.backgroundColor = '';
//             const files = e.dataTransfer.files;
//             fileInput.files = files; // Assign files to input
//             displayFiles(files);
//         });

//         // Display selected files
//         function displayFiles(files) {
//             selectedFilesDiv.innerHTML = ''; // Clear previous files
//             if (files.length > 0) {
//                 const fileList = document.createElement('ul');
//                 fileList.className = 'list-group';
//                 for (let i = 0; i < files.length; i++) {
//                     const fileItem = document.createElement('li');
//                     fileItem.className = 'list-group-item';
//                     fileItem.textContent = files[i].name;
//                     fileList.appendChild(fileItem);
//                 }
//                 selectedFilesDiv.appendChild(fileList);
//             }
//         }
//     });



// document.addEventListener('DOMContentLoaded', function () {
//     const fileInput = document.getElementById('fileInput');
//     const dropZone = document.getElementById('dropZone');
//     const selectedFilesDiv = document.getElementById('selectedFiles');
//     const uploadForm = document.getElementById('uploadForm');

//     // Handle file selection
//     fileInput.addEventListener('change', function (e) {
//         const files = e.target.files;
//         displayFiles(files);
//     });

//     // Handle drag and drop
//     dropZone.addEventListener('dragover', function (e) {
//         e.preventDefault();
//         dropZone.style.backgroundColor = '#f8f9fa';
//     });

//     dropZone.addEventListener('dragleave', function (e) {
//         e.preventDefault();
//         dropZone.style.backgroundColor = '';
//     });

//     dropZone.addEventListener('drop', function (e) {
//         e.preventDefault();
//         dropZone.style.backgroundColor = '';
//         const files = e.dataTransfer.files;

//         // Assign files to the file input
//         const dataTransfer = new DataTransfer();
//         for (let file of files) {
//             dataTransfer.items.add(file);
//         }
//         fileInput.files = dataTransfer.files;

//         displayFiles(files);
//     });

//     // Display selected files
//     function displayFiles(files) {
//         selectedFilesDiv.innerHTML = ''; // Clear previous files
//         if (files.length > 0) {
//             const fileList = document.createElement('div');
//             fileList.className = 'file-list';

//             for (let i = 0; i < files.length; i++) {
//                 const fileItem = document.createElement('div');
//                 fileItem.className = 'file-item';

//                 // File icon
//                 const fileIcon = document.createElement('i');
//                 fileIcon.className = 'file-icon icofont-file';
//                 fileItem.appendChild(fileIcon);

//                 // File name
//                 const fileName = document.createElement('span');
//                 fileName.className = 'file-name';
//                 fileName.textContent = files[i].name;
//                 fileItem.appendChild(fileName);

//                 // Remove button
//                 const removeBtn = document.createElement('button');
//                 removeBtn.className = 'remove-btn';
//                 removeBtn.innerHTML = '<i class="icofont-close"></i>';
//                 removeBtn.addEventListener('click', function () {
//                     fileItem.remove();
//                     removeFileFromInput(files[i]);
//                 });
//                 fileItem.appendChild(removeBtn);

//                 fileList.appendChild(fileItem);
//             }

//             selectedFilesDiv.appendChild(fileList);
//         }
//     }

//     // Remove file from the file input
//     function removeFileFromInput(fileToRemove) {
//         const dataTransfer = new DataTransfer();
//         const files = fileInput.files;

//         for (let i = 0; i < files.length; i++) {
//             if (files[i] !== fileToRemove) {
//                 dataTransfer.items.add(files[i]);
//             }
//         }

//         fileInput.files = dataTransfer.files;
//     }

//     // Handle form submission via AJAX
//     uploadForm.addEventListener('submit', function (e) {
//         e.preventDefault();

//         const formData = new FormData(uploadForm);

//         fetch(uploadForm.action, {
//             method: 'POST',
//             body: formData,
//             headers: {
//                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
//             }
//         })
//         .then(response => response.json())
//         .then(data => {
//             if (data.success) {
//                 // Show SweetAlert success message
//                 Swal.fire({
//                     icon: 'success',
//                     title: 'Files Uploaded!',
//                     text: 'Your files have been uploaded successfully.',
//                 });

//                 // Clear selected files
//                 fileInput.value = '';
//                 selectedFilesDiv.innerHTML = '';

//                 // Refresh uploaded files section
//                 fetchUploadedFiles();
//             } else {
//                 Swal.fire({
//                     icon: 'error',
//                     title: 'Error',
//                     text: 'There was an error uploading your files.',
//                 });
//             }
//         })
//         .catch(error => {
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Error',
//                 text: 'There was an error uploading your files.',
//             });
//         });
//     });

//     // Fetch uploaded files and update the UI
//     function fetchUploadedFiles() {
//     const projectId = document.querySelector('input[name="project_id"]').value;
//     fetch(`/admin/task-asset/fetch/${projectId}`)
//         .then(response => response.text())
//         .then(html => {
//             document.getElementById('uploadedFiles').innerHTML = html;
//         });
// }
// }); 





       console.log(jQuery.fn.jquery);

               // JS for Auto row addition under internal docs
            //    document.addEventListener("DOMContentLoaded", function () {
            //     let table = document.getElementById("internalDocsTable").getElementsByTagName("tbody")[0];

            //     let taskBtn = document.getElementById("showTasks");
            //     let internalDocsBtn = document.getElementById("showInternalDocs");
            //     let assetsBtn = document.getElementById("showAssets");

            //     let taskSection = document.getElementById("taskSection");
            //     let internalDocsSection = document.getElementById("internalDocsSection");
            //     let assetsSection = document.getElementById("assetsSection");

            //     // Ensure Task section is visible by default
            //     taskSection.style.display = "block";
            //     internalDocsSection.style.display = "none";
            //     assetsSection.style.display = "none";

            //     //   // Get success message
            //     //     let successMessage = document.querySelector('.alert-success');

            //     // // If success message exists, show Internal Docs Section
            //     // if (successMessage) {
            //     //     taskSection.style.display = "none";
            //     //     internalDocsSection.style.display = "block";
            //     //     assetsSection.style.display = "none";

            //     //     // Show success message as SweetAlert pop-up
            //     //     Swal.fire({
            //     //         icon: 'success',
            //     //         title: 'Success!',
            //     //         text: successMessage.textContent,
            //     //         confirmButtonText: 'OK'
            //     //     });
            //     // }


            //     // Tab click event listeners
            //     taskBtn.addEventListener("click", function () {
            //         taskSection.style.display = "block";
            //         internalDocsSection.style.display = "none";
            //         assetsSection.style.display = "none";
            //     });

            //     internalDocsBtn.addEventListener("click", function () {
            //         internalDocsSection.style.display = "block";
            //         taskSection.style.display = "none";
            //         assetsSection.style.display = "none";
            //     });

            //     assetsBtn.addEventListener("click", function () {
            //         assetsSection.style.display = "block";
            //         taskSection.style.display = "none";
            //         internalDocsSection.style.display = "none";
            //     });

            //     // Function to get the next row index correctly
            //     function getRowIndex() {
            //         return table.getElementsByTagName("tr").length + 1;
            //     }

            //     // Function to add a new row dynamically
            //     function addNewRow() {
            //         let newIndex = getRowIndex();

            //         let newRow = document.createElement("tr");
            //         newRow.innerHTML = `
            //             <!-- Si.No and Hidden ID in the same <td> -->
            //             <td>
            //                 ${newIndex}
            //                 <input type="hidden" name="id[]" value="">
            //             </td>
            //             <td><input type="date" class="form-control" name="date[]"></td>
            //             <td><input type="text" class="form-control" name="title[]"></td>
            //             <td><input type="text" class="form-control" name="link[]"></td>
            //             <td><input type="text" class="form-control" name="comments[]"></td>
            //             <td>
            //                 <button type="button" class="btn btn-success btn-sm add-row">+</button>
            //                 <button type="button" class="btn btn-danger btn-sm remove-row">-</button>
            //             </td>
            //         `;

            //         table.appendChild(newRow);
            //     }

            //     // Function to remove a row (except the first one)
            //     function removeRow(event) {
            //         let row = event.target.closest("tr");
            //         let rows = table.getElementsByTagName("tr");

            //         if (rows.length > 1) {
            //             row.remove();
            //             updateRowNumbers();
            //         }
            //     }

            //     // Function to update row numbering after deletion
            //     function updateRowNumbers() {
            //         let rows = table.getElementsByTagName("tr");
            //         for (let i = 0; i < rows.length; i++) {
            //             rows[i].getElementsByTagName("td")[0].innerText = i + 1;
            //         }
            //     }

            //     // Event listener for add & remove row buttons
            //     table.addEventListener("click", function (event) {
            //         if (event.target.classList.contains("add-row")) {
            //             addNewRow();
            //         } else if (event.target.classList.contains("remove-row")) {
            //             removeRow(event);
            //         }
            //     });

            // });


            document.addEventListener("DOMContentLoaded", function () {
                let table = document.getElementById("internalDocsTable").getElementsByTagName("tbody")[0];

                let taskBtn = document.getElementById("showTasks");
                let internalDocsBtn = document.getElementById("showInternalDocs");
                let assetsBtn = document.getElementById("showAssets");

                let taskSection = document.getElementById("taskSection");
                let internalDocsSection = document.getElementById("internalDocsSection");
                let assetsSection = document.getElementById("assetsSection");

                // Ensure Task section is visible by default
                taskSection.style.display = "block";
                internalDocsSection.style.display = "none";
                assetsSection.style.display = "none";

                // Tab click event listeners
                taskBtn.addEventListener("click", function () {
                    taskSection.style.display = "block";
                    internalDocsSection.style.display = "none";
                    assetsSection.style.display = "none";
                });

                internalDocsBtn.addEventListener("click", function () {
                    internalDocsSection.style.display = "block";
                    taskSection.style.display = "none";
                    assetsSection.style.display = "none";
                });

                assetsBtn.addEventListener("click", function () {
                    assetsSection.style.display = "block";
                    taskSection.style.display = "none";
                    internalDocsSection.style.display = "none";
                });

                // Function to get the next row index correctly
                function getRowIndex() {
                    return table.getElementsByTagName("tr").length + 1;
                }

                 // Function to add a new row dynamically
                    function addNewRow() {
                        let newIndex = table.getElementsByTagName("tr").length + 1;

                        let newRow = document.createElement("tr");
                        newRow.innerHTML = `
                            <td>
                                ${newIndex}
                                <input type="hidden" name="id[]" value=""> <!-- Ensure id[] is always present -->
                            </td>
                            <td><input type="date" class="form-control" name="date[]"></td>
                            <td><input type="text" class="form-control" name="title[]"></td>
                            <td><input type="text" class="form-control" name="link[]"></td>
                            <td><input type="text" class="form-control" name="comments[]"></td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm add-row">+</button>
                                <button type="button" class="btn btn-danger btn-sm remove-row">-</button>
                            </td>
                        `;

                        table.appendChild(newRow);
                    }

                    // Function to remove a row
                    function removeRow(event) {
                        let row = event.target.closest("tr");
                        let rows = table.getElementsByTagName("tr");

                        if (rows.length > 1) {
                            // Add a hidden input to mark this row as deleted
                            let idInput = row.querySelector("input[name='id[]']");
                            if (idInput && idInput.value) {
                                let deleteInput = document.createElement("input");
                                deleteInput.type = "hidden";
                                deleteInput.name = "deleted_ids[]";
                                deleteInput.value = idInput.value; // Use the value of id[]
                                row.appendChild(deleteInput);
                            }

                            // Hide the row instead of removing it immediately
                            row.style.display = "none";
                        }

                        updateRowNumbers();
                    }

                    // Function to update row numbering after deletion
                    function updateRowNumbers() {
                        let rows = table.getElementsByTagName("tr");
                        for (let i = 0; i < rows.length; i++) {
                            if (rows[i].style.display !== "none") {
                                rows[i].getElementsByTagName("td")[0].innerText = i + 1;
                            }
                        }
                    }

                    // Event listener for add & remove row buttons
                    table.addEventListener("click", function (event) {
                        if (event.target.classList.contains("add-row")) {
                            addNewRow();
                        } else if (event.target.classList.contains("remove-row")) {
                            removeRow(event);
                        }
                    });

                                });



         

            // JS  to preview files before uploading.
        //     document.getElementById('fileInput').addEventListener('change', function(event) {
        //     let files = event.target.files;
        //     let previewContainer = document.getElementById('uploadedFiles');
        //     previewContainer.innerHTML = ''; // Clear previous previews

        //     for (let file of files) {
        //         let fileDiv = document.createElement('div');
        //         fileDiv.className = 'file-preview d-flex flex-column align-items-center p-3 shadow-sm rounded bg-light position-relative';
                
        //         let icon = document.createElement('i');
        //         icon.className = 'icofont-file-alt display-6 text-muted';
                
        //         let fileName = document.createElement('p');
        //         fileName.className = 'small text-truncate w-100 text-center mt-2';
        //         fileName.innerText = file.name;
                
        //         fileDiv.appendChild(icon);
        //         fileDiv.appendChild(fileName);
        //         previewContainer.appendChild(fileDiv);
        //     }
        // });
 
                   // Drag and Drop JS
                //    $(document).ready(function () {
                //     $(".dd").nestable({
                //         group: "tasks"
                //     }).on("change", function (event) {
                //         let draggedItem = $(event.target).find(".dd-item").last(); // Get the last dragged item
                //         let taskId = draggedItem.data("id");
                //         let newStatus = $(this).closest("[data-status]").attr("data-status");

                //         if (taskId && newStatus) {
                //             updateTaskStatus(taskId, newStatus, draggedItem);
                //         }
                //     });

                //     function updateTaskStatus(taskId, newStatus, draggedItem) {
                //         $.ajax({
                //             url: "/update-task-status",
                    
                //             type: "POST",
                //             data: {
                //                 task_id: taskId,
                //                 status: newStatus,
                //                 _token: $('meta[name="csrf-token"]').attr("content")
                //             },
                //             success: function (response) {
                //                 console.log("Task status updated successfully");

                //                 // Move the task visually to the new section
                //                 let targetList = $('.col-xxl-4[data-status="' + newStatus + '"] .dd-list');
                //                 if (targetList.length) {
                //                     targetList.append(draggedItem);
                //                 }
                //             },
                //             error: function (xhr) {
                //                 console.error("Error updating task status:", xhr.responseText);
                //             }
                //         });
                //     }
                // });



          
                // JS to download the asset
                document.addEventListener('DOMContentLoaded', function () {
                // Add event listeners to all download buttons
                document.querySelectorAll('.download-btn').forEach(function (button) {
                    button.addEventListener('click', function () {
                        // Get the file path from the data attribute
                        const filePath = this.getAttribute('data-file-path');

                        // Create a temporary anchor element to trigger the download
                        const link = document.createElement('a');
                        link.href = filePath;
                        link.download = filePath.split('/').pop(); // Set the filename for the download
                        document.body.appendChild(link);
                        link.click();
                        document.body.removeChild(link);
                    });
                });
            });

                     
            // Old drag and drop works fine  
            // $(document).ready(function() {
            //     $('.dd-list').sortable({
            //         connectWith: '.dd-list',
            //         update: function(event, ui) {
            //             var taskId = ui.item.data('id');
            //             var newStatus = ui.item.closest('.col-xxl-4').data('status');

            //             console.log('Task ID:', taskId);
            //             console.log('New Status:', newStatus);

            //             $.ajax({
            //                 url: "{{ route('admin.task.updateStatus') }}",
            //                 method: 'POST',
            //                 data: {
            //                     task_id: taskId,
            //                     status: newStatus,
            //                     _token: '{{ csrf_token() }}'
            //                 },
            //                 success: function(response) {
            //                     console.log('Task status updated successfully');
            //                     console.log(response);
            //                 },
            //                 error: function(xhr) {
            //                     console.log('Error updating task status');
            //                     console.log(xhr.responseText);
            //                 }
            //             });
            //         }
            //     });
            // });


                    //             $(document).ready(function() {
                    //     $('.dd-list').sortable({
                    //         connectWith: '.dd-list',
                    //         items: '> .task-item',
                    //         update: function(event, ui) {
                    //             var taskId = ui.item.data('id');
                    //             var newStatus = ui.item.closest('.col-xxl-4').data('status');

                    //             console.log('Task ID:', taskId);
                    //             console.log('New Status:', newStatus);

                    //             $.ajax({
                    //                 url: "{{ route('admin.task.updateStatus') }}",
                    //                 method: 'POST',
                    //                 data: {
                    //                     task_id: taskId,
                    //                     status: newStatus,
                    //                     _token: '{{ csrf_token() }}'
                    //                 },
                    //                 success: function(response) {
                    //                     console.log('Task status updated successfully');
                    //                     console.log(response);

                    //                     // Hide/show empty state message
                    //                     var list = ui.item.closest('.dd-list');
                    //                     if (list.find('.task-item').length > 0) {
                    //                         list.find('.empty-state').hide();
                    //                     } else {
                    //                         list.find('.empty-state').show();
                    //                     }
                    //                 },
                    //                 error: function(xhr) {
                    //                     console.log('Error updating task status');
                    //                     console.log(xhr.responseText);
                    //                 }
                    //             });
                    //         }
                    //     });
                    // });

                    //  Test Case Drag and DROP JS
                    $(document).ready(function() {
                    console.log("Script loaded!"); // Check if this appears in the console

                    $('.dd-list').sortable({
                        connectWith: '.dd-list',
                        items: '> .task-item',
                        update: function(event, ui) {
                            var taskId = ui.item.data('id');
                            var newStatus = ui.item.closest('.col-xxl-4').data('status');

                            console.log('Task ID:', taskId);
                            console.log('New Status:', newStatus);

                            $.ajax({
                                url: "{{ route('admin.task.updateStatus') }}",
                                method: 'POST',
                                data: {
                                    task_id: taskId,
                                    status: newStatus,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(response) {
                                    console.log('Task status updated successfully');
                                    console.log(response);

                                    // Hide/show empty state message
                                    var list = ui.item.closest('.dd-list');
                                    if (list.find('.task-item').length > 0) {
                                        list.find('.empty-state').hide();
                                    } else {
                                        list.find('.empty-state').show();
                                    }
                                },
                                error: function(xhr) {
                                    console.log('Error updating task status');
                                    console.log(xhr.responseText);
                                }
                            });
                        }
                    });
                });



console.log("Number of .dd-list elements:", $(".dd-list").length);
console.log("Number of task items:", $(".dd-item").length);

    
    </script>

{{--     
<script>

    var editTaskRoute = "{{ route('admin.task-edit', ':id') }}"; // id is the placeholder for emplyoee id which is replaced further
  
</script> --}}

    <script>
     
               //----- AJAX for Task Add Modal form to show validation error---
      $(document).ready(function () {
        // Handle form submission
        $('#createtaskform').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission

            var form = $(this);
            var url = form.attr('action');
            var formData = new FormData(form[0]); // Capture all form data

            // Clear previous errors
            $('.text-danger').html('');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Prevent jQuery from setting content type
                success: function (response) {
                    alert('Task added successfully!');
                    $('#createtask').modal('hide');

                    // Get project ID from form input
                    var projectId = $('#createtaskform').find('input[name="project_id"]').val();

                    // Redirect using Laravel's route() helper
                    window.location.href = "{{ route('admin.tasks.byProject', ':id') }}".replace(':id', projectId);
                },
                error: function (xhr) {
                    // Handle validation errors
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        var errors = xhr.responseJSON.errors;
                        $.each(errors, function (key, value) {
                            $('#task-error-' + key).html(value[0]); // Correct error display // Show first error message under respective field
                        });
                    } else {
                        console.error('Unexpected error:', xhr.responseText);
                        alert('An unexpected error occurred. Please check the console.');
                    }
                }
            });
        });
    });

                //----- AJAX for Task-edit Validation form Modal -----

                    $(document).ready(function () {
                    // Handle form submission
                    $('#editTaskForm').on('submit', function (e) {
                        e.preventDefault(); // Prevent default form submission

                        // Clear previous error messages
                        $('.text-danger').text('');

                        // Submit the form via AJAX
                        $.ajax({
                            url: $(this).attr('action'),
                            method: 'PUT',
                            data: $(this).serialize(),
                            success: function (response) {
                                // console.log('Task updated successfully:', response);

                                // Close the edit modal
                                $('#edittask').modal('hide');

                                // Optionally, reload the page to reflect changes
                                setTimeout(function () {
                                    location.reload();
                                }, 2000); // Reload after 2 seconds
                            },
                            error: function (xhr) {
                                console.error('Error updating task:', xhr.responseText);

                                // Handle validation errors
                                if (xhr.status === 422) {
                                    var errors = xhr.responseJSON.errors;

                                    // Loop through the errors and display them in the form
                                    $.each(errors, function (field, messages) {
                                        var errorField = $('#task_edit-error-' + field);
                                        if (errorField.length) {
                                            errorField.text(messages[0]); // Display the first error message
                                        }
                                    });
                                } else {
                                    // Handle other errors (e.g., server errors)
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error!',
                                        text: 'An error occurred while updating the task.',
                                    });
                                }
                            }
                        });
                    });
                });


    </script>




@endsection
