
@extends('backend.layouts.app')

@section('title', __('Edit Renewal'))

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

{{-- <form action="{{ route($service ? 'admin.renewals.update' : 'admin.renewals.store', $service->id ?? '') }}" method="POST">
    @csrf
    @if(isset($service)) @method('PUT') @endif

    <div class="form-group">
        <label for="project_id">Project</label>
        <select name="project_id" id="project_id" class="form-control" required>
            <option value="">Select Project</option>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" 
                    {{ old('project_id', $service->project_id ?? '') == $project->id ? 'selected' : '' }}>
                    {{ $project->project_name }} (ID: {{ $project->id }})
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="service_type">Service Type</label>
        <select name="service_type" id="service_type" class="form-control" required>
            <option value="domain" {{ (old('service_type', $service->service_type ?? '') == 'domain') ? 'selected' : '' }}>Domain</option>
            <option value="hosting" {{ (old('service_type', $service->service_type ?? '') == 'hosting') ? 'selected' : '' }}>Hosting</option>
            <option value="application" {{ (old('service_type', $service->service_type ?? '') == 'application') ? 'selected' : '' }}>Application</option>
        </select>
    </div>

    <div class="form-group">
        <label for="service_name">IP / Service Name</label>
        <input type="text" class="form-control" name="service_name" id="service_name" 
               value="{{ old('service_name', $service->service_name ?? '') }}" placeholder="Service Name" required>
    </div>

    <div class="form-group">
        <label for="provider">Provider</label>
        <input type="text" class="form-control" name="provider" id="provider" 
               value="{{ old('provider', $service->provider ?? '') }}" placeholder="Provider" required>
    </div>

    <div class="form-group">
        <label for="expiry_date">Expiry Date</label>
        <input type="date" class="form-control" name="expiry_date" id="expiry_date" 
            value="{{ old('expiry_date', isset($service->expiry_date) ? $service->expiry_date->format('Y-m-d') : '') }}" required>
    </div>

    <div class="form-group">
        <label for="renewal_cost">Renewal Cost</label>
        <input type="number" step="0.01" class="form-control" name="renewal_cost" id="renewal_cost" 
               value="{{ old('renewal_cost', $service->renewal_cost ?? '') }}" placeholder="Renewal Cost">
    </div>

    <div class="form-group">
        <label for="notes">Notes</label>
        <textarea class="form-control" name="notes" id="notes" placeholder="Notes">{{ old('notes', $service->notes ?? '') }}</textarea>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-primary px-4 py-2">
            Save
        </button>
        
    </div>
</form> --}}


    <form action="{{ route('admin.renewals.update', $service->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Client Select (Select2) -->
        <div class="form-group">
            <label for="client_id">Select Client <span class="required">*</span></label>
            <select name="client_id" id="client_id" class="form-control select2">
                <option value="">Select Client</option>
                @foreach(App\Helpers\ClientHelper::getClientNames() as $id => $clientName)
                    <option value="{{ $id }}" {{ $service->client_id == $id ? 'selected' : '' }}>{{ $clientName }}</option>
                @endforeach
            </select>
            @if($errors->has('client_id'))
                <div class="text-danger">{{ $errors->first('client_id') }}</div>
            @endif
        </div>

        <!-- Project Select (Select2) -->
        <div class="form-group mt-3">
            <label for="project_id">Project <span class="required">*</span></label>
            <select name="project_id" id="project_id" class="form-control select2">
                <option value="">Select Project</option>
                @foreach($projects as $project)
                    <option value="{{ $project->id }}" {{ $service->project_id == $project->id ? 'selected' : '' }}>
                        {{ $project->project_name }} (ID: {{ $project->id }})
                    </option>
                @endforeach
            </select>
            @if($errors->has('project_id'))
                <div class="text-danger">{{ $errors->first('project_id') }}</div>
            @endif
        </div>

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
                        {{ $service->d_service ? 'checked' : '' }}>
                    <label class="form-check-label" for="domain_enabled">Domain</label>
                </div>
                <div class="service-fields" id="domain_fields" style="{{ $service->d_service ? '' : 'display: none;' }}">
                    <input type="text" name="services[domain][name]" 
                        value="{{ $service->d_name }}" 
                        placeholder="Enter domain" class="form-control" {{ $service->d_service ? 'required' : '' }}>
                    <input type="date" name="services[domain][expiry_date]" 
                        value="{{ $service->d_exp }}" 
                        class="form-control" {{ $service->d_service ? 'required' : '' }}>
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
                        {{ $service->h_service ? 'checked' : '' }}>
                    <label class="form-check-label" for="hosting_enabled">Hosting</label>
                </div>
                <div class="service-fields" id="hosting_fields" style="{{ $service->h_service ? '' : 'display: none;' }}">
                    <input type="text" name="services[hosting][name]" 
                        value="{{ $service->h_ip }}" 
                        placeholder="Enter hosting IP" class="form-control" {{ $service->h_service ? 'required' : '' }}>
                    <input type="date" name="services[hosting][expiry_date]" 
                        value="{{ $service->h_exp }}" 
                        class="form-control" {{ $service->h_service ? 'required' : '' }}>
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
                        {{ $service->a_service ? 'checked' : '' }}>
                    <label class="form-check-label" for="application_enabled">Application</label>
                </div>
                <div class="service-fields" id="application_fields" style="{{ $service->a_service ? '' : 'display: none;' }}">
                    <input type="text" name="services[application][name]" 
                        value="{{ $service->a_name }}" 
                        placeholder="Enter application name" class="form-control" {{ $service->a_service ? 'required' : '' }}>
                    <input type="date" name="services[application][expiry_date]" 
                        value="{{ $service->a_exp }}" 
                        class="form-control" {{ $service->a_service ? 'required' : '' }}>
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
            <input type="text" name="provider" id="provider" value="{{ old('provider', $service->provider) }}" class="form-control inputprojectbox" placeholder="Provider" >
            @if($errors->has('provider'))
                <div class="text-danger">{{ $errors->first('provider') }}</div>  
            @endif
        </div>

        <div class="form-group mt-3">
            <label for="renewal_cost">Renewal Cost</label>
            <input type="number" name="renewal_cost" id="renewal_cost" value="{{ $service->renewal_cost }}" class="form-control inputprojectbox" placeholder="Renewal Cost">
        </div>

        <div class="form-group mt-3">
            <label for="notes">Notes</label>
            <textarea name="notes" id="notes" class="form-control inputprojectbox" placeholder="Notes">{{ $service->notes }}</textarea>
        </div>

        <div class="mt-4 mb-4">
            <button type="submit" class="btn btn-primary px-4 py-2">
                Update
            </button>
            <a href="{{ route('admin.renewals.manage') }}" class="btn btn-secondary px-4 py-2">Cancel</a>
        </div>
    </form>

    
<script>
    $(document).ready(function() {
        // Initialize Select2
        $('.select2').select2({
            width: '100%',
            placeholder: $(this).data('placeholder')
        });

        // Initialize service fields based on checkbox state
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
                fieldsDiv.find('input').prop('required', false).val('');
            }
        });
    });
</script>

<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>


@endsection


