@extends('backend.layouts.app')

@section('title', __('Role Management'))

@section('content')
    {{--<x-backend.card>
        <x-slot name="header">
            @lang('Role Management')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link
                icon="c-icon cil-plus"
                class="card-header-action"
                :href="route('admin.auth.role.create')"
                :text="__('Create Role')"
            />
        </x-slot>

        <x-slot name="body">
            <livewire:backend.roles-table />
        </x-slot>
    </x-backend.card>--}}
    <div class="container-xxl">
        <div class="card mb-4 border-0">
            <div class="card-body">
                <div class="d-flex">
                    <a class="btn btn-primary pull-right" href="{{route('admin.auth.role.create')}}" >Create Role</a>
                </div>
                <div class="table-responsive">
                    <table id="myTransaction" class="table display dataTable table-hover align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th>TYPE</th>
                                <th>NAME </th>
                                <th>PERMISSIONS</th>
                                <th>NUMBER OF USERS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                            <tr>
                                <td>{{ ucwords($role->type) }}</td>
                                <td>{{ ucwords($role->name) }}</td>
                                <td>
                                    @if($role->id === 1)
                                        <span class="badge bg-info">ALL</span>
                                    @else
                                        @if($role->permissions->count())
                                            @foreach($role->permissions as $permission)
                                                {{ ucwords($permission->name) }}
                                            @endforeach
                                        @else
                                            @lang('labels.general.none')
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $role->users->count() }}</td>
                                <td>
                                    <!-- {{ route('admin.auth.role.edit', $role) }} -->
                                    <a href="#" class="btn btn-info  mb-1"><i class="fa fa-search"></i> View </a> 
                                    <a href="#" class="btn btn-primary  mb-1"><i class="fa fa-pencil"></i> Edit </a>
                                    <!-- {{ route('admin.auth.role.destroy', $role) }} -->
                                    <a href="#" class="btn btn-danger  mb-1"><i class="fa fa-trash"></i> Delete </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
@endsection
