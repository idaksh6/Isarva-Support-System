
@extends('backend.layouts.app')

@section('title', __('Add Renewal'))

@section('content')

<style>

    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 39px;
        user-select: none;
        /* -webkit-user-select: none; */
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 35px;
    }

</style>

{{-- 
<form action="{{ route(isset($service) ? 'admin.renewals.update' : 'admin.renewals.store', $service->id ?? '') }}" method="POST">
    @csrf
    @if(isset($service)) @method('PUT') @endif

    <div class="form-group">
        <label for="project_id">Project</label>
        <select name="project_id" id="project_id" class="form-control" required>
            <option value="">Select Project</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                    {{ $project->project_name }} (ID: {{ $project->id }})
                </option>
            @endforeach
        </select>
    </div>
    
    <select name="service_type" required>
        <option value="domain" {{ (isset($service->service_type) && $service->service_type == 'domain') || old('service_type') == 'domain' ? 'selected' : '' }}>Domain</option>
        <option value="hosting" {{ (isset($service->service_type) && $service->service_type == 'hosting') || old('service_type') == 'hosting' ? 'selected' : '' }}>Hosting</option>
        <option value="application" {{ (isset($service->service_type) && $service->service_type == 'application') || old('service_type') == 'application' ? 'selected' : '' }}>Application</option>
    </select>
    
    <input type="text" name="service_name" value="{{ $service->service_name ?? old('service_name') ?? '' }}" placeholder="IP / Service Name" required>
    <input type="text" name="provider" value="{{ $service->provider ?? old('provider') ?? '' }}" placeholder="Provider" required>
    <input type="date" name="expiry_date" value="{{ $service->expiry_date ?? old('expiry_date') ?? '' }}" required>
    <input type="number" name="renewal_cost" value="{{ $service->renewal_cost ?? old('renewal_cost') ?? '' }}" placeholder="Renewal Cost">
    <textarea name="notes" placeholder="Notes">{{ $service->notes ?? old('notes') ?? '' }}</textarea>
    
    <div class="mt-4">
        <button type="submit" class="btn btn-primary px-4 py-2">
            Save
        </button>
        
    </div>
</form> --}}




