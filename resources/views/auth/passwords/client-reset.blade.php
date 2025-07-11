<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title>Reset Password</title>
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f0f2f5;
    }

    .container {
      max-width: 600px;
      margin: 60px auto;
      padding: 20px;
    }

    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .card-header {
      background-color: #007bff;
      color: #fff;
      padding: 16px 24px;
      font-size: 1.25rem;
      font-weight: bold;
    }

    .card-body {
      padding: 24px;
    }

    .form-group {
      margin-bottom: 16px;
    }

    label {
      display: block;
      margin-bottom: 6px;
      font-weight: 600;
      color: #333;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      transition: border-color 0.3s, box-shadow 0.3s;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
      outline: none;
    }

    .invalid-feedback {
      color: #dc3545;
      font-size: 0.875rem;
      margin-top: 4px;
    }

    .btn-primary {
      background-color: #007bff;
      color: #fff;
      border: none;
      padding: 10px 20px;
      font-size: 1rem;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }


    .clientrestpaswrdsection {
      position: relative;
    }

    .password-toggle {
        position: absolute;
        top: 68%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    
        color: #aaa;
        z-index: 2;
    }

    /* For new password toggle field */
    input[type="text"] {    
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 1rem;
        transition: border-color 0.3s, box-shadow 0.3s;
      }

        @media (max-width: 600px) {
          .container {
            margin: 20px;
            padding: 10px;
          }

          .card-body {
            padding: 16px;
          }
        }

  
  </style>
</head>
<body>

  <div class="container">
    <div class="card">
      <div class="card-header">Reset Password</div>
      <div class="card-body">
        <form method="POST" action="{{ route('client.password.update') }}">
          @csrf

          <input type="hidden" name="token" value="{{ $token }}">
          {{-- <input type="hidden" name="email_id" value="{{ $email_id }}"> --}}

          <div class="form-group">
            <label for="email_id">Email Address</label>
            <input id="email_id" type="email" name="email_id"
              class="@error('email_id') is-invalid @enderror"
              value="{{ $email_id ?? old('email_id') }}" required autocomplete="email" />

            @error('email_id')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <div class="form-group clientrestpaswrdsection">
            <label for="password">New Password</label>
            <input id="clientresetinput_password" type="password" name="password" class="@error('password') is-invalid @enderror" required autocomplete="new-password" />

              <!-- Eye Icon -->
              <span class="password-toggle" id="clientresetinput_togglePassword">
                  👁️
              </span>

                                    
            @error('password')
            <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          {{-- <div class="form-group">
            <label for="password-confirm">Confirm Password</label>
            <input id="password-confirm" type="password" name="password_confirmation"
              required autocomplete="new-password" />
          </div> --}}

          <div class="form-group">
            <label for="password-confirm">Confirm Password</label>
            <div style="position: relative;">
              <input id="password-confirm" type="password" name="password_confirmation"
                required autocomplete="new-password" style="padding-right: 40px;" />
              <span id="toggle-password-confirm" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                👁️
              </span>
            </div>
          </div>


          <button type="submit" class="btn-primary">Reset Password</button>
        </form>
      </div>
    </div>
  </div>

</body>


<script>
   // Toggle for New Password
    const togglePasswordNew = document.getElementById('clientresetinput_togglePassword');
    const passwordFieldNew = document.getElementById('clientresetinput_password');

    togglePasswordNew.addEventListener('click', function () {
        const type = passwordFieldNew.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordFieldNew.setAttribute('type', type);

        // Toggle the icon (assuming <i> element exists — if not, you can update textContent instead)
        this.textContent = type === 'password' ? '👁️' : '🚫';
    });

    // Toggle for Confirm Password
    const togglePasswordConfirm = document.getElementById('toggle-password-confirm');
    const passwordFieldConfirm = document.getElementById('password-confirm');

    togglePasswordConfirm.addEventListener('click', function () {
        const type = passwordFieldConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordFieldConfirm.setAttribute('type', type);

        // Toggle the icon
        this.textContent = type === 'password' ? '👁️' : '🚫';
    });
</script>
</html>




