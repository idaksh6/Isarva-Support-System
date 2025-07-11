<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Login</title>
    <link rel="icon" href="{{ asset('isarvafavicon.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
   <!-- Font Awesome CDN -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 5 admin template and web Application ui kit.">
    <title>Login | Isarva Support</title>
    {{-- <link href="{{ asset('/assets/my-task.style.min.css') }}" rel="stylesheet"> <!-- Favicon--> --}}
    <link rel="icon" href="{{ asset('isarvafavicon.png') }}">
    <!-- project css file  -->
    <link href="{{ asset('/assets/my-task.style.min.css') }}" rel="stylesheet">
    <style>

        body {

            background-color: #f8f9fa;
            height: 100vh;
        }
       
      
        .required{

            color: red;
        }

        .clientloginform{

            max-width: 32rem;
            height: 80VH;
            display: flex;
            justify-content: center;
        }

        .password-toggle {

            position: absolute;
            top: 65%;
            right: 1rem;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
            color: #aaa;
            z-index: 2;
            transition: color 0.3s ease;
        }


    </style>
</head>
<body>

<div id="mytask-layout" class="theme-indigo">
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
                            <h2 class="color-900 text-center">Track, Manage, Resolve — Fast and Simple.</h2>
                        </div>

                        
                        <!-- Image block -->
                        <div class="">
                            {{-- <img src="{{ url('/').'/images/login-img.svg' }}" alt="login-img"> --}}
                            <img src = "{{ asset('images/Ticktet-Management-software-1.svg')}}" alt="Company Logo" style="width: 100%;">
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                    <div class="w-100 p-3 p-md-5 card border-0 bg-dark text-light clientloginform" style="max-width: 32rem;">
                        <!-- Form -->
                      <form method="POST" action="{{ route('client.login') }}">
                       @csrf
                            <div class="col-12 text-center mb-5">
                                <h1>Client Log In</h1>

                                {{-- <span>Free access to our dashboard.</span> --}}
                                {{-- <span class="d-flex justify-content-center text-secondary">Email : admin@admin.com</span>
                                <span class="d-flex justify-content-center text-secondary">Password : secret</span> --}}
                            </div>

                            <div class="col-12">
                                <div class="mb-2">
                                    <label class="form-label">Username</label>
                                    <input type="text"  name="username" class="form-control form-control-lg" placeholder="name@example.com" value="{{ old('username') }}" >
                                  @error('username')
                                        <div class="text-danger ">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                {{-- <div class="mb-2">
                                    <div class="form-label">
                                        <span class="d-flex justify-content-between align-items-center">
                                            Password
                            
                                        </span>
                                    </div>
                                    <input type="password" name="password" class="form-control form-control-lg" placeholder="***************">
                                    @error('password')
                                            <div class="text-danger ">{{ $message }}</div>
                                    @enderror
                                </div> --}}
                                <div class="mb-2 position-relative">
                                    <div class="form-label">
                                        <span class="d-flex justify-content-between align-items-center">
                                            Password
                                        </span>
                                    </div>

                                    <input type="password" name="password" id="password-field" class="form-control form-control-lg" placeholder="***************">

                                    <!-- Eye Icon -->
                                    <span class="password-toggle" id="togglePassword">
                                        <i class="fa-solid fa-eye"></i>
                                    </span>

                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- forgot password field -->
                                <div class="form-label d-flex justify-content-end align-items-center ">
                                    <span class="">
                                        
                                        <a class="text-secondary" href="{{ route('client.password.request') }}">Forgot Password</a>
                                    </span>
                                </div>
                            </div>
                       
                            <div class="col-12 text-center mt-4">
                                <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase">LOG IN</button>
                            </div>
                            <!-- Inside your login form -->
                        
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
</div>
</body>



<script>
    const togglePassword = document.getElementById('togglePassword');
    const passwordField = document.getElementById('password-field');

    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);

        // Toggle the eye / eye-slash icon
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>


</html>