<form action="{{ route(isset($service) ? 'admin.renewals.update' : 'admin.renewals.store', $service->id ?? '') }}" method="POST">
    @csrf
    @if(isset($service)) @method('PUT') @endif

    <!-- Client Select (Select2) -->
    <div class="form-group">
        <label for="client_id">Select Client <span class="required">*</span></label>
        <select name="client_id" id="client_id" class="form-control select2" >
            <option value="">Select Client</option>
                @foreach(App\Helpers\ClientHelper::getClientNames() as $id => $clientName)
                    <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}>{{ $clientName }}</option>
                    {{-- <option value="{{ $id }}" {{ old('client_id') == $id ? 'selected' : '' }}> --}}
                 @endforeach
        </select>
        @if($errors->has('client_id'))
            <div class="text-danger">{{ $errors->first('client_id') }}</div>
        @endif
    </div>

    <!-- Project Select (Select2) -->
    <div class="form-group mt-3">
        <label for="project_id">Project <span class="required">*</span></label>
        <select name="project_id" id="project_id" class="form-control select2" >
            <option value="">Select Project</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                    {{ $project->project_name }} (ID: {{ $project->id }})
                </option>
            @endforeach
        </select>
        @if($errors->has('project_id'))
            <div class="text-danger">{{ $errors->first('project_id') }}</div>
        @endif
    </div>
    
    <!-- Services Checkboxes with Fields -->
    {{-- <div class="services-container mt-3">
        <div class="sername d-flex justify-content-between align-items-center">
            <h5>Services</h5>
            <h5>Expiry Date</h5>
        </div>
        <div class="service-row">
           
            <div class="form-check">
                <input class="form-check-input service-checkbox" type="checkbox" name="services[domain][enabled]" id="domain_enabled" value="1"  >
                <label class="form-check-label" for="domain_enabled">Domain</label>
            </div>
            <div class="service-fields" id="domain_fields" style="display: none;" >
                <input type="text" name="services[domain][name]" placeholder="Enter domain" class="form-control">
                <input type="date" name="services[domain][expiry_date]" class="form-control">
            </div>
        </div>
        
        <div class="service-row">
            <div class="form-check">
                <input class="form-check-input service-checkbox" type="checkbox" name="services[hosting][enabled]" id="hosting_enabled" value="1" >
                <label class="form-check-label" for="hosting_enabled">Hosting</label>
            </div>
            <div class="service-fields" id="hosting_fields" style="display: none;">
                <input type="text" name="services[hosting][name]" placeholder="Enter hosting IP" class="form-control">
                <input type="date" name="services[hosting][expiry_date]" class="form-control">
            </div>
        </div>
        
        <div class="service-row">
            <div class="form-check">
                <input class="form-check-input service-checkbox" type="checkbox" name="services[application][enabled]" id="application_enabled" value="1" >
                <label class="form-check-label" for="application_enabled">Application</label>
            </div>
            <div class="service-fields" id="application_fields" style="display: none;">
                <input type="text" name="services[application][name]" placeholder="Enter application name" class="form-control">
                <input type="date" name="services[application][expiry_date]" class="form-control">
            </div>
        </div>
    </div> --}}


    <!-- Services Checkboxes with Fields -->
   
     <div class="services-container mt-3">
        <div class="sername d-flex justify-content-between align-items-center my-0 mx-4">
            <h5>Services</h5>
            <h5>Expiry Date</h5>
        </div>
        
        <!-- Domain Service -->
        <div class="service-row">
            <div class="form-check">
                <input class="form-check-input service-checkbox" type="checkbox" 
                       name="services[domain][enabled]" id="domain_enabled" value="1"
                       {{ old('services.domain.enabled', $service->d_service ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="domain_enabled">Domain</label>
            </div>
            <div class="service-fields" id="domain_fields" style="display: none;">
                <input type="text" name="services[domain][name]" 
                       value="{{ old('services.domain.name', $service->d_name ?? '') }}" 
                       placeholder="Enter domain" class="form-control">
                <input type="date" name="services[domain][expiry_date]" 
                       value="{{ old('services.domain.expiry_date', $service->d_exp ?? '') }}" 
                       class="form-control">
                @if($errors->has('services.domain.name'))
                    <div class="text-danger">{{ $errors->first('services.domain.name') }}</div>
                @endif
                @if($errors->has('services.domain.expiry_date'))
                    <div class="text-danger">{{ $errors->first('services.domain.expiry_date') }}</div>
                @endif
            </div>
        </div>
        
        <!-- Hosting Service -->
        <div class="service-row">
            <div class="form-check">
                <input class="form-check-input service-checkbox" type="checkbox" 
                       name="services[hosting][enabled]" id="hosting_enabled" value="1"
                       {{ old('services.hosting.enabled', $service->h_service ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="hosting_enabled">Hosting</label>
            </div>
            <div class="service-fields" id="hosting_fields" style="display: none;">
                <input type="text" name="services[hosting][name]" 
                       value="{{ old('services.hosting.name', $service->h_ip ?? '') }}" 
                       placeholder="Enter hosting IP" class="form-control">
                <input type="date" name="services[hosting][expiry_date]" 
                       value="{{ old('services.hosting.expiry_date', $service->h_exp ?? '') }}" 
                       class="form-control">
                @if($errors->has('services.hosting.name'))
                    <div class="text-danger">{{ $errors->first('services.hosting.name') }}</div>
                @endif
                @if($errors->has('services.hosting.expiry_date'))
                    <div class="text-danger">{{ $errors->first('services.hosting.expiry_date') }}</div>
                @endif
            </div>
        </div>
        
        <!-- Application Service -->
        <div class="service-row">
            <div class="form-check">
                <input class="form-check-input service-checkbox" type="checkbox" 
                       name="services[application][enabled]" id="application_enabled" value="1"
                       {{ old('services.application.enabled', $service->a_service ?? false) ? 'checked' : '' }}>
                <label class="form-check-label" for="application_enabled">Application</label>
            </div>
            <div class="service-fields" id="application_fields" style="display: none;">
                <input type="text" name="services[application][name]" 
                       value="{{ old('services.application.name', $service->a_name ?? '') }}" 
                       placeholder="Enter application name" class="form-control">
                <input type="date" name="services[application][expiry_date]" 
                       value="{{ old('services.application.expiry_date', $service->a_exp ?? '') }}" 
                       class="form-control">
                @if($errors->has('services.application.name'))
                    <div class="text-danger">{{ $errors->first('services.application.name') }}</div>
                @endif
                @if($errors->has('services.application.expiry_date'))
                    <div class="text-danger">{{ $errors->first('services.application.expiry_date') }}</div>
                @endif
            </div>
        </div>
    </div>
    <!-- Common Fields -->
    <div class="form-group">
        <label for="provider">Provider <span class="required">*</span></label>
        <input type="text" name="provider" id="provider" value="{{ $service->provider ?? old('provider') ?? '' }}" class="form-control inputprojectbox" placeholder="Provider" >
    </div>
    
    <div class="form-group mt-3">
        <label for="renewal_cost">Renewal Cost</label>
        <input type="number" name="renewal_cost" id="renewal_cost" value="{{ $service->renewal_cost ?? old('renewal_cost') ?? '' }}" class="form-control inputprojectbox" placeholder="Renewal Cost">
    </div>
    
    <div class="form-group mt-3">
        <label for="notes">Notes</label>
        <textarea name="notes" id="notes" class="form-control inputprojectbox" placeholder="Notes">{{ $service->notes ?? old('notes') ?? '' }}</textarea>
    </div>
    
    <div class="mt-4 mb-4">
        <button type="submit" class="btn btn-primary px-4 py-2">
            Save
        </button>
    </div>
</form>



<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>

<script>
// In your blade file or a separate JS file
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2();
    
    // Handle service checkbox toggles
    // $('.service-checkbox').change(function() {
    //     const serviceType = $(this).attr('id').replace('_enabled', '');
    //     const fieldsDiv = $('#' + serviceType + '_fields');
        
    //     if ($(this).is(':checked')) {
    //         fieldsDiv.show();
    //         fieldsDiv.find('input').prop('required', true);
    //     } else {
    //         fieldsDiv.hide();
    //         fieldsDiv.find('input').prop('required', false);
    //     }
    // });

        $('.service-checkbox').each(function() {
            const serviceType = $(this).attr('id').replace('_enabled', '');
            const fieldsDiv = $('#' + serviceType + '_fields');
            
            if ($(this).is(':checked')) {
                fieldsDiv.show();
                fieldsDiv.find('input').prop('required', true);
            } else {
                fieldsDiv.hide();
                fieldsDiv.find('input').prop('required', false);
            }
        });

        // Handle checkbox changes
        $('.service-checkbox').change(function() {
            const serviceType = $(this).attr('id').replace('_enabled', '');
            const fieldsDiv = $('#' + serviceType + '_fields');
            
            if ($(this).is(':checked')) {
                fieldsDiv.show();
                fieldsDiv.find('input').prop('required', true);
            } else {
                fieldsDiv.hide();
                fieldsDiv.find('input').prop('required', false);
            }
        });
    });




</script>
@endsection