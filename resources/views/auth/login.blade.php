<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>School | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/assets/school/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('public/assets/school/css/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/assets/school/css/adminlte.min.css') }}">

  <style>
    .login-card-body, .register-card-body {
      background-color: #00000000;
      border-top: 0;
      color: #fff;
      padding: 20px;
      box-shadow: -1px 4px 28px 0px rgb(9 197 242);
    }

    .card1 {
      background-color: #00000091 !important;
      border-radius: .25rem;
    }

    span {
      color: #09c5f2;
    }

    .btn.btn-primary {
      background: #09c5f2;
      border: 1px solid #09c5f2;
      color: #fff;
    }

    .btn.btn-primary:hover {
      border: 1px solid #ffffff;
      background: transparent;
      color: #ffffff;
    }
  </style>
</head>

<body class="hold-transition login-page" style="background-image: url('https://images.unsplash.com/photo-1599725427295-6ed79ff8dbef?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8c2Nob29sJTIwYnVpbGRpbmd8ZW58MHx8MHx8&w=1000&q=80'); background-repeat: no-repeat; background-size: 100% 100%;">

<div class="login-box">
  <div class="card card1 mt-4">
    <div class="card-body login-card-body">
      <center><img src="{{ asset('public/images/header-logo.png') }}" width="60%"></center>
      <h1 class="pt-3 pb-3 text-center">Welcome to School</h1>

      <!-- ✅ AJAX Login Form -->
      <form id="loginForm">
        @csrf
        <div class="input-group mb-3">
          <input type="text" name="user_name" class="form-control" placeholder="User Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span>&#9993;</span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span>&#128274;</span>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-10">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">I'm a Student</label>
            </div>
          </div><br><br>
          <div class="col-4"></div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <div class="col-4"></div>
        </div>
      </form>

      <br>
      <div id="login-error" style="color: red;"></div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('public/assets/school/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/assets/school/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/assets/school/js/adminlte.min.js') }}"></script>

<!-- ✅ AJAX Script -->
<script>
  $(document).ready(function () {
    $('#loginForm').on('submit', function (e) {
      e.preventDefault();

      $('#login-error').text('');

      $.ajax({
        url: "http://localhost/library/api/loginAuth",
        type: "POST",
        data: {
          user_name: $('input[name="user_name"]').val(),
          password: $('input[name="password"]').val(),
          _token: '{{ csrf_token() }}'
        },
        success: function (response) {
          if (response.success) {
            window.location.href = response.redirect_to || "/dashboard";
          } else {
            $('#login-error').text(response.message || 'Login failed');
          }
        },
        error: function (xhr) {
          let response = xhr.responseJSON;
          let errors = response?.errors || {};
          let errorText = response?.message || "Something went wrong";

          for (let field in errors) {
            errorText += "\n" + errors[field][0];
          }

          $('#login-error').text(errorText);
        }
      });
    });
  });
</script>

</body>
</html>
