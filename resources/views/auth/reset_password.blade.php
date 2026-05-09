<!DOCTYPE html>
<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================
* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)
========================================================= -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../assets/"
  data-template="vertical-menu-template-free">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <title>Reset Password - Sistem Wisuda | Sneat</title>
    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          
          <!-- Step 2: Reset Password -->
          <div class="card mb-4">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Gradys" style="height: 60px; width: auto;">
              </span>
              <div class="brand-text-wrapper">
                <span class="app-brand-text demo text-body fw-bolder">GRAD-SYSTEM</span> <br>
                <span class="university-name">HORIZON UNIVERSITY INDONESIA</span>
              </div>
            </a>
          </div>
              <!-- /Logo -->
              
              <h4 class="mb-2">Reset Password 🔐</h4>
              <p class="mb-4">Step 2: Enter OTP code from your email and set new password</p>
              
              <!-- Display Success/Error Messages -->
              @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              
              @if(session('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                  {{ session('error') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              
              @if($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                  <ul class="mb-0">
                    @foreach($errors->all() as $error)
                      <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

              <form action="{{ route('forgot.resetPassword') }}" method="POST" class="mb-3">
                @csrf
                <div class="mb-3">
                  <label for="username_reset" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username_reset"
                    name="username"
                    placeholder="Enter your username"
                    value="{{ session('username') ?? old('username') }}"
                    required
                    readonly
                  />
                </div>
                
                <div class="mb-3">
                  <label for="otp_code" class="form-label">OTP Code</label>
                  <input
                    type="text"
                    class="form-control"
                    id="otp_code"
                    name="otp_code"
                    placeholder="Enter OTP code from email"
                    value="{{ old('otp_code') }}"
                    required
                    autofocus
                  />
                  <small class="text-muted">Check your email for the OTP code</small>
                </div>
                
                <div class="mb-3 form-password-toggle">
                  <label for="new_password" class="form-label">New Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      class="form-control"
                      id="new_password"
                      name="new_password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                
                <div class="mb-3 form-password-toggle">
                  <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      class="form-control"
                      id="new_password_confirmation"
                      name="new_password_confirmation"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      required
                    />
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                
                <button type="submit" class="btn btn-success d-grid w-100">Reset Password</button>
              </form>
              
              <div class="text-center">
                <a href="{{ route('login.form') }}" class="d-flex align-items-center justify-content-center">
                  <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                  Back to login
                </a>
              </div>
            </div>
          </div>
          <!-- /Step 2: Reset Password -->
          
        </div>
      </div>
    </div>
    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../assets/vendor/libs/popper/popper.js"></script>
    <script src="../assets/vendor/js/bootstrap.js"></script>
    <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="../assets/js/main.js"></script>

    <!-- Page JS -->
    <script>
      // Password toggle functionality
      document.addEventListener('DOMContentLoaded', function() {
        const togglePasswordButtons = document.querySelectorAll('.form-password-toggle .input-group-text');
        
        togglePasswordButtons.forEach(function(button) {
          button.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
               input.type = 'text';
               icon.classList.remove('bx-hide');
               icon.classList.add('bx-show');
            } else {
               input.type = 'password';
               icon.classList.remove('bx-show');
               icon.classList.add('bx-hide');
            }
          });
        });
      });
    </script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
  </body>
</html>
