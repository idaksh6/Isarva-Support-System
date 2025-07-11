{{-- @extends('backend.layouts.mainclient') <!-- Use your layout --> --}}

{{-- @section('content') --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Client Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f9fc;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 50px auto;
            max-width: 600px;
            padding: 20px;
        }

        .card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 15px 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .btn {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 18px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            color: #155724;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
        }

        .invalid-feedback {
            color: #e3342f;
            font-size: 14px;
        }

        .is-invalid {
            border-color: #e3342f;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="card-header">Reset Client Password</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('client.password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email_id">Email Address</label>
                    <input id="email_id" type="email" 
                           class="@error('email_id') is-invalid @enderror" 
                           name="email_id" value="{{ old('email_id') }}" required autocomplete="email" autofocus>

                    @error('email_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn">Send Password Reset Link</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>

{{-- @endsection --}}