<!DOCTYPE html>
<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title>Login</title>

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons -->
  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="../assets/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

  <!-- Page CSS -->
  <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />

  <!-- Helpers -->
  <script src="../assets/vendor/js/helpers.js"></script>
  <script src="../assets/js/config.js"></script>

  <style>
    .card {
      max-width: 450px;
      margin: 0 auto;
    }

    .app-brand {
      gap: 0.75rem !important;
    }

    .app-brand-link {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      text-decoration: none;
    }

    .app-brand-logo img {
      height: 2.5rem;
      width: auto;
    }

    .brand-text-wrapper {
      display: flex;
      flex-direction: column;
      gap: 0.125rem;
    }

    .app-brand-text {
      font-size: 1.125rem;
      font-weight: 700;
      line-height: 1.2;
      margin: 0;
    }

    .university-name {
      font-size: 0.75rem;
      color: #697a8d;
      font-weight: 500;
      margin: 0;
      line-height: 1.2;
    }

    @media (max-width: 575.98px) {
      .card {
        max-width: 100%;
      }

      .app-brand-logo img {
        height: 2rem;
      }

      .app-brand-text {
        font-size: 1rem;
      }

      .university-name {
        font-size: 0.65rem;
      }
    }
  </style>
</head>
<body style="background: url('{{ asset('images/bg.png') }}') no-repeat center center fixed; background-size: cover;">

<div class="container-xxl">
  <div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
      <div class="card">
        <div class="card-body">
          <!-- Logo -->
          <div class="app-brand justify-content-center">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Gradys">
              </span>
              <div class="brand-text-wrapper">
                <span class="app-brand-text demo text-body fw-bolder">GRAD-SYSTEM</span>
                <span class="university-name">HORIZON UNIVERSITY INDONESIA</span>
              </div>
            </a>
          </div>
          <!-- /Logo -->

          <h5 class="mb-2">Selamat Datang Calon Wisudawan!🎓</h5>
          <p class="mb-4">Silahkan Masuk ke Akun Anda!</p>

          <!-- Session Success -->
          @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
          @endif

          <!-- Login Form -->
<form method="POST" action="{{ route('login.submit') }}">
  @csrf

  <div class="mb-3">
    <label for="username" class="form-label">Username / NIM</label>
    <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" 
           id="username" value="{{ old('username') }}" autofocus />
    @error('username')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3 form-password-toggle">
    <label for="password" class="form-label">Password</label>
    <div class="input-group input-group-merge">
      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" 
             id="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" />
      <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
    </div>
    @error('password')
      <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <label class="form-label">Captcha</label>
    <div class="d-flex align-items-center mb-2">
      <img src="{{ captcha_src('flat') }}" alt="captcha" id="captcha-image">
      <button type="button" onclick="refreshCaptcha()" class="btn btn-outline-secondary btn-sm ms-2">↻</button>
    </div>
    <input type="text" name="captcha" class="form-control @error('captcha') is-invalid @enderror" 
           placeholder="Masukkan teks di atas">
    @error('captcha')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-3">
    <button type="submit" class="btn btn-primary d-grid w-100">Login</button>
  </div>

  <!-- Fallback untuk error lainnya -->
  @if($errors->any() && !$errors->has('username') && !$errors->has('password') && !$errors->has('captcha'))
    <div class="alert alert-danger mt-2">
      @foreach($errors->all() as $error)
        <p class="mb-0">{{ $error }}</p>
      @endforeach
    </div>
  @endif
</form>
          
    <p class="text-center mt-4">
            <span>Belum Terdaftar?</span>
            <a href="{{ route('register.form') }}"><span>Register</span></a>
          </p>
          

          <p class="text-center">
            <a href="{{ route('forgot.form') }}"><span>Lupa Kata Sandi?</span></a>
          </p>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
function refreshCaptcha() {
    document.getElementById('captcha-image').src = "{{ captcha_src('flat') }}?" + Math.random();
}
</script>

<!-- Core JS -->
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="../assets/vendor/js/menu.js"></script>
<script src="../assets/js/main.js"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>