
@extends('backend.layouts.app')

@section('title', __('Add Daily Report | Isarva Support'))

@section('content')




{{-- 
<div class="main-container">
    <!-- Dynamic Containers Section -->
    <div class="header-container">
      <h3 class="header-title">ADD DAILY REPORT</h3>
    
    </div>

    <div id="dynamic-containers">
      <div class="report-container">
        <div class="dropdown-section">
          <label for="report-type">Select Type:</label>
          <select id="report-type" class="report-type" name="report-type" onchange="handleReportTypeChange(this)">
            <option value="None">None</option>
            <option value="Project">Project</option>
            <option value="Ticket">Ticket</option>
          </select>
        </div>

        <!-- Project Fields (Hidden by Default) -->
        <div class="project-fields" style="display: none;">
          <input type="text" id="project-name" data-project-id="" placeholder="Project Name">
          <input type="text" id="task-name" placeholder="Task Name">
        </div>

        <!-- Ticket Field (Hidden by Default) -->
        <div class="ticket-field" style="display: none;">
          <input type="text" class="ticket-name" name="ticket-name" placeholder="Ticket Name" value="{{ old('ticket-name') }}">
        </div>

        <!-- Common Fields -->
        <div class="common-fields">
          <textarea class="comments" name="comments" placeholder="Comments">{{ old('comments') }}</textarea>
          <input type="number" class="hrs" name="hrs" placeholder="Hrs" oninput="updateTotalHrs()" value="{{ old('hrs') }}">
          <input type="text" class="link" name="link" placeholder="Link" value="{{ old('link') }}">
          <select class="billable" name="billable">
            <option value="Non Billable" {{ old('billable') == 'Non Billable' ? 'selected' : '' }}>Non Billable</option>
            <option value="Billable" {{ old('billable') == 'Billable' ? 'selected' : '' }}>Billable</option>
            <option value="Internal Billable" {{ old('billable') == 'Internal Billable' ? 'selected' : '' }}>Internal Billable</option>
          </select>
        </div>

        <!-- Add/Remove Buttons -->
        <div class="action-buttons">
          <button class="add-btn" onclick="addContainer()">+</button>
          <button class="remove-btn" onclick="removeContainer(this)">-</button>
        </div>
      </div>
    </div>

    <!-- Summary Container -->
    <div class="summary-container">
      <div class="total-hrs">
        <label for="total-hrs">Total Hrs:</label>
        <input type="text" id="total-hrs" name="total-hrs" readonly value="{{ old('total-hrs') }}">
      </div>
      <div class="overall-status">
        <label for="overall-status">Overall Status:</label>
        <textarea id="overall-status" name="overall-status" placeholder="Overall Status">{{ old('overall-status') }}</textarea>
      </div>
    </div>

    <!-- Submit Button -->
    <div class="subbtn">
      <button class="submit-btn" onclick="submitReport()">Submit</button> 
    </div>
</div> --}}

{{-- <div class="main-container">
  <!-- Dynamic Containers Section -->
  <div class="header-container">
    <h3 class="header-title">ADD DAILY REPORT</h3>
  </div>

  <div id="dynamic-containers">
    <div class="report-container">
      <div class="dropdown-section">
        <label for="report-type">Select Type:</label>
        <select id="report-type" class="report-type" name="report-type" onchange="handleReportTypeChange(this)">
          <option value="None">None</option>
          <option value="Project">Project</option>
          <option value="Ticket">Ticket</option>
        </select>
      </div>

      <!-- Project Fields (Hidden by Default) -->
      <div class="project-fields" style="display: none;">
        <input type="text" id="project-name" data-project-id="" placeholder="Project Name" oninput="searchProjects(this)">
        <div id="project-results"></div>
        <input type="text" id="task-name" placeholder="Task Name">
      </div>

      <!-- Ticket Field (Hidden by Default) -->
      <div class="ticket-field" style="display: none;">
        <input type="text" class="ticket-name" name="ticket-name" placeholder="Ticket Name" value="{{ old('ticket-name') }}">
      </div>

      <!-- Common Fields -->
      <div class="common-fields">
        <textarea class="comments" name="comments" placeholder="Comments">{{ old('comments') }}</textarea>
        <input type="number" class="hrs" name="hrs" placeholder="Hrs" oninput="updateTotalHrs()" value="{{ old('hrs') }}">
        <input type="text" class="link" name="link" placeholder="Link" value="{{ old('link') }}">
        <select class="billable" name="billable">
          <option value="Non Billable" {{ old('billable') == 'Non Billable' ? 'selected' : '' }}>Non Billable</option>
          <option value="Billable" {{ old('billable') == 'Billable' ? 'selected' : '' }}>Billable</option>
          <option value="Internal Billable" {{ old('billable') == 'Internal Billable' ? 'selected' : '' }}>Internal Billable</option>
        </select>
      </div>

      <!-- Add/Remove Buttons -->
      <div class="action-buttons">
        <button class="add-btn" onclick="addContainer()">+</button>
        <button class="remove-btn" onclick="removeContainer(this)">-</button>
      </div>
    </div>
  </div>

  <!-- Summary Container -->
  <div class="summary-container">
    <div class="total-hrs">
      <label for="total-hrs">Total Hrs:</label>
      <input type="text" id="total-hrs" name="total-hrs" readonly value="{{ old('total-hrs') }}">
    </div>
    <div class="overall-status">
      <label for="overall-status">Overall Status:</label>
      <textarea id="overall-status" name="overall-status" placeholder="Overall Status">{{ old('overall-status') }}</textarea>
    </div>
  </div>

  <!-- Submit Button -->
  <div class="subbtn">
    <button class="submit-btn" onclick="submitReport()">Submit</button> 
  </div>
</div> --}}

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
          <label for="report-type">Report Type:</label>
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
          <input type="text" id="project-name-{{ $index }}" name="project_name[{{ $index }}]" placeholder="Project Name" oninput="searchProjects(this)" autocomplete="off" value="{{ old('project_name.' . $index, '') }}">
          <div id="project-results-{{ $index }}" class="project-results"></div>
          <input type="hidden" id="project-id-{{ $index }}" name="project_id[{{ $index }}]" value="{{ old('project_id.' . $index, '') }}">
          {{-- @if ($errors->has('project_id.' . $index))
              <p class="error-message">{{ $errors->first('project_id.' . $index) }}</p>
          @endif --}}
          <!-- In project fields section -->
          @error('project_name.'.$index)
             <p class="error-message project-error">{{ $message }}</p>
          @enderror
          @error('project_id.'.$index)
              <p class="error-message project-error">{{ $message }}</p>
          @enderror

          <!-- Task Name Field -->
      
          <input type="text" id="task-name-{{ $index }}" name="task_name[{{ $index }}]" placeholder="Task Name" oninput="searchTasks(this)" autocomplete="off" value="{{ old('task_name.' . $index, '') }}">
          <div id="task-results-{{ $index }}" class="task-results"></div>
          <input type="hidden" id="task-id-{{ $index }}" name="task_id[{{ $index }}]" value="{{ old('task_id.' . $index, '') }}">
          @if ($errors->has('task_id.' . $index))
              <p class="error-message">{{ $errors->first('task_id.' . $index) }}</p>
          @endif
        </div>

        {{-- <!-- Ticket Field (Hidden by Default) -->
        <div class="ticket-field" style="{{ old('type.' . $index) == '2' ? 'display: block;' : 'display: none;' }}">
          <input type="text" class="ticket-name" name="ticket-name[{{ $index }}]" placeholder="Ticket Name" value="{{ old('ticket-name.' . $index, '') }}">
        </div> --}}

        {{-- <div class="ticket-field" style="{{ old('type.' . $index) == '2' ? 'display: block;' : 'display: none;' }}">
          <div class="ticket-search-container">
              <input 
                  type="text" 
                  class="ticket-name" 
                  name="ticket-name[{{ $index }}]" 
                  placeholder="Search Ticket..." 
                  oninput="searchTickets(this)" 
                  autocomplete="off" 
                  value="{{ old('ticket-name.' . $index, '') }}"
              >
              <input type="hidden" id="ticket-id-{{ $index }}" name="ticket_id[{{ $index }}]" value="{{ old('ticket_id.' . $index, '') }}">
              <!-- Dropdown will appear below -->
              <div class="ticket-dropdown" style="display: none;"></div>
          </div>
        </div> --}}

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
          <button type="button" class="add-btn" onclick="addContainer()">+</button>
          <button type="button" class="remove-btn" onclick="removeContainer(this)">-</button>
        </div>
      </div>
      @endforeach
    </div>

    <!-- Summary Container -->
    <div class="summary-container">
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>


         // script.js
           // Working fine other than ticket
        // function handleReportTypeChange(selectElement) {
        //   const container = selectElement.closest('.report-container');
        //   const projectFields = container.querySelector('.project-fields');
        //   const ticketField = container.querySelector('.ticket-field');

        //   if (selectElement.value === '1') {
        //     projectFields.style.display = 'block';
        //     ticketField.style.display = 'none';
        //   } else if (selectElement.value === '2') {
        //     projectFields.style.display = 'none';
        //     ticketField.style.display = 'block';
        //   } else {
        //     projectFields.style.display = 'none';
        //     ticketField.style.display = 'none';
        //   }
        // }

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
                


          // Works fine
          // function addContainer() {
          //     const dynamicContainers = document.getElementById('dynamic-containers');
          //     const newContainer = dynamicContainers.firstElementChild.cloneNode(true);

          //     // Generate a unique ID for the new container
          //     const uniqueId = Date.now(); // Use a timestamp to ensure uniqueness

          //     // Update IDs and names for the new container's elements
          //     newContainer.querySelectorAll('[id], [name]').forEach(field => {
          //       // Update IDs
          //       if (field.id) {
          //         field.id = `${field.id}-${uniqueId}`;
          //       }

          //       // Update names 
          //       if (field.name) {
          //         const fieldName = field.name.split('[')[0]; // Extract base name (e.g., "project_name")
          //       // Update names This uniqueId is then used to update the name and id attributes of the fields in the new container:
          //         field.name = `${fieldName}[${uniqueId}]`; // Update to use unique ID 
          //       }
          //     });

          //     // Clear input and textarea fields in the new container
          //     newContainer.querySelectorAll('input, textarea').forEach(field => {
          //       if (field.type !== 'hidden') { // Skip hidden fields
          //         field.value = '';
          //       }
          //     });

          //     // Append the new container to the dynamic-containers div
          //     dynamicContainers.appendChild(newContainer);

          //     // Update the total hours
          //     updateTotalHrs();
          //   }


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

          // Clear values , Clear input and textarea fields in the new container
          newContainer.querySelectorAll('input, textarea').forEach(field => {
              if (field.type !== 'hidden') field.value = '';
          });

           // Append the new container to the dynamic-containers div
          dynamicContainers.appendChild(newContainer);
          updateTotalHrs();
      }

// function submitReport() {
//   const reportContainers = document.querySelectorAll('.report-container');
//   const reportData = [];

//   reportContainers.forEach(container => {
//     const reportType = container.querySelector('.report-type').value;
//     const projectName = container.querySelector('.project-name')?.value;
//     const taskName = container.querySelector('.task-name')?.value;
//     const ticketName = container.querySelector('.ticket-name')?.value;
//     const comments = container.querySelector('.comments').value;
//     const hrs = container.querySelector('.hrs').value;
//     const link = container.querySelector('.link').value;
//     const billable = container.querySelector('.billable').value;

//     reportData.push({
//       reportType,
//       projectName,
//       taskName,
//       ticketName,
//       comments,
//       hrs,
//       link,
//       billable
//     });
//   });

//   const totalHrs = document.getElementById('total-hrs').value;
//   const overallStatus = document.getElementById('overall-status').value;

//   const finalReport = {
//     reportData,
//     totalHrs,
//     overallStatus
//   };

//   console.log('Submitted Report:', finalReport);
//   alert('Report Submitted! Check console for details.');
// }


    
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




</script>


<script>

      // AJAX to call project list
      // Define the route with a placeholder for the search term
      // var searchProjectsRoute = "{{ route('admin.projects.search', ':term') }}";

      // function searchProjects(input) {
      //   const term = input.value;
      //   const resultsDiv = document.getElementById('project-results');

      //   if (term.length > 0) {
      //     // Replace the placeholder in the route with the actual search term
      //     var url = searchProjectsRoute.replace(':term', term);

      //     $.ajax({
      //       url: url, // Use the dynamically generated URL
      //       method: 'GET',
      //       success: function(response) {
      //         resultsDiv.innerHTML = ''; // Clear previous results
      //         response.forEach(project => {
      //           const projectDiv = document.createElement('div');
      //           projectDiv.textContent = project.label; // Display the project name
      //           projectDiv.onclick = function() {
      //             input.value = project.label; // Set the selected project name in the input field
      //             input.setAttribute('data-project-id', project.id); // Set the project ID in a data attribute
      //             resultsDiv.innerHTML = ''; // Clear the dropdown
      //           };
      //           resultsDiv.appendChild(projectDiv);
      //         });
      //       },
      //       error: function(xhr, status, error) {
      //         console.error('AJAX Error:', error); // Log any errors
      //       }
      //     });
      //   } else {
      //     resultsDiv.innerHTML = ''; // Clear results if the search term is empty
      //   }
      // }





       // Define the routes with placeholders for the search terms
        // var searchProjectsRoute = "{{ route('admin.projects.search', ':term') }}";
        // var searchTasksRoute = "{{ route('admin.tasks.search') }}"; // No placeholder needed for task search

        // // Arrays to store the list of valid projects and tasks
        // var validProjects = [];
        // var validTasks = [];

        // // Function to search projects
        // function searchProjects(input) {
        //   const term = input.value;
        //   const resultsDiv = document.getElementById('project-results');
        //   const validationError = document.getElementById('project-validation-error');

        //   if (term.length > 0) {
        //     var url = searchProjectsRoute.replace(':term', term);

        //     $.ajax({
        //       url: url,
        //       method: 'GET',
        //       success: function(response) {
        //         resultsDiv.innerHTML = '';
        //         validProjects = response;

        //         response.forEach(project => {
        //           const projectDiv = document.createElement('div');
        //           projectDiv.textContent = project.label;
        //           projectDiv.onclick = function() {
        //             input.value = project.label;
        //             input.setAttribute('data-project-id', project.id);
        //             resultsDiv.innerHTML = '';
        //             validationError.style.display = 'none';
        //           };
        //           resultsDiv.appendChild(projectDiv);
        //         });
        //       },
        //       error: function(xhr, status, error) {
        //         console.error('AJAX Error:', error);
        //       }
        //     });
        //   } else {
        //     resultsDiv.innerHTML = '';
        //     validProjects = [];
        //   }
        // }

        // Function to search tasks
        // function searchTasks(input) {
        //   const term = input.value;
        //   const projectId = document.getElementById('project-name').getAttribute('data-project-id'); // Get the selected project ID
        //   const resultsDiv = document.getElementById('task-results');

        //   if (term.length > 0 && projectId) {
        //     $.ajax({
        //       url: searchTasksRoute,
        //       method: 'GET',
        //       data: {
        //         term: term,
        //         project_id: projectId // Pass the selected project ID
        //       },
        //       success: function(response) {
        //         resultsDiv.innerHTML = '';
        //         validTasks = response;

        //         response.forEach(task => {
        //           const taskDiv = document.createElement('div');
        //           taskDiv.textContent = task.label;
        //           taskDiv.onclick = function() {
        //             input.value = task.label;
        //             input.setAttribute('data-task-id', task.id);
        //             resultsDiv.innerHTML = '';
        //           };
        //           resultsDiv.appendChild(taskDiv);
        //         });
        //       },
        //       error: function(xhr, status, error) {
        //         console.error('AJAX Error:', error);
        //       }
        //     });
        //   } else {
        //     resultsDiv.innerHTML = '';
        //     validTasks = [];
        //   }
        // }

        // Function to search projects (scoped to the container)

                  // Function to search projects (scoped to the container)

                var searchProjectsRoute = "{{ route('admin.projects.search', ':term') }}";
                var searchTasksRoute = "{{ route('admin.tasks.search') }}"; // No placeholder needed for task search
                var searchTicketsRoute = "{{ route('admin.tickets.search') }}";
                
                // function searchProjects(input) {
                //   const container = input.closest('.report-container'); // Get the closest container
                //   const term = input.value;
                //   const resultsDiv = container.querySelector('.project-results'); // Scope to the container's results div

                //   if (term.length > 0) {
                //     const url = searchProjectsRoute.replace(':term', term);

                //     $.ajax({
                //       url: url,
                //       method: 'GET',
                //       success: function(response) {
                //         resultsDiv.innerHTML = '';
                //         response.forEach(project => {
                //           const projectDiv = document.createElement('div');
                //           projectDiv.textContent = project.label;
                //           projectDiv.onclick = function() {
                //             input.value = project.label;
                //             input.setAttribute('data-project-id', project.id);
                //             resultsDiv.innerHTML = '';
                //           };
                //           resultsDiv.appendChild(projectDiv);
                //         });
                //       },
                //       error: function(xhr, status, error) {
                //         console.error('AJAX Error:', error);
                //       }
                //     });
                //   } else {
                //     resultsDiv.innerHTML = '';
                //   }
                // }

                // // Function to search tasks (scoped to the container)
                // function searchTasks(input) {
                //   const container = input.closest('.report-container'); // Get the closest container
                //   const term = input.value;

                //   // Find the project name input field within the same container
                //   const projectNameInput = container.querySelector('[id^="project-name"]'); // Use attribute selector
                //   const projectId = projectNameInput ? projectNameInput.getAttribute('data-project-id') : null; // Get the project ID

                //   const resultsDiv = container.querySelector('.task-results'); // Scope to the container's results div

                //   if (term.length > 0 && projectId) {
                //     $.ajax({
                //       url: searchTasksRoute,
                //       method: 'GET',
                //       data: {
                //         term: term,
                //         project_id: projectId // Pass the selected project ID
                //       },
                //       success: function(response) {
                //         resultsDiv.innerHTML = '';
                //         response.forEach(task => {
                //           const taskDiv = document.createElement('div');
                //           taskDiv.textContent = task.label;
                //           taskDiv.onclick = function() {
                //             input.value = task.label;
                //             input.setAttribute('data-task-id', task.id);
                //             resultsDiv.innerHTML = '';
                //           };
                //           resultsDiv.appendChild(taskDiv);
                //         });
                //       },
                //       error: function(xhr, status, error) {
                //         console.error('AJAX Error:', error);
                //       }
                //     });
                //   } else {
                //     resultsDiv.innerHTML = '';
                //   }
                // }

                // Function to search projects (scoped to the container)
                function searchProjects(input) {
                  const container = input.closest('.report-container'); // Get the closest container
                  const term = input.value.trim();   // Gets the search term typed ny user
                  const resultsDiv = container.querySelector('.project-results'); // This is the div where the search results will be displayed.

                  
                  if (term.length > 0) {
                    const url = searchProjectsRoute.replace(':term', term);

                    $.ajax({
                      url: url,
                      method: 'GET',
                      success: function(response) {
                        resultsDiv.innerHTML = '';         // Clears any previous search results from the resultsDiv
                        //  Loops through the array of project objects returned by the server.
                        response.forEach(project => {      
                          const projectDiv = document.createElement('div');
                          projectDiv.textContent = project.label;
                          projectDiv.classList.add('dropdown_lists'); // Add the class name


                          projectDiv.onclick = function() {
                            input.value = project.label;
                            input.setAttribute('data-project-id', project.id); // Set data-project-id attribute to store id
                            container.querySelector('[id^="project-id"]').value = project.id; // Finds the hidden input element inside the container that starts with the id "project-id" and sets its value to the project id.
                            resultsDiv.innerHTML = '';
                          };
                          resultsDiv.appendChild(projectDiv);
                        });
                      },
                      error: function(xhr, status, error) {
                        console.error('AJAX Error:', error);
                      }
                    });
                  } else {
                    resultsDiv.innerHTML = '';
                  }
                }
          

                

              // Function to search tasks (scoped to the container)
              function searchTasks(input) {
              const container = input.closest('.report-container'); // Get the closest container
              const term = input.value.trim();
             

              // Find the project name input field within the same container
              const projectNameInput = container.querySelector('[id^="project-name"]'); // Use attribute selector
              const projectId = projectNameInput ? projectNameInput.getAttribute('data-project-id') : null; // Get the project ID

              const resultsDiv = container.querySelector('.task-results'); // Scope to the container's results div

              if (term.length > 0 && projectId) {
                $.ajax({
                  url: searchTasksRoute,
                  method: 'GET',
                  data: {
                    term: term,
                    project_id: projectId // Pass the selected project ID
                  },
                  success: function(response) {
                    resultsDiv.innerHTML = '';
                    response.forEach(task => {
                      const taskDiv = document.createElement('div');
                      taskDiv.textContent = task.label;
                      
                      taskDiv.onclick = function() {
                        input.value = task.label;
                        container.querySelector('[id^="task-id"]').value = task.id; // Set task_id hidden field
                        resultsDiv.innerHTML = '';
                      };
                      resultsDiv.appendChild(taskDiv);
                    });
                  },
                  error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                  }
                });
              } else {
                resultsDiv.innerHTML = '';
              }
            }

             // Function to search tickets (scoped to the container)
            // function searchTickets(input) {
            //     const container = input.closest('.report-container'); // Get the closest container
            //     const term = input.value.trim();
            //     const resultsDiv = container.querySelector('.ticket-results'); // We'll need to add this div
                
            //     if (term.length > 0) {
            //         $.ajax({
            //             url: searchTicketsRoute,
            //             method: 'GET',
            //             data: {
            //                 term: term
            //             },
            //             success: function(response) {
            //                 resultsDiv.innerHTML = '';
            //                 response.forEach(ticket => {
            //                     const ticketDiv = document.createElement('div');
            //                     ticketDiv.textContent = ticket.label;
            //                     ticketDiv.classList.add('dropdown_lists'); // Add the same class for consistent styling
                                
            //                     ticketDiv.onclick = function() {
            //                         input.value = ticket.label;
            //                         // If you need to store the ticket ID, you can add a hidden field
            //                         container.querySelector('[id^="ticket-id"]').value = ticket.id;
            //                         resultsDiv.innerHTML = '';
            //                     };
            //                     resultsDiv.appendChild(ticketDiv);
            //                 });
            //             },
            //             error: function(xhr, status, error) {
            //                 console.error('AJAX Error:', error);
            //             }
            //         });
            //     } else {
            //         resultsDiv.innerHTML = '';
            //     }
            // }


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
                      });


        //     function validateForm() {
        //     let isValid = true;
        //     document.querySelectorAll('.report-container').forEach(container => {
        //         const projectId = container.querySelector('[id^="project-id"]').value;
        //         const taskId = container.querySelector('[id^="task-id"]').value;

        //         if (!projectId || !taskId) {
        //             isValid = false;
        //             alert('Please select a valid project and task for all containers.');
        //         }
        //     });
        //     return isValid;
        // }

        // document.getElementById('dailyreportform').addEventListener('submit', function(event) {
        //     if (!validateForm()) {
        //         event.preventDefault(); // Prevent form submission
        //     }
        // });

</script>
