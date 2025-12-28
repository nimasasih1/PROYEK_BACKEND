@php
use App\Models\Mahasiswa;
use App\Models\PendaftaranWisuda;
use App\Models\Informasi;
use App\Models\MediaWisuda;
use App\Models\Testimoni;
use App\Models\Statistik;
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

// ===== AMBIL DATA DARI DATABASE =====
$infoWisuda = Informasi::orderBy('jadwal_wisuda', 'desc')->first(); // Ambil jadwal terbaru
$mediaWisuda = MediaWisuda::orderBy('urutan')->get(); // Ambil semua media untuk carousel
$testimoni = Testimoni::orderBy('urutan')->limit(6)->get(); // Ambil 6 testimoni pertama
$statistik = Statistik::first(); // Ambil statistik
@endphp

@include('base.header')

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Horizon University - Graduation System</title>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Radio+Canada:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
      background: #f8f9fa;
    }

    .hero-section {
      position: relative;
      min-height: 100vh;
      display: flex;
      align-items: center;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      overflow: hidden;
      padding: 100px 0 80px;
    }

    .hero-title {
      font-family: 'Raleway', sans-serif;
      font-size: 3.8rem;
      font-weight: 850;
      line-height: 1.2;
      color: #000;
      animation: slideInLeft 0.8s ease 0.2s both;
    }

    .text-red {
      color: #980517;
    }

    .hero-subtitle {
      font-size: 3rem;
      color: #555;
      margin-bottom: 1px;
      font-weight: 600;
      font-family: 'Raleway', sans-serif;
      letter-spacing: 1px;
      animation: slideInLeft 0.8s ease 0.3s both;
    }

    .info-section {
      padding: 100px 0;
      background: white;
      position: relative;
    }

    .section-title {
      font-family: 'Raleway', sans-serif;
      font-size: 3rem;
      font-weight: 600;
      text-align: center;
      margin-bottom: 20px;
      background: linear-gradient(135deg, #980517 0%, #c41e3a 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .date-card {
      width: 500px;
      height: 160px;
      border-radius: 80px;
      overflow: hidden;
      position: relative;
      box-shadow: 0 15px 40px rgba(152, 5, 23, 0.25);
      margin-left: -40px;
      transition: 0.3s ease;
    }

    .date-card::before {
      content: "";
      position: absolute;
      inset: 0;
      background: url("images/bg-card.png") center/cover no-repeat;
      z-index: 1;
    }

    .date-card::after {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(152, 5, 23, 0.639);
      z-index: 2;
    }

    .date-card-content {
      position: relative;
      z-index: 3;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 6px;
    }

    .date-text {
      font-family: 'Radio Canada', sans-serif;
      font-size: 2.7rem;
      font-weight: 700;
      color: #ffffff;
      margin: 5px 0;
    }

    .location-text {
      font-family: 'Radio Canada', sans-serif;
      font-size: 0.95rem;
      color: #ffffff;
      display: flex;
      margin-top: -5%;
      align-items: center;
      gap: 6px;
      opacity: 0.9;
    }

    .statistics-section {
      background: linear-gradient(135deg, #980517 0%, #c41e3a 100%);
      padding: 80px 0;
      position: relative;
      overflow: hidden;
    }

    .stat-card {
      text-align: center;
      color: white;
      padding: 5px;
      transition: all 0.3s ease;
      position: relative;
      z-index: 1;
    }

    .stat-number {
      font-size: 3rem;
      font-weight: 600;
      margin-bottom: 10px;
      text-shadow: 0 5px 20px rgba(0, 0, 0, 0.3);
    }

    .stat-label {
      font-size: 1.2rem;
      font-weight: 500;
      opacity: 0.95;
      border-top: 2px solid rgba(255, 255, 255, 0.3);
      padding-top: 15px;
      display: inline-block;
      min-width: 200px;
    }

    .media-section {
      padding: 100px 0;
      background: #f8f9fa;
      position: relative;
    }

    .carousel-container {
      position: relative;
      border-radius: 30px;
      overflow: hidden;
      box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15);
      height: 600px;
    }

    .carousel-track {
      display: flex;
      transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
      height: 100%;
    }

    .carousel-slide {
      min-width: 100%;
      height: 100%;
    }

    .carousel-slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
      display: block;
    }

    .carousel-indicators {
      display: flex;
      justify-content: center;
      gap: 12px;
      margin-top: 40px;
    }

    .carousel-dot {
      width: 14px;
      height: 14px;
      border-radius: 50%;
      cursor: pointer;
      transition: all 0.3s ease;
      border: 2px solid #980517;
    }

    .carousel-dot.active {
      background: #980517;
      transform: scale(1.3);
      box-shadow: 0 5px 15px rgba(152, 5, 23, 0.4);
    }

    .carousel-dot.inactive {
      background: transparent;
    }

    .testimonials-section {
      padding: 100px 0;
      background: white;
    }

    .testimonial-card {
      background: white;
      border-radius: 25px;
      padding: 40px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      height: 100%;
      border: 2px solid transparent;
    }

    .testimonial-card.compact {
      padding: 25px 28px;
      height: auto;
      min-height: 260px;
      border-radius: 20px;
    }

    .quote-icon {
      font-size: 3rem;
      color: #980517;
      opacity: 0.3;
      margin-bottom: 20px;
    }

    .testimonial-card.compact .quote-icon i {
      font-size: 2rem;
      color: #d9979d;
      margin-bottom: 15px;
    }

    .testimonial-text {
      font-size: 1.05rem;
      line-height: 1.8;
      color: #555;
      margin-bottom: 30px;
      font-style: italic;
    }

    .author-name {
      font-size: 1.1rem;
      font-weight: 600;
      color: #980517;
      margin-bottom: 3px;
    }

    .author-year {
      font-size: 0.95rem;
      color: #777;
    }

    .footer {
      background: linear-gradient(135deg, #800016, #5e0011);
      padding: 60px 0 25px;
      color: #fff;
      font-family: 'Radio Canada', sans-serif;
    }

    .footer-content {
      display: flex;
      justify-content: space-between;
      gap: 40px;
      margin-bottom: 45px;
      flex-wrap: wrap;
    }

    .footer-col {
      flex: 1;
      min-width: 250px;
    }

    .footer-col h4 {
      font-size: 1.05rem;
      font-weight: 700;
      margin-bottom: 18px;
      text-transform: uppercase;
      letter-spacing: 1px;
      position: relative;
    }

    .footer-social {
      display: flex;
      justify-content: center;
      gap: 22px;
      margin-bottom: 30px;
    }

    .footer-social i {
      color: #fff;
      border: 2px solid rgba(255,255,255,0.8);
      width: 42px;
      height: 42px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      transition: all 0.3s ease;
    }

    @media (max-width: 576px) {
      .hero-section {
        text-align: center;
        padding-top: 40px;
      }

      .hero-title {
        font-size: 1.8rem !important;
        line-height: 1.3 !important;
      }

      .hero-subtitle {
        font-size: 1.4rem !important;
        margin-bottom: 15px;
      }
    }
</style>

</head>

<body>

  <!-- HERO SECTION -->
  <section class="hero-section" id="home">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 hero-content">
          <div class="hero-subtitle">
            <span class="text-graduation">Sistem</span>
            <span class="text-system">Wisuda</span>
          </div>

          <h1 class="hero-title">
            <span class="line-1">
              Universitas <span class="text-red">Horizon</span>
            </span>
            <br>
            <span class="line-2">Indonesia</span>
          </h1>

          <p class="hero-description">
            Sistem wisuda Universitas Horizon yang memfasilitasi akses jadwal, informasi, dan dokumentasi wisuda
          </p>
        </div>
        <div class="col-lg-6 mt-5 mt-lg-0">
          <div class="hero-image-container">
            <div class="text-center">
              <img src="images/org1.png" alt="Mahasiswa Wisuda" style="width: 140%; margin-left: 6%; margin-top: -43%;">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- INFO SECTION - DATA DARI DATABASE -->
  <section class="info-section" id="info">
    <div class="container">
      <h2 class="sesi-judul" style="font-family: 'Raleway', sans-serif; font-weight: 200; line-height: 1.2; margin-bottom: 10px;">
        <span class="info-baris" style="color: #000;">Informasi</span><br>
        <span class="garis-baris" style="font-weight: 501; font-size: 3rem; color: #000;">
          Jadwal <span class="text-merah" style="color: #980517;">Wisuda</span>
        </span>
      </h2>

      <p class="section-subtitle" style="margin-bottom: 0px;">
        Cek jadwal wisuda terbaru untuk setiap program studi agar momen berharga Anda berjalan lancar.
      </p>

      <div class="row align-items-center">
        <div class="col-lg-6 order-lg-1 img-left-wrapper">
          <img src="images/org2.png" alt="Wisudawan" class="responsive-img" style="margin-left: -25%;">
        </div>

        <div class="col-lg-6 mb-4 mb-lg-0 order-lg-2" style="margin-top: 0px;">
          @if($infoWisuda)
          <div class="date-card" style="margin-top: 0px;">
            <div class="date-card-content">
              <div class="date-icon" style="margin-top: -5%;">
                <img src="images/date.png" alt="">
              </div>
              <div class="date-text" style="margin-top: -2%;">
                {{ \Carbon\Carbon::parse($infoWisuda->jadwal_wisuda)->format('d M Y') }}
              </div>
              <div class="location-text">
                <i class="fas fa-map-marker-alt"></i>
                <span>{{ $infoWisuda->lokasi }}</span>
              </div>
            </div>
          </div>
          @else
          <div class="alert alert-info">
            Belum ada jadwal wisuda yang tersedia. Silakan hubungi admin.
          </div>
          @endif
        </div>
      </div>
    </div>
  </section>

  <!-- STATISTICS SECTION - DATA DARI DATABASE -->
  <section class="statistics-section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="stat-card">
            <div class="stat-number">
              <img src="images/Vector.png" alt="" style="width: 50px;">
              <span>{{ $statistik ? number_format($statistik->total_lulusan) : '0' }}</span>
            </div>
            <div class="stat-label">Total Lulusan</div>
          </div>
        </div>
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="stat-card">
            <div class="stat-number">
              <img src="images/Vector2.png" alt="" style="width: 50px;">
              <span>{{ $statistik ? number_format($statistik->mahasiswa_aktif) : '0' }}</span>
            </div>
            <div class="stat-label">Mahasiswa Aktif</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="stat-card">
            <div class="stat-number">
              <img src="images/Vector3.png" alt="" style="width: 50px;">
              <span>{{ $statistik ? number_format($statistik->calon_lulusan) : '0' }}</span>
            </div>
            <div class="stat-label">Calon Lulusan</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MEDIA SECTION - DATA DARI DATABASE -->
  <section class="media-section" id="media">
    <div class="container">
      <h2 class="section-title">MEDIA WISUDA</h2>

      @if($mediaWisuda->count() > 0)
      <div class="carousel-container">
        <div class="carousel-track" id="carouselTrack">
          @foreach($mediaWisuda as $media)
          <div class="carousel-slide">
            <img src="{{ asset('storage/'.$media->gambar) }}" alt="{{ $media->judul }}">
          </div>
          @endforeach
        </div>
      </div>
      <div class="carousel-indicators" id="carouselIndicators"></div>
      @else
      <div class="alert alert-info text-center">
        Belum ada media wisuda yang tersedia
      </div>
      @endif
    </div>
  </section>

  <!-- TESTIMONIALS SECTION - DATA DARI DATABASE -->
  <section class="testimonials-section" id="testimonials">
    <div class="container">
      <div class="testimonials-badge" style="display: inline-block; padding: 12px 30px; background: linear-gradient(135deg, rgba(152, 5, 23, 0.1) 0%, rgba(196, 30, 58, 0.1) 100%); border-radius: 10px; font-weight: 600; color: #980517; margin: 0 auto 30px; display: block; width: fit-content; border: 2px solid rgba(152, 5, 23, 0.2);">
        Jangkauan Kami
      </div>
      <h2 class="section-title section-title-custom" style="background: none !important; -webkit-text-fill-color: #000 !important; color: #000 !important;">
        Apa Kata <span class="our-red" style="color: #980517 !important; -webkit-text-fill-color: #980517 !important;">Lulusan</span> Kami!
      </h2>

      <p class="section-subtitle subtitle-full" style="max-width: none !important; width: 100% !important; text-align: center;">
        Wisuda adalah pencapaian yang membanggakan — temukan kisah inspiratif dari lulusan Universitas Horizon Indonesia
      </p>

      @if($testimoni->count() > 0)
      <div class="row testimonial-row" style="display: flex; flex-wrap: nowrap; overflow-x: auto; scroll-snap-type: x mandatory; -webkit-overflow-scrolling: touch; column-gap: 20px; padding-bottom: 15px;">
        @foreach($testimoni as $testi)
        <div class="col-lg-4 col-md-6 mb-4" style="flex: 0 0 33.333%;">
          <div class="testimonial-card compact">
            <div class="quote-icon">
              <i class="fas fa-quote-left"></i>
            </div>
            <p class="testimonial-text">
              {{ $testi->testimoni }}
            </p>
            <div class="author-info" style="text-align: center;">
              <div class="author-name">{{ $testi->nama }}</div>
              <div class="author-year">Lulusan {{ $testi->tahun_lulus }}</div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="testimonial-dots">
        @foreach($testimoni as $key => $testi)
        <span class="dot {{ $key == 0 ? 'active' : '' }}"></span>
        @endforeach
      </div>
      @else
      <div class="alert alert-info text-center">
        Belum ada testimoni yang tersedia
      </div>
      @endif
    </div>
  </section>

  <!-- FOOTER -->
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-col">
          <h4>Contact Us</h4>
          <p><strong>Phone</strong><br>0811-8454-800</p>
          <p><strong>Email</strong><br>info.krw@horizon.ac.id</p>
        </div>
        <div class="footer-col">
          <h4>Location</h4>
          <p>
            Jl. Pangkal Perjuangan<br>
            KM.1 By Pass Karawang<br>
            Jawa Barat, Indonesia
          </p>
        </div>
      </div>

      <div class="footer-social">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-tiktok"></i></a>
      </div>

      <div class="footer-line" style="width: 70%; height: 1px; background: rgba(255,255,255,0.4); margin: 0 auto 20px;"></div>

      <p class="footer-copy" style="text-align: center; font-size: 0.85rem; letter-spacing: 0.4px; opacity: 0.85;">
        © 2025 <strong>GRAD-System</strong> | Horizon University Indonesia
      </p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

  <script>
    // Carousel functionality
    let currentSlide = 0;
    const totalSlides = {{ $mediaWisuda->count() }};
    let autoSlideInterval;

    function initCarousel() {
      const indicators = document.getElementById('carouselIndicators');
      if (!indicators || totalSlides === 0) return;

      for (let i = 0; i < totalSlides; i++) {
        const dot = document.createElement('div');
        dot.className = i === 0 ? 'carousel-dot active' : 'carousel-dot inactive';
        dot.onclick = () => goToSlide(i);
        indicators.appendChild(dot);
      }
      startAutoSlide();
    }

    function updateCarousel() {
      const track = document.getElementById('carouselTrack');
      const dots = document.querySelectorAll('#carouselIndicators .carousel-dot');

      if (!track) return;

      track.style.transform = `translateX(-${currentSlide * 100}%)`;

      dots.forEach((dot, index) => {
        dot.className = index === currentSlide ? 'carousel-dot active' : 'carousel-dot inactive';
      });
    }

    function moveSlide(direction) {
      currentSlide += direction;

      if (currentSlide < 0) {
        currentSlide = totalSlides - 1;
      } else if (currentSlide >= totalSlides) {
        currentSlide = 0;
      }

      updateCarousel();
      resetAutoSlide();
    }

    function goToSlide(index) {
      currentSlide = index;
      updateCarousel();
      resetAutoSlide();
    }

    function startAutoSlide() {
      if (totalSlides > 0) {
        autoSlideInterval = setInterval(() => {
          moveSlide(1);
        }, 5000);
      }
    }

    function resetAutoSlide() {
      clearInterval(autoSlideInterval);
      startAutoSlide();
    }

    window.addEventListener('DOMContentLoaded', () => {
      initCarousel();
    });
  </script>

</body>
</html>