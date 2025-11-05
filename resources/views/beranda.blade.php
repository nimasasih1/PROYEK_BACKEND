@php
use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use Illuminate\Support\Facades\Auth;

$hasCatatan = false;

if (Auth::check()) {
    $user = Auth::user();
    $mahasiswa = Mahasiswa::where('nim', $user->username)->first();

    if ($mahasiswa) {
        $pendaftaran = PendaftaranWisuda::whereHas('mahasiswa', function ($q) use ($mahasiswa) {
            $q->where('nim', $mahasiswa->nim);
        })->latest()->first();

        if ($pendaftaran &&
            ($pendaftaran->catatan_fakultas ||
             $pendaftaran->catatan_perpus ||
             $pendaftaran->catatan_baak ||
             $pendaftaran->catatan_finance)) {
            $hasCatatan = true;
        }
    }
}
@endphp

@include('base.header')

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Raleway', sans-serif;
      overflow-x: hidden;
      background-color: #f8f9fa;
    }

    /* ========================================
           NAVBAR STYLES
           ======================================== */

    .navbar-top {
      box-shadow: 0 2px 6px 0 rgba(113, 67, 67, 0.12);
      background: #fff;
    }

    .navbar-brand-logo {
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .nav-link {
      color: #7f5656ff !important;
      font-weight: 500;
      padding: 0.5rem 1rem !important;
    }

    .nav-link:hover {
      color: #980517 !important;
    }

    .nav-link i {
      margin-right: 0.5rem;
      font-size: 1.125rem;
    }

    .dropdown-menu {
      border: 1px solid rgba(113, 67, 67, 0.1);
      box-shadow: 0 0.25rem 1rem rgba(184, 161, 161, 0.45);
    }

    .dropdown-item {
      padding: 0.5rem 1.5rem;
    }

    .dropdown-item:hover {
      background-color: rgba(255, 105, 105, 0.08);
      color: #980517;
    }

    /* ========================================
           MAIN CONTENT SECTION
           ======================================== */

    .main-content {
      position: relative;
      width: 100%;
      min-height: 700px;
      background: #F7F7F7;
      padding: 80px 20px;
      overflow: hidden;
    }

    .main-content .ellipse-bg {
      position: absolute;
      width: 700px;
      height: 700px;
      right: -100px;
      top: -50px;
      background: rgba(152, 5, 23, 0.1);
      border-radius: 50%;
      z-index: 0;
    }

    .main-content .container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: relative;
      z-index: 1;
    }

    .hero-text-container {
      max-width: 600px;
    }

    .hero-subtitle {
      font-weight: 400;
      font-size: 40px;
      color: #980517;
      margin-bottom: 10px;
    }

    .hero-title {
      font-weight: 600;
      font-size: 54px;
      line-height: 1.2;
      color: #000000;
      margin-bottom: 20px;
    }

    .hero-description {
      font-weight: 500;
      font-size: 18px;
      line-height: 1.6;
      color: #000000;
    }

    .hero-image {
      width: 400px;
      height: 500px;

      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 24px;

    }

    /* ========================================
           INFORMATION SECTION
           ======================================== */

    .info-section {
      position: relative;
      width: 100%;
      min-height: 600px;
      background: #FFFFFF;
      padding: 80px 20px;
      overflow: hidden;
    }

    .info-section .ellipse-bg {
      position: absolute;
      width: 500px;
      height: 500px;
      left: -100px;
      top: 50px;
      background: rgba(152, 5, 23, 0.1);
      border-radius: 50%;
      z-index: 0;
    }

    .info-section .container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: relative;
      z-index: 1;
    }

    .info-illustration {
      width: 450px;
      height: 450px;
      background: linear-gradient(135deg, rgba(152, 5, 23, 0.1) 0%, rgba(152, 5, 23, 0.05) 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 120px;
      color: #980517;
    }

    .info-text-container {
      max-width: 600px;
    }

    .info-label {
      font-weight: 400;
      font-size: 36px;
      color: #000000;
      margin-bottom: 10px;
    }

    .info-title {
      font-weight: 500;
      font-size: 48px;
      line-height: 1.2;
      color: #000000;
      margin-bottom: 20px;
    }

    .info-description {
      font-weight: 500;
      font-size: 18px;
      line-height: 1.6;
      color: #000000;
      margin-bottom: 30px;
    }

    .date-card {
      max-width: 600px;
      padding: 40px;
      background: linear-gradient(0deg, rgba(152, 5, 23, 0.9), rgba(152, 5, 23, 0.9));
      border-radius: 50px;
      text-align: center;
      box-shadow: 0 10px 30px rgba(152, 5, 23, 0.3);
    }

    .date-card .icon {
      font-size: 40px;
      margin-bottom: 10px;
      color: #F5E6E8;
    }

    .date-card .date-text {
      font-family: 'Radio Canada', sans-serif;
      font-weight: 600;
      font-size: 48px;
      color: #F5E6E8;
      margin-bottom: 15px;
    }

    .date-card .location-wrapper {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      font-family: 'Radio Canada', sans-serif;
      font-weight: 600;
      font-size: 18px;
      color: #F5E6E8;
    }

    /* ========================================
           STATISTICS SECTION
           ======================================== */

    .statistics-section {
      width: 100%;
      background: #980517;
      padding: 60px 20px;
    }

    .statistics-container {
      max-width: 1200px;
      margin: 0 auto;
      display: flex;
      justify-content: space-around;
      align-items: center;
      flex-wrap: wrap;
      gap: 40px;
    }

    .stat-card {
      text-align: center;
      color: white;
    }

    .stat-card .icon {
      font-size: 70px;
      margin-bottom: 10px;
    }

    .stat-card .number {
      font-family: 'Radio Canada', sans-serif;
      font-weight: 600;
      font-size: 48px;
      line-height: 1;
      margin-bottom: 15px;
    }

    .stat-label {
      font-family: 'Raleway', sans-serif;
      font-weight: 500;
      font-size: 18px;
      padding-top: 15px;
      border-top: 2px solid rgba(255, 255, 255, 0.3);
      display: inline-block;
      min-width: 200px;
    }

    /* ========================================
           MEDIA SECTION
           ======================================== */

    .media-section {
      width: 100%;
      background: #F7F7F7;
      padding: 80px 20px;
      position: relative;
      overflow: hidden;
    }

    .media-section .ellipse-bg {
      position: absolute;
      width: 600px;
      height: 600px;
      right: -150px;
      top: 50px;
      background: rgba(152, 5, 23, 0.1);
      border-radius: 50%;
      z-index: 0;
    }

    .media-section .title {
      font-weight: 600;
      font-size: 42px;
      color: #980517;
      text-align: center;
      margin-bottom: 50px;
      position: relative;
      z-index: 1;
    }

    .media-section .image-container {
      max-width: 1200px;
      height: 500px;
      margin: 0 auto;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
      background: linear-gradient(135deg, #980517 0%, #c41e3a 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 24px;
      position: relative;
      z-index: 1;
    }

    .carousel-indicators {
      display: flex;
      justify-content: center;
      gap: 10px;
      margin-top: 30px;
      position: relative;
      z-index: 1;
    }

    .carousel-dot {
      width: 16px;
      height: 16px;
      border-radius: 50%;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .carousel-dot.active {
      background: #980517;
      transform: scale(1.2);
    }

    .carousel-dot.inactive {
      background: #D9D9D9;
    }

    .carousel-dot:hover {
      transform: scale(1.3);
    }

    /* ========================================
           TESTIMONIALS SECTION
           ======================================== */

    .testimonials-section {
      width: 100%;
      background: #FFFFFF;
      padding: 80px 20px;
    }

    .testimonials-badge {
      display: inline-flex;
      padding: 12px 24px;
      background: rgba(152, 5, 23, 0.15);
      border-radius: 8px;
      font-weight: 500;
      font-size: 16px;
      color: #980517;
      margin: 0 auto 30px;
      display: block;
      width: fit-content;
    }

    .testimonials-title {
      font-weight: 500;
      font-size: 52px;
      line-height: 1.2;
      color: #000000;
      text-align: center;
      margin-bottom: 20px;
    }

    .testimonials-subtitle {
      font-weight: 500;
      font-size: 18px;
      color: #000000;
      text-align: center;
      margin-bottom: 60px;
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
    }

    .testimonials-container {
      display: flex;
      justify-content: center;
      gap: 30px;
      max-width: 1400px;
      margin: 0 auto;
      flex-wrap: wrap;
    }

    .testimonial-card {
      width: 400px;
      min-height: 280px;
      background: #FFFFFF;
      border-radius: 16px;
      padding: 30px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      position: relative;
      transition: all 0.3s ease;
    }

    .testimonial-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
    }

    .testimonial-card.center {
      border: 2px solid #980517;
    }

    .testimonial-card .quote-mark {
      font-weight: 200;
      font-size: 120px;
      line-height: 1;
      color: #980517;
      opacity: 0.3;
      position: absolute;
      top: -20px;
      left: 20px;
    }

    .testimonial-card .text {
      font-weight: 500;
      font-size: 16px;
      line-height: 1.6;
      color: #473F3D;
      margin-bottom: 30px;
      position: relative;
      z-index: 1;
    }

    .testimonial-card .name {
      font-weight: 500;
      font-size: 18px;
      color: #980517;
      text-align: center;
      margin-bottom: 5px;
    }

    .testimonial-card .year {
      font-weight: 500;
      font-size: 16px;
      color: #473F3D;
      text-align: center;
    }

    /* ========================================
           FOOTER STYLES
           ======================================== */

    .content-footer {
      background: #f8f9fa;
      border-top: 1px solid #e7e9ed;
      padding: 1.5rem 0;
      margin-top: 3rem;
    }

    .footer-link {
      color: #7f5656ff;
      text-decoration: none;
      transition: color 0.2s;
    }

    .footer-link:hover {
      color: #980517;
    }

    /* ========================================
           RESPONSIVE DESIGN
           ======================================== */

    @media (max-width: 992px) {

      .main-content .container,
      .info-section .container {
        flex-direction: column;
        gap: 50px;
        text-align: center;
      }

      .hero-image,
      .info-illustration {
        width: 100%;
        max-width: 400px;
      }

      .hero-title {
        font-size: 42px;
      }

      .info-title {
        font-size: 36px;
      }

      .testimonials-title {
        font-size: 36px;
      }

      .statistics-container {
        flex-direction: column;
      }
    }

    @media (max-width: 768px) {
      .hero-subtitle {
        font-size: 28px;
      }

      .hero-title {
        font-size: 32px;
      }

      .info-label {
        font-size: 24px;
      }

      .info-title {
        font-size: 28px;
      }

      .date-card .date-text {
        font-size: 36px;
      }

      .testimonial-card {
        width: 100%;
      }

      .media-section .image-container {
        height: 300px;
      }
    }
  </style>

</head>

<body>

  <!-- MAIN CONTENT SECTION -->
  <section class="main-content">
    <div class="ellipse-bg"></div>
    <div class="container">
      <div class="hero-text-container">
        <h2 class="hero-subtitle">Graduation System</h2>
        <h1 class="hero-title">Horizon University Indonesia</h1>
        <p class="hero-description">Horizon University's graduation system that facilitates access to schedules, information, and graduation documentation</p>
      </div>
      <div class="hero-image">
        <img src="{{ asset('images/gmr1.png') }}">
      </div>
    </div>
  </section>

  <!-- INFORMATION SECTION -->
  <section class="info-section">
    <div class="ellipse-bg"></div>
    <div class="container">
      <div class="info-illustration">
        <img src="{{ asset('images/gmr2.png') }}">
      </div>
      <div class="info-text-container">
        <p class="info-label">Information</p>
        <h2 class="info-title">Graduation Schedule</h2>
        <p class="info-description">Check the latest graduation schedule for each study program so that your precious moment runs smoothly.</p>

        <div class="date-card">
          <div class="icon">📅</div>
          <div class="date-text">20 Jan 25</div>
          <div class="location-wrapper">
            <span>📍</span>
            <span>Resinda Hotel - Karawang</span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- STATISTICS SECTION -->
  <section class="statistics-section">
    <div class="statistics-container">
      <div class="stat-card">
        <div class="icon">🎓</div>
        <div class="number">5,025</div>
        <div class="stat-label">Graduates</div>
      </div>
      <div class="stat-card">
        <div class="icon">👥</div>
        <div class="number">5,025</div>
        <div class="stat-label">Active Students</div>
      </div>
      <div class="stat-card">
        <div class="icon">🎓</div>
        <div class="number">5,025</div>
        <div class="stat-label">Prospective Graduates</div>
      </div>
    </div>
  </section>

  <!-- MEDIA SECTION -->
  <section class="media-section">
    <div class="ellipse-bg"></div>
    <h2 class="title">GRADUATION MEDIA</h2>
    <div class="image-container">
      <img src="{{ asset('images/gmr3.png') }}">
    </div>
    <div class="carousel-indicators">
      <div class="carousel-dot inactive"></div>
      <div class="carousel-dot active"></div>
      <div class="carousel-dot inactive"></div>
      <div class="carousel-dot inactive"></div>
    </div>
  </section>

  <!-- TESTIMONIALS SECTION -->
  <section class="testimonials-section">
    <div class="testimonials-badge">Our Reach</div>
    <h2 class="testimonials-title">What Our Graduates Say!</h2>
    <p class="testimonials-subtitle">Graduation is a proud milestone — discover inspiring stories from Horizon University Indonesia graduates</p>

    <div class="testimonials-container">
      <div class="testimonial-card">
        <div class="quote-mark">"</div>
        <p class="text">Horizon University Indonesia shaped me into a person who is ready to face the working world.</p>
        <div class="name">Liana</div>
        <div class="year">2025 - Graduate</div>
      </div>

      <div class="testimonial-card center">
        <div class="quote-mark">"</div>
        <p class="text">Horizon University Indonesia shaped me into a person who is ready to face the working world.</p>
        <div class="name">Ririn</div>
        <div class="year">2025 - Graduate</div>
      </div>

      <div class="testimonial-card">
        <div class="quote-mark">"</div>
        <p class="text">Horizon University Indonesia shaped me into a person who is ready to face the working world.</p>
        <div class="name">Nimas</div>
        <div class="year">2025 - Graduate</div>
      </div>
    </div>

    <div class="carousel-indicators">
      <div class="carousel-dot inactive"></div>
      <div class="carousel-dot active"></div>
      <div class="carousel-dot inactive"></div>
      <div class="carousel-dot inactive"></div>
    </div>
  </section>

  --}}

  <!-- FOOTER -->
  <footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-3 flex-md-row flex-column">
      <div class="mb-2 mb-md-0">
        ©
        <script>
          document.write(new Date().getFullYear());
        </script>
        MyWebsite | All Rights Reserved
      </div>
      <div>
        <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
        <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-4">Documentation</a>
        <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank" class="footer-link me-4">Support</a>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>