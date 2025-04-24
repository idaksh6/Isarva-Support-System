
@extends('backend.layouts.app')

@section('title', __('Add Daily Report | Isarva Support'))

@section('content')






  <form id="dailyreportform" action="{{ route('admin.daily-reports.store') }}" method="POST">
      @csrf
      <input type="hidden" name="user_id" value="{{ Auth::id() }}">

      <div class="main-container">
        <!-- Dynamic Containers Section -->
        <div class="header-container">
          <h3 class="header-title">ADD DAILY REPORT</h3>
        </div>

        @if (session()->has('flash_success_dailyreport'))
        <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
            <i class="bi bi-check-circle-fill me-2 text-success"></i> 
            <span>{{ session('flash_success_dailyreport') }}</span>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

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

        <div id="dynamic-containers">
          @foreach(old('type', [1]) as $index => $type)  <!-- $index is a variable that represents the unique identifier for each container.-->
            <div class="report-container">
              <div class="dropdown-section">
                <label for="report-type" style="color: white;">Report Type:</label>
                <select id="report-type-{{ $index }}" class="report-type" name="type[{{ $index }}]" onchange="handleReportTypeChange(this)">
                  <option value="0" {{ old('type.' . $index) == '0' ? 'selected' : '' }}>None</option>
                  <option value="1" {{ old('type.' . $index) == '1' ? 'selected' : '' }}>Project</option>
                  <option value="2" {{ old('type.' . $index) == '2' ? 'selected' : '' }}>Ticket</option>
                </select>
                @if ($errors->has('type.' . $index))
                  <p class="error-message">{{ $errors->first('type.' . $index) }}</p>
                @endif
              </div>

            <!-- Project and Task Fields -->
              <div class="project-fields" style="{{ old('type.' . $index) == '1' ? 'display: block;' : 'display: none;' }}">
                <!-- Project Name Field -->
                <div class="project-search-container">
                    <input 
                        type="text" 
                        class="project-name @error('project_name.'.$index) is-invalid @enderror" 
                        name="project_name[{{ $index }}]" 
                        placeholder="Project Name" 
                        oninput="searchProjects(this)" 
                        autocomplete="off" 
                        value="{{ old('project_name.' . $index, '') }}"
                    >
                    <input type="hidden" id="project-id-{{ $index }}" name="project_id[{{ $index }}]" value="{{ old('project_id.' . $index, '') }}">
                    <!-- Dropdown will appear below -->
                    <div class="project-dropdown" style="display: none;"></div>
                    
                    @error('project_name.'.$index)
                        <p class="error-message project-error">{{ $message }}</p>
                    @enderror
                    @error('project_id.'.$index)
                        <p class="error-message project-error">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Task Name Field -->
                <div class="task-search-container">
                    <input 
                        type="text" 
                        class="task-name @error('task_name.'.$index) is-invalid @enderror" 
                        name="task_name[{{ $index }}]" 
                        placeholder="Task Name" 
                        oninput="searchTasks(this)" 
                        autocomplete="off" 
                        value="{{ old('task_name.' . $index, '') }}"
                    >
                    <input type="hidden" id="task-id-{{ $index }}" name="task_id[{{ $index }}]" value="{{ old('task_id.' . $index, '') }}">
                    <!-- Dropdown will appear below -->
                    <div class="task-dropdown" style="display: none;"></div>
                    
                    @error('task_name.'.$index)
                        <p class="error-message task-error">{{ $message }}</p>
                    @enderror
                    @error('task_id.'.$index)
                        <p class="error-message task-error">{{ $message }}</p>
                    @enderror
                </div>
              </div>


              <div class="ticket-field" style="{{ old('type.' . $index) == '2' ? 'display: block;' : 'display: none;' }}">
                <div class="ticket-search-container">
                    <input 
                        type="text" 
                        class="ticket-name @error('ticket-name.'.$index) is-invalid @enderror" 
                        name="ticket-name[{{ $index }}]" 
                        placeholder="Search Ticket..." 
                        oninput="searchTickets(this)" 
                        autocomplete="off" 
                        value="{{ old('ticket-name.' . $index, '') }}"
                    >
                    <input type="hidden" id="ticket-id-{{ $index }}" name="ticket_id[{{ $index }}]" value="{{ old('ticket_id.' . $index, '') }}">
                    <!-- Dropdown will appear below -->
                    <div class="ticket-dropdown" style="display: none;"></div>
                    
                <!-- In ticket fields section -->
                  @error('ticket-name.'.$index)
                      <p class="error-message ticket-error">{{ $message }}</p>
                  @enderror
                  @error('ticket_id.'.$index)
                        <p class="error-message ticket-error">{{ $message }}</p>
                  @enderror

                </div>
            </div>

              <!-- Common Fields -->
              <div class="common-fields">
                <textarea class="comments" name="comments[{{ $index }}]" placeholder="Comments">{{ old('comments.' . $index, '') }}</textarea>
                @if ($errors->has('comments.' . $index))
                  <p class="error-message">{{ $errors->first('comments.' . $index) }}</p>
                @endif

                <!-- Hours Field -->
                <input type="number" class="hrs" name="hrs[{{ $index }}]" placeholder="Hrs" oninput="updateTotalHrs()" value="{{ old('hrs.' . $index, '') }}">
                @if ($errors->has('hrs.' . $index))
                  <p class="error-message">{{ $errors->first('hrs.' . $index) }}</p>
                @endif

                <input type="text" class="link" name="link[{{ $index }}]" placeholder="Link" value="{{ old('link.' . $index, '') }}">
                @if ($errors->has('link.' . $index))
                  <p class="error-message">{{ $errors->first('link.' . $index) }}</p>
                @endif

                <select class="billable" name="billable[{{ $index }}]">
                  <option value="0" {{ old('billable.' . $index) == '0' ? 'selected' : '' }}>Non Billable</option>
                  <option value="1" {{ old('billable.' . $index) == '1' ? 'selected' : '' }}>Billable</option>
                  <option value="2" {{ old('billable.' . $index) == '2' ? 'selected' : '' }}>Internal Billable</option>
                </select>
                @if ($errors->has('billable.' . $index))
                  <p class="error-message">{{ $errors->first('billable.' . $index) }}</p>
                @endif

              </div>
         

                <div class="action-buttons">
                  <button type="button" class="btn-circle add-btn" onclick="addContainer()" title="Add">
                    <i class="icofont-plus-circle"></i>
                  <button type="button" class="btn-circle remove-btn" onclick="removeContainer(this)" title="Remove">
                    <i class="icofont-minus-circle"></i>
                  </button>
                </div>
                
            </div>
          @endforeach
        </div>

        <!-- Summary Container -->

        
      

        <div class="summary-container">

          {{-- <div class="form-group">
            <label for="creation_date">Date of Creation:</label>
            <input type="date" class="form-control" name="creation_date" id="creation_date" 
                   value="{{ old('creation_date', date('Y-m-d')) }}">
            @if ($errors->has('creation_date'))
                <p class="error-message">{{ $errors->first('creation_date') }}</p>
            @endif
           </div> --}}
           
          <div class="total-hrs">
            <label for="total-hrs">Total Hrs:</label>
            <input type="text" id="total-hrs" name="total_hrs" readonly value="{{ old('total_hrs', '') }}">
            @if ($errors->has('total_hrs'))
              <p class="error-message">{{ $errors->first('total_hrs') }}</p>
            @endif
          </div>
          <div class="overall-status">
            <label for="overall-status">Overall Status:</label>
            <textarea id="overall-status" name="overall_status" placeholder="Overall Status">{{ old('overall_status', '') }}</textarea>
            @if ($errors->has('overall_status'))
              <p class="error-message">{{ $errors->first('overall_status') }}</p>
            @endif
          </div>
        </div>

        <!-- Submit Button -->
        <div class="subbtn">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
  </form>

  



@endsection

    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src= {{ asset('js/jquery-3.6.0.min.js')}}></script>

<script>


        // JS to handle the dailyreport project,task,ticket search
        function handleReportTypeChange(selectElement) {
        const container = selectElement.closest('.report-container');
        const projectFields = container.querySelector('.project-fields');
        const ticketField = container.querySelector('.ticket-field');

        if (selectElement.value === '1') {
            projectFields.style.display = 'block';
            ticketField.style.display = 'none';
            // Clear ticket fields
            ticketField.querySelector('.ticket-name').value = '';
            ticketField.querySelector('[name^="ticket_id"]').value = '';
        } else if (selectElement.value === '2') {
            projectFields.style.display = 'none';
            ticketField.style.display = 'block';
            // Clear project fields
            projectFields.querySelector('[name^="project_name"]').value = '';
            projectFields.querySelector('[name^="project_id"]').value = '';
            projectFields.querySelector('[name^="task_name"]').value = '';
            projectFields.querySelector('[name^="task_id"]').value = '';
        } else {
            projectFields.style.display = 'none';
            ticketField.style.display = 'none';
        }
    }
                


          // To add clone container of daily report
          function addContainer() {
          const dynamicContainers = document.getElementById('dynamic-containers');
          const newContainer = dynamicContainers.firstElementChild.cloneNode(true);
          const uniqueId = Date.now();   // Use a timestamp to ensure uniqueness

          // Update IDs and names for the new container's elements
          newContainer.querySelectorAll('[id], [name]').forEach(field => {
              if (field.id) field.id = field.id.replace(/\d+$/, '') + uniqueId;
              if (field.name) {
                  const fieldName = field.name.split('[')[0];
                  field.name = `${fieldName}[${uniqueId}]`;
              }
          });

          // Clear values, Clear input and textarea fields in the new container
          newContainer.querySelectorAll('input, textarea').forEach(field => {
              if (field.type !== 'hidden') field.value = '';
          });

          // Clear any dropdowns in the new container
          newContainer.querySelectorAll('.ticket-dropdown, .project-dropdown, .task-dropdown').forEach(dropdown => {
              dropdown.innerHTML = '';
              dropdown.style.display = 'none';
          });

          // Append the new container to the dynamic-containers div
          dynamicContainers.appendChild(newContainer);
          updateTotalHrs();
        }


          // To remove the triggered container 
          function removeContainer(button) {
            const container = button.closest('.report-container');
            if (document.querySelectorAll('.report-container').length > 1) {
              container.remove();
              updateTotalHrs();
            }
          }

          function updateTotalHrs() {
            const hrsFields = document.querySelectorAll('.hrs');
            let totalHrs = 0;
            hrsFields.forEach(field => {
              totalHrs += parseFloat(field.value) || 0;
            });
            document.getElementById('total-hrs').value = totalHrs;
          }

      

                  // Function to search projects (scoped to the container)

                var searchProjectsRoute = "{{ route('admin.projects.search', ':term') }}";
                var searchTasksRoute = "{{ route('admin.tasks.search') }}"; // No placeholder needed for task search
                var searchTicketsRoute = "{{ route('admin.tickets.search') }}";
            
           
               // Function to search projects
                function searchProjects(input) {
                    const container = input.closest('.project-search-container');
                    const dropdown = container.querySelector('.project-dropdown');
                    const hiddenIdField = container.querySelector('[id^="project-id"]');
                    const term = input.value.trim();

                    if (term.length > 0) {
                        const url = searchProjectsRoute.replace(':term', term);
                        
                        $.ajax({
                            url: url,
                            method: 'GET',
                            success: function(response) {
                                dropdown.innerHTML = '';
                                
                                if (response.length > 0) {
                                    const dropdownList = document.createElement('div');
                                    dropdownList.className = 'project-dropdown-list';
                                    
                                    response.forEach(project => {
                                        const option = document.createElement('div');
                                        option.className = 'project-dropdown-option';
                                        option.textContent = project.label;
                                        
                                        option.onclick = function() {
                                            input.value = project.label;
                                            hiddenIdField.value = project.id;
                                            dropdown.style.display = 'none';
                                            
                                            // Clear any existing task selection when project changes
                                            const taskContainer = container.closest('.project-fields').querySelector('.task-search-container');
                                            if (taskContainer) {
                                                taskContainer.querySelector('.task-name').value = '';
                                                taskContainer.querySelector('[id^="task-id"]').value = '';
                                            }
                                        };
                                        
                                        dropdownList.appendChild(option);
                                    });
                                    
                                    dropdown.appendChild(dropdownList);
                                    dropdown.style.display = 'block';
                                } else {
                                    dropdown.style.display = 'none';
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error('AJAX Error:', error);
                            }
                        });
                    } else {
                        dropdown.style.display = 'none';
                    }
                }
              
                

              // Function to search tasks
              function searchTasks(input) {
                  const container = input.closest('.task-search-container');
                  const dropdown = container.querySelector('.task-dropdown');
                  const hiddenIdField = container.querySelector('[id^="task-id"]');
                  const term = input.value.trim();

                  // Find the project ID from the same form row
                  const projectContainer = container.closest('.project-fields').querySelector('.project-search-container');
                  const projectId = projectContainer ? projectContainer.querySelector('[id^="project-id"]').value : null;

                  if (term.length > 0 && projectId) {
                      $.ajax({
                          url: searchTasksRoute,
                          method: 'GET',
                          data: {
                              term: term,
                              project_id: projectId
                          },
                          success: function(response) {
                              dropdown.innerHTML = '';
                              
                              if (response.length > 0) {
                                  const dropdownList = document.createElement('div');
                                  dropdownList.className = 'task-dropdown-list';
                                  
                                  response.forEach(task => {
                                      const option = document.createElement('div');
                                      option.className = 'task-dropdown-option';
                                      option.textContent = task.label;
                                      
                                      option.onclick = function() {
                                          input.value = task.label;
                                          hiddenIdField.value = task.id;
                                          dropdown.style.display = 'none';
                                      };
                                      
                                      dropdownList.appendChild(option);
                                  });
                                  
                                  dropdown.appendChild(dropdownList);
                                  dropdown.style.display = 'block';
                              } else {
                                  dropdown.style.display = 'none';
                              }
                          },
                          error: function(xhr, status, error) {
                              console.error('AJAX Error:', error);
                          }
                      });
                  } else {
                      dropdown.style.display = 'none';
                      
                      if (!projectId) {
                          // Optionally show a message that a project must be selected first
                          console.log('Please select a project first');
                      }
                  }
              }


                          // Function to search tickets and populate select dropdown
                          function searchTickets(input) {
                          const container = input.closest('.ticket-search-container');
                          const dropdown = container.querySelector('.ticket-dropdown');
                          const hiddenIdField = container.querySelector('[id^="ticket-id"]');
                          const term = input.value.trim();

                          if (term.length > 0) {
                              $.ajax({
                                  url: searchTicketsRoute,
                                  method: 'GET',
                                  data: { term: term },
                                  success: function(response) {
                                      dropdown.innerHTML = '';
                                      
                                      if (response.length > 0) {
                                          // Create a <select>-like dropdown using <div> elements
                                          const dropdownList = document.createElement('div');
                                          dropdownList.className = 'ticket-dropdown-list';
                                          
                                          response.forEach(ticket => {
                                              const option = document.createElement('div');
                                              option.className = 'ticket-dropdown-option';
                                              option.textContent = ticket.label;
                                              
                                              option.onclick = function() {
                                                  input.value = ticket.label;
                                                  hiddenIdField.value = ticket.id;
                                                  dropdown.style.display = 'none';
                                              };
                                              
                                              dropdownList.appendChild(option);
                                          });
                                          
                                          dropdown.appendChild(dropdownList);
                                          dropdown.style.display = 'block';
                                      } else {
                                          dropdown.style.display = 'none';
                                      }
                                  },
                                  error: function(xhr, status, error) {
                                      console.error('AJAX Error:', error);
                                  }
                              });
                          } else {
                              dropdown.style.display = 'none';
                          }
                      }

                      // Close dropdown when clicking outside
                      document.addEventListener('click', function(e) {
                          if (!e.target.closest('.ticket-search-container')) {
                              document.querySelectorAll('.ticket-dropdown').forEach(dropdown => {
                                  dropdown.style.display = 'none';
                              });
                          }
                          if (!e.target.closest('.project-search-container')) {
                                  document.querySelectorAll('.project-dropdown').forEach(dropdown => {
                                      dropdown.style.display = 'none';
                                  });
                              }
                              if (!e.target.closest('.task-search-container')) {
                                  document.querySelectorAll('.task-dropdown').forEach(dropdown => {
                                      dropdown.style.display = 'none';
                                  });
                              }
                          });


      

</script>
