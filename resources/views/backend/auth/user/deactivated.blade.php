@extends('backend.layouts.app')

@section('title', __('Deactivated Users'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('Deactivated Users')
        </x-slot>

        <x-slot name="body">
            <livewire:backend.users-table status="deactivated" />
        </x-slot>
    </x-backend.card>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
