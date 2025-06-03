<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Tci | Dashboard</title>

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

<body class="hold-transition login-page" style="position: relative; margin: 0;">
  <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
              background-image: url('{{ asset('/defaultImages/organization/banner.jpg') }}');
              background-repeat: no-repeat; background-size: 100% 100%; z-index: -2;">
  </div>

  <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;
              background-color: rgba(0, 0, 0, 0.4); z-index: -1;">
  </div>

<div class="login-box ">
  <div class="card card1 mt-4">
    <div class="card-body login-card-body  ">
      <center  class='pt-4'><img src="{{ asset('/defaultImages/organization/logo.jpeg') }}"style="border-radius:100px;opacity:0.8"  width="60%"></center>
      <h3 class="pt-3 pb-3 text-center">Welcome to Tci Edu.Hub</h3>

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
            <!-- <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">I'm a Student</label>
            </div> -->
          </div><br><br>
          <div class="col-4"></div>
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
         
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

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#loginForm').on('submit', function (e) {
    e.preventDefault();

    var baseUrl = "{{ url('/') }}";

    $('#login-error').text('');

    $.ajax({
      url: baseUrl + '/loginAuth',
      type: "POST",
      data: {
        user_name: $('input[name="user_name"]').val(),
        password: $('input[name="password"]').val(),
      },
      xhrFields: {
        withCredentials: true
      },
      success: function (response) {
        window.location.href = response.redirect_to || baseUrl + "/dashboard";
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
