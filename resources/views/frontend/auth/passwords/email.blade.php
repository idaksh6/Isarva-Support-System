@extends('frontend.layouts.login')

@section('title', __('Reset Password'))

@section('content')
<!-- main body area -->
<div class="main p-2 py-3 p-xl-5">

<!-- Body: Body -->
<div class="body d-flex p-0 p-xl-5">
    <div class="container-xxl">

        <div class="row g-0">
            <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                <div style="max-width: 25rem;">
                    <div class="text-center mb-5">
                        <svg  width="4rem"  fill="none" class="bi bi-app-indicator" viewBox="0 0 16 16">
                            <path class="fill-primary" d="M5.5 2A3.5 3.5 0 0 0 2 5.5v5A3.5 3.5 0 0 0 5.5 14h5a3.5 3.5 0 0 0 3.5-3.5V8a.5.5 0 0 1 1 0v2.5a4.5 4.5 0 0 1-4.5 4.5h-5A4.5 4.5 0 0 1 1 10.5v-5A4.5 4.5 0 0 1 5.5 1H8a.5.5 0 0 1 0 1H5.5z"/>
                            <path class="fill-primary" d="M16 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        </svg>
                    </div>
                    <div class="mb-5">
                        <h2 class="color-900 text-center">My-Task Let's Management Better</h2>
                    </div>
                    <!-- Image block -->
                    <div class="">
                        <img src="{{ asset('public/images/online-study.svg') }}" alt="online-study">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                <div class="w-100 p-4 p-md-5 card border-0 bg-dark text-light" style="max-width: 32rem;">
                    <!-- Form -->
                    <form class="row g-1 p-0 p-4">
                        <div class="col-12 text-center mb-5">
                            <img src="/images/forgot-password.svg" class="w240 mb-4" alt="" />
                            <h1>Forgot password?</h1>
                            <span>Enter the email address you used when you joined and we'll send you instructions to reset your password.</span>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label class="form-label">Email address</label>
                                <input type="email" class="form-control form-control-lg" placeholder="name@example.com">
                            </div>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <a href="{{route('admin.authentication.two-step-authentication')}}" title="" class="btn btn-lg btn-block btn-light lift text-uppercase">SUBMIT</a>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <span class="text-muted"><a href="{{route('frontend.auth.login')}}" class="text-secondary">Back to Sign in</a></span>
                        </div>
                    </form>
                    <!-- End Form -->
                    <div class="d-flex justify-content-between flex-wrap">
                        <div>
                            <a href="#" class="me-2 text-muted"><i class="fa fa-facebook-square fa-lg"></i></a>
                            <a href="#" class="me-2 text-muted"><i class="fa fa-github-square fa-lg"></i></a>
                            <a href="#" class="me-2 text-muted"><i class="fa fa-linkedin-square fa-lg"></i></a>
                            <a href="#" class="me-2 text-muted"><i class="fa fa-twitter-square fa-lg"></i></a>
                        </div>
                        <div>
                            <a href="#" title="home" class="me-2 text-muted">Home</a>
                            <a href="#" title="about" class="me-2 text-muted">About Us</a>
                            <a href="#" title="faq" class="me-2 text-muted">FAQs</a>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Row -->

    </div>
</div>

</div>
    {{-- <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <x-frontend.card>
                    <x-slot name="header">
                        @lang('Reset Password')
                    </x-slot>

                    <x-slot name="body">
                        <x-forms.post :action="route('frontend.auth.password.email')">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">@lang('E-mail Address')</label>

                                <div class="col-md-6">
                                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="{{ __('E-mail Address') }}" maxlength="255" required autofocus autocomplete="email" />
                                </div>
                            </div><!--form-group-->

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary" type="submit">@lang('Send Password Reset Link')</button>
                                </div>
                            </div><!--form-group-->
                        </x-forms.post>
                    </x-slot>
                </x-frontend.card>
            </div><!--col-md-8-->
        </div><!--row-->
    </div> --}}
    <!--container-->
@endsection
