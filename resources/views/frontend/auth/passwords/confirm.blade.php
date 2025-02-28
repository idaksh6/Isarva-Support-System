@extends('frontend.layouts.login')

@section('title', __('Login'))

@section('content')
    <div class="container-xxl py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <x-frontend.card>
                    <x-slot name="body">
                        <x-forms.post :action="route('frontend.auth.password.confirm')">
                            <div class="row g-0">
                                <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                                    <div style="max-width: 25rem;">
                                        <div class="text-center mb-5">
                                            <svg  width="4rem" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                                <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                                                <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                                            </svg>
                                        </div>
                                        <div class="mb-5">
                                            <h2 class="color-900 text-center">My-Task Let's Management Better</h2>
                                        </div>
                                        <!-- Image block -->
                                        <div class="">
                                            <img src="{{ url('/').'/images/login-img.svg' }}" alt="online-study">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                                    <div class="w-100 p-4 p-md-5 card border-0 bg-dark text-light">
                                        <div class="col-12 text-center mb-5">
                                            <h1>@lang('Please confirm your password before continuing.')</h1>
                                        </div>
                                        <div class="form-group row g-1 p-0 p-4">
                                            <label for="password" class="form-label">@lang('Password')</label>
                                            <input type="password" name="password" class="form-control form-control-lg" placeholder="{{ __('Password') }}" maxlength="100" required autocomplete="current-password" />
                                        </div><!--form-group-->
                                        <div class="form-group row g-1 p-0 p-4">
                                            <div class="col-md-6 offset-md-4">
                                                <button class="btn btn-lg btn-block btn-light lift text-uppercase" type="submit">@lang('Confirm Password')</button>
                                            </div>
                                        </div><!--form-group-->
                                    </div>
                                </div>
                            </div>
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div><!--container-->
@endsection
