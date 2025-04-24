@extends('frontend.layouts.login')

@section('title', __('Login   | Isarva Support'))

@section('content')

<style>


</style>
<!-- main body area -->
<div class="main p-2 py-3 p-xl-5 ">
    <!-- Body: Body -->
    <div class="body d-flex p-0 p-xl-5">
        <div class="container-xxl">

            <div class="row g-0">
                <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                    <div style="max-width: 25rem;">
                      
                        <div class="text-center mb-5">
                            <img src="{{ asset('images/logoisarva-1.svg') }}" alt="Company Logo" style="height: 6rem;">
                        </div>
                        
                         <div class="mb-5">
                            <h2 class="color-900 text-center">My-Task Let's Management Better</h2>
                        </div>

                        @if(session('error'))
                        <div class="alert alert-danger border-0 bg-gradient" style="background: red; color: white;">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-shield-lock-fill me-2 fs-4"></i>
                                <strong>Access Restricted</strong>
                            </div>
                            <hr class="my-2">
                            <p> No Access to this account </p>
                           
                        </div>
                        @endif
                        <!-- Image block -->
                        <div class="">
                            {{-- <img src="{{ url('/').'/images/login-img.svg' }}" alt="login-img"> --}}
                            <img src = "{{ asset('images/Ticktet-Management-software-1.svg')}}" alt="Company Logo" style="width: 100%;">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                    <div class="w-100 p-3 p-md-5 card border-0 bg-dark text-light" style="max-width: 32rem;">
                        <!-- Form -->
                        <form class="row g-1 p-0 p-4" method="post" action="{{route('frontend.auth.login')}}">


                            @if($errors->any())
                                <div class="alert alert-danger border-0" style="
                                    background: white;
                                    border-left: 4px solid #dc3545;
                                ">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-exclamation-triangle-fill me-2 fs-4" style="color: #dc3545;"></i>
                                        <strong style="color: #dc3545;">Login Error</strong>
                                    </div>
                                    <hr class="my-2" style="border-color: rgba(220,53,69,0.3);">
                                    <div class="small" style="color: #721c24;">
                                        @foreach ($errors->all() as $error)
                                            <div  style="color: red; font-weight: bold;">{{ $error }}</div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            @csrf
                            <div class="col-12 text-center mb-5">
                                <h1>Sign in</h1>
                                {{-- <span>Free access to our dashboard.</span> --}}
                                {{-- <span class="d-flex justify-content-center text-secondary">Email : admin@admin.com</span>
                                <span class="d-flex justify-content-center text-secondary">Password : secret</span> --}}
                            </div>

                            
                            <div class="col-12 text-center mb-4">
                                {{-- <a class="btn btn-lg btn-outline-secondary btn-block" href="#">
                                    <span class="d-flex justify-content-center align-items-center">
                                        <img class="avatar xs me-2" src="{{ url('/').'/images/google.svg' }}" alt="Image Description">
                                        Sign in with Google
                                    </span>
                                </a> --}}
                                <a class="btn btn-lg btn-outline-secondary btn-block" href="{{ route('auth.google') }}">
                                    <span class="d-flex justify-content-center align-items-center">
                                        <img class="avatar xs me-2" src="{{ url('/').'/images/google.svg' }}" alt="Google Logo">
                                        Sign in with Google
                                    </span>
                                </a>
                                <span class="dividers text-muted mt-4">OR</span>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-label">Email address</label>
                                    <input type="email" name="email" class="form-control form-control-lg" placeholder="name@example.com" autocomplete="off">
                                    @error('email')
                                      <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-2">
                                    <div class="form-label">
                                        <span class="d-flex justify-content-between align-items-center">
                                            Password
                                            {{-- <a class="text-secondary" href="{{route('admin.authentication.password-reset')}}">Forgot Password?</a> --}}
                                        </span>
                                    </div>
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="***************">
                                    @error('password')
                                       <div class="invalid-feedback" style="color: red; font-weight: bold;">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    {{-- <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"> --}}
                                    {{-- <label class="form-check-label" for="flexCheckDefault">
                                        Remember me
                                    </label> --}}
                                </div>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase">SIGN IN</button>
                            </div>
                            <div class="col-12 text-center mt-4">
                                {{-- <span class="text-muted">Don't have an account yet? <a href="{{route('admin.authentication.signup')}}" class="text-secondary">Sign up here</a></span> --}}
                            </div>
                        </form>
                        <!-- End Form -->
                        
                    </div>
                </div>
            </div> <!-- End Row -->
            
        </div>
    </div>
</div>
@endsection
