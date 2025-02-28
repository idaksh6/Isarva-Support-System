@extends('backend.layouts.app')

@section('title', __('User Management'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    {{--<x-backend.card>
        <x-slot name="header">
            @lang('User Management')
        </x-slot>

        @if ($logged_in_user->hasAllAccess())
            <x-slot name="headerActions">
                <x-utils.link
                    icon="c-icon cil-plus"
                    class="card-header-action"
                    :href="route('admin.auth.user.create')"
                    :text="__('Create User')"
                />
            </x-slot>
        @endif

        <x-slot name="body">
            <livewire:backend.users-table />
        </x-slot>
    </x-backend.card>--}}
    <div class="container-xxl">
        <div class="card mb-4 border-0">
            <div class="card-body">
            <div>
                <a class="btn btn-primary pull-right" href="{{route('admin.auth.user.create')}}" >Create User</a>
            </div>
            <table id="myTransaction" class="table display dataTable table-hover align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th>TYPE.</th>
                        <th>NAME</th>
                        <th>E-MAIL</th>
                        <th>VERIFIED</th>
                        <th>2FA</th>
                        <th>ROLES</th>
                        <th>ADDITIONAL PERMISSIONS</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->type }}</td>
                        <td>{{ ucwords($user->name) }}</td>
                        <td><span class="text-muted">{{ $user->email }}</span></td>
                        <td><span class="text-muted">Yes</span></td>
                        <td>@include('backend.auth.user.includes.confirm', ['user' => $user])</td>
                        <td><span class="col-green">{{ $user->roles_label }}</span></td>
                        <td>{{ $user->updated_at->diffForHumans() }}</td>
                        <td>
                            @include('backend.auth.user.includes.actions', ['user' => $user])
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        </div>
    </div>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
