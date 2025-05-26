@extends('backend.layouts.app')

@section('title', 'Create Backup | Isarva Support')

@section('content')

<style>

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #444;
            /* height: 40px; */
            line-height: 28px;
            padding-top: 4px;
            height: 100%;
            width: 100%;
        }


        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
            height: 40px;
            width: 100%;
        }

        span.select2.select2-container.select2-container--default {

            width: 100% !important;
        }

</style>

@if (session()->has('flash_success_backup'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center p-3 shadow-sm rounded-3" role="alert" style="border-left: 5px solid #198754; background: #e9f7ef;">
        <i class="bi bi-check-circle-fill me-2 text-success"></i> 
        <span>{{ session('flash_success_backup') }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- backup form -->
<div class="card mainbackupconatiner">
    <div class="card-body p-0">
        <form action="{{ route('admin.backup.store') }}" method="POST">

            @csrf

            <!-- 1. Project / Ticket / Others -->
            <div class="form-group mb-3">
                <label>Project / Ticket / Other <span class="required">*</span></label>
                <select class="form-control inputbackupbox" id="type_selector" name="type">
                    <option value="">-- Select --</option>
                    <option value="1" {{ old('type') == 1 ? 'selected' : '' }}>Project</option>
                    <option value="2" {{ old('type') == 2 ? 'selected' : '' }}>Ticket</option>
                    <option value="3" {{ old('type') == 3 ? 'selected' : '' }}>Others</option>
                </select>
                @if($errors->has('type'))
                    <div class="text-danger">{{ $errors->first('type') }}</div>
                @endif
            </div>

            <!-- Select Project -->
            <div class="form-group d-none mb-3" id="project_select_div">
                <label>Select Project <span class="required">*</span></label>
                <select class="form-control select2" name="project_id">
                    <option value="">-- Select Project --</option>
                    @foreach($projects as $id => $name)
                    <option value="{{ $id }}" {{ old('project_id') == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
            @if($errors->has('project_id'))
                <div class="text-danger">{{ $errors->first('project_id') }}</div>
            @endif
        </div>

            <!-- Select Ticket -->
            <div class="form-group d-none mb-3" id="ticket_select_div">
                <label>Select Ticket <span class="required">*</span></label>
                <select class="form-control select2" name="ticket_id">
                    <option value="">-- Select Ticket --</option>
                    @foreach($tickets as $id => $title)
                        <option value="{{ $id }}" {{ old('ticket_id') == $id ? 'selected' : '' }}>{{ $title }}</option>
                    @endforeach
                </select>
                @if($errors->has('ticket_id'))
                    <div class="text-danger">{{ $errors->first('ticket_id') }}</div>
                @endif
            </div>

            <!-- 2. Domain -->
            <div class="form-group mb-3">
                <label>Domain <span class="required">*</span></label>
                <input type="text" class="form-control inputbackupbox" name="domain" value="{{ old('domain') }}">
                @if($errors->has('domain'))
                  <div class="text-danger">{{ $errors->first('domain') }}</div>
                @endif
            </div>


            <!-- 3. Present IP -->
            <div class="form-group mb-3">
                <label>Present IP <span class="required">*</span></label>
                <input type="text" class="form-control inputbackupbox" name="present_ip" value="{{ old('present_ip') }}">
                @if($errors->has('present_ip'))
                   <div class="text-danger">{{ $errors->first('present_ip') }}</div>
                @endif
            </div>

            <!-- 4. Last Backup File Name -->
            <div class="form-group mb-3">
                <label>Last Backup File Name <span class="required">*</span></label>
                <input type="text" class="form-control inputbackupbox" name="last_backup_file"value="{{ old('last_backup_file') }}">
                @if($errors->has('last_backup_file'))
                    <div class="text-danger">{{ $errors->first('last_backup_file') }}</div>
                @endif
            </div>

            <!-- 5. Last Backup Date -->
            <div class="form-group mb-3">
                <label>Last Backup Date <span class="required">*</span></label>
                <input type="date" class="form-control inputbackupbox" name="last_backup_date" value="{{ old('last_backup_date') }}">
                @if($errors->has('last_backup_date'))
                    <div class="text-danger">{{ $errors->first('last_backup_date') }}</div>
                @endif
            </div>


            <!-- 6. Last Backup Location -->
            <div class="form-group mb-3">
                <label>Last Backup Location <span class="required">*</span></label>
                <input type="text" class="form-control inputbackupbox" name="last_backup_location"value="{{ old('last_backup_location') }}">
                @if($errors->has('last_backup_location'))
                    <div class="text-danger">{{ $errors->first('last_backup_location') }}</div>
                @endif
            </div>

            <!-- 7. Backup Type -->
            <div class="form-group mb-3">
                <label>Backup Type <span class="required">*</span></label>
                <select class="form-control inputbackupbox" name="backup_type">
                    <option value="">-- Select --</option>
                    <option value="1" {{ old('backup_type') == 1 ? 'selected' : '' }}>Website Code</option>
                    <option value="2" {{ old('backup_type') == 2 ? 'selected' : '' }}>Application Code</option>
                    <option value="3" {{ old('backup_type') == 3 ? 'selected' : '' }}>Website and App Code</option>
                    <option value="4" {{ old('backup_type') == 4 ? 'selected' : '' }}>Database File</option>
                    <option value="5" {{ old('backup_type') == 5 ? 'selected' : '' }}>Website Code + DB File</option>
                    <option value="6" {{ old('backup_type') == 6 ? 'selected' : '' }}>App Code + DB File</option>
                    <option value="7" {{ old('backup_type') == 7 ? 'selected' : '' }}>Website Code + App Code + DB Files</option>
                    <option value="8" {{ old('backup_type') == 8 ? 'selected' : '' }}>Graphics File</option>
                </select>
                @if($errors->has('backup_type'))
                    <div class="text-danger">{{ $errors->first('backup_type') }}</div>
                @endif
            </div>

            <!-- 8. Wordpress Version -->
            <div class="form-group mb-3">
                <label>Wordpress Version</label>
                <input type="text" class="form-control inputbackupbox" name="wordpress_version"value="{{ old('wordpress_version') }}">
                @if($errors->has('wordpress_version'))
                    <div class="text-danger">{{ $errors->first('wordpress_version') }}</div>
                @endif
            </div>

            <!-- 9. PHP Version -->
            <div class="form-group mb-3">
                <label>PHP Version</label>
                <input type="text" class="form-control inputbackupbox" name="php_version"value="{{ old('php_version') }}">
                @if($errors->has('php_version'))
                    <div class="text-danger">{{ $errors->first('php_version') }}</div>
                @endif
            </div>

            <!-- 10. Framework Version -->
            <div class="form-group mb-3">
                <label>Framework Version</label>
                <input type="text" class="form-control inputbackupbox" name="framework_version"value="{{ old('framework_version') }}">
                @if($errors->has('framework_version'))
                    <div class="text-danger">{{ $errors->first('framework_version') }}</div>
                @endif
            </div>

            <!-- 11. Drive Link -->
            <div class="form-group mb-3">
                <label>Drive Link</label>
                <input type="url" class="form-control inputbackupbox" name="drive_link"value="{{ old('drive_link') }}">
                @if($errors->has('drive_link'))
                    <div class="text-danger">{{ $errors->first('drive_link') }}</div>
                @endif
            </div>

            <!-- 12. Site Status -->
            <div class="form-group mb-3">
                <label>Site Status <span class="required">*</span></label>
                <select class="form-control inputbackupbox" name="site_status">
                    <option value="1" {{ old('site_status', 1) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="2" {{ old('site_status') == 2 ? 'selected' : '' }}>Inactive</option>
                    <option value="3" {{ old('site_status') == 3 ? 'selected' : '' }}>Terminated</option>
                    <option value="4" {{ old('site_status') == 4 ? 'selected' : '' }}>Not Applicable</option>
                </select>
                @if($errors->has('site_status'))
                    <div class="text-danger">{{ $errors->first('site_status') }}</div>
                @endif
            </div>

            <!-- 13. Description -->
            <div class="form-group mb-3">
                <label>Description</label>
                <textarea class="form-control inputbackupbox" name="description" rows="3">{{ old('description') }}</textarea>
                @if($errors->has('description'))
                    <div class="text-danger">{{ $errors->first('description') }}</div>
                @endif
            </div>

            <!-- Submit -->
            
            <div class="subbtn gap-2">
                <button type="submit" class="btn dailytsksybbtn fw-bold">Submit</button>
                <a href="{{ route('admin.backup_manage') }}" class="btn btn-secondary fw-bold">Cancel</a>
            </div> 
           
        </form>
    </div>
</div>

<script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
<script src="{{ asset('js/template.js') }}"></script>
@push('after-scripts')
    <script src="{{ asset('js/backend/backup.js') }}"></script>
@endpush


@endsection

