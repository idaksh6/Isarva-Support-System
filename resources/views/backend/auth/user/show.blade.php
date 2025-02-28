@extends('backend.layouts.app')

@section('title', __('View User'))

@section('content')
    <x-backend.card>
        <x-slot name="header">
            @lang('View User')
        </x-slot>

        <x-slot name="headerActions">
            <x-utils.link class="card-header-action" :href="route('admin.auth.user.index')" :text="__('Back')" />
        </x-slot>

        <x-slot name="body">
             <div class="w-100 p-4 p-md-5 card border-0">
    <div class="row g-3 pb-5 border-bottom">
        <div class="col-sm-12">
            <span><img src="{{ $user->avatar }}" class="user-profile-image" /></span>
            <span class="d-inline-block mt-2 ms-2">@lang('Avatar')</span>
        </div>
    </div>

    <div class="row g-3 py-2 border-bottom">
        <div class="col-sm-6">
            <span>@lang('Type')</span>
        </div>
        <div class="col-sm-6">
            <span>@include('backend.auth.user.includes.type')</span>
        </div>
    </div>

    <div class="row g-3 py-2 border-bottom">
        <div class="col-sm-6">
            <span>@lang('Name')</span>
        </div>
        <div class="col-sm-6">
            <span>{{ $user->name }}</span>
        </div>
    </div>

    <div class="row g-3 py-2 border-bottom">
        <div class="col-sm-6">
            <span>@lang('E-mail Address')</span>
        </div>
        <div class="col-sm-6">
            <span>{{ $user->email }}</span>
        </div>
    </div>

    <div class="row g-3 py-2 border-bottom">
        <div class="col-sm-6">
            <span>@lang('Status')</span>
        </div>
        <div class="col-sm-6">
            <span>@include('backend.auth.user.includes.status', ['user' => $user])</span>
        </div>
    </div>

    <div class="row g-3 py-2 border-bottom">
        <div class="col-sm-6">
            <span>@lang('Verified')</span>
        </div>
        <div class="col-sm-6">
            <span>@include('backend.auth.user.includes.verified', ['user' => $user])</span>
        </div>
    </div>

    <div class="row g-3 py-2 border-bottom">
        <div class="col-sm-6">
            <span>@lang('2FA')</span>
        </div>
        <div class="col-sm-6">
            <span>@include('backend.auth.user.includes.2fa', ['user' => $user])</span>
        </div>
    </div>

    <div class="row g-3 py-2 border-bottom">
        <div class="col-sm-6">
            <span>@lang('Timezone')</span>
        </div>
        <div class="col-sm-6">
            <span>{{ $user->timezone ?? __('N/A') }}</span>
        </div>
    </div>

    <div class="row g-3 py-2 border-bottom">
        <div class="col-sm-6">
            <span>@lang('Last Login At')</span>
        </div>
        <div class="col-sm-6">
            <span>
                @if($user->last_login_at)
                    @displayDate($user->last_login_at)
                @else
                    @lang('N/A')
                @endif
            </span>
        </div>
    </div>

    <div class="row g-3 py-2 border-bottom">
        <div class="col-sm-6">
            <span>@lang('Last Known IP Address')</span>
        </div>
        <div class="col-sm-6">
            <span>{{ $user->last_login_ip ?? __('N/A') }}</span>
        </div>
    </div>

    @if ($user->isSocial())
    <div class="row g-3 py-2 border-bottom">
        <div class="col-sm-6">
            <span>@lang('Provider')</span>
            <span>{{ $user->provider ?? __('N/A') }}</span>
        </div>
        <div class="col-sm-6">
            <span>@lang('Provider ID')</span>
            <span>{{ $user->provider_id ?? __('N/A') }}</span>
        </div>
    </div>
    @endif

    <div class="row g-3 py-2 border-bottom">
        <div class="col-sm-6">
            <span>@lang('Roles')</span>
        </div>
        <div class="col-sm-6">
            <span>{!! $user->roles_label !!}</span>
        </div>
    </div>

    <div class="row g-3 py-2 border-bottom">
        <div class="col-sm-6">
            <span>@lang('Additional Permissions')</span>
        </div>
        <div class="col-sm-6">
            <span>{!! $user->permissions_label !!}</span>
        </div>
    </div>
</div>
        </x-slot>

        <x-slot name="footer">
            <small class="float-right text-muted">
                <strong>@lang('Account Created'):</strong> @displayDate($user->created_at) ({{ $user->created_at->diffForHumans() }}),
                <strong>@lang('Last Updated'):</strong> @displayDate($user->updated_at) ({{ $user->updated_at->diffForHumans() }})

                @if($user->trashed())
                    <strong>@lang('Account Deleted'):</strong> @displayDate($user->deleted_at) ({{ $user->deleted_at->diffForHumans() }})
                @endif
            </small>
        </x-slot>
    </x-backend.card>
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
@endsection
