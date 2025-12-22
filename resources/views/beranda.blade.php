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

    /* HERO SECTION */
    .hero-section {
      position: relative;
      min-height: 100vh;
      display: flex;
      align-items: center;
      background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
      overflow: hidden;
      padding: 100px 0 80px;
    }

    .hero-section::before {
      content: '';
      position: absolute;
      width: 800px;
      height: 800px;
      background: radial-gradient(circle, rgba(152, 5, 23, 0.15) 0%, transparent 70%);
      top: -200px;
      right: -200px;
      border-radius: 50%;
      animation: pulse 8s ease-in-out infinite;
    }

    @keyframes pulse {
      0%, 100% { transform: scale(1); opacity: 0.5; }
      50% { transform: scale(1.1); opacity: 0.7; }
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .hero-badge {
      display: inline-block;
      padding: 8px 20px;
      background: linear-gradient(135deg, rgba(152, 5, 23, 0.1) 0%, rgba(196, 30, 58, 0.1) 100%);
      border-radius: 50px;
      font-size: 0.9rem;
      font-weight: 600;
      color: #980517;
      margin-bottom: 20px;
      animation: slideInDown 0.8s ease;
    }

    @keyframes slideInDown {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .hero-title {
  font-family: 'Raleway', sans-serif;
  font-size: 3.8rem;
  font-weight: 850;
  line-height: 1.2;
  margin-top: 0px;
  margin-bottom: 30px;
  letter-spacing: 0.5px;
  color: #000; /* warna default hitam */
  animation: slideInLeft 0.8s ease 0.2s both;
}

.text-red {
  color: #980517; /* warna merah seperti di contoh */
}




    @keyframes slideInLeft {
      from { opacity: 0; transform: translateX(-50px); }
      to { opacity: 1; transform: translateX(0); }
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

    .text-graduation {
      color: #980517;
      font-weight: 400;
    }

    .text-system {
      color: #000000;
      font-weight: 400;
    }


    .hero-description {
      font-family: 'Raleway', sans-serif;
      font-size: 1rem;
      color: #000000;
      line-height: 1.8;
      font-weight: 505;
      margin-bottom: 30px;
      animation: slideInLeft 0.8s ease 0.4s both;
    }

    .hero-buttons {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
      animation: slideInUp 0.8s ease 0.5s both;
    }

    @keyframes slideInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .btn-primary-custom {
      padding: 15px 40px;
      background: linear-gradient(135deg, #980517 0%, #c41e3a 100%);
      color: white;
      border: none;
      border-radius: 50px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      box-shadow: 0 10px 30px rgba(152, 5, 23, 0.3);
      text-decoration: none;
      display: inline-block;
    }

    .btn-primary-custom:hover {
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(152, 5, 23, 0.4);
      color: white;
    }

    .btn-secondary-custom {
      padding: 15px 40px;
      background: transparent;
      color: #980517;
      border: 2px solid #980517;
      border-radius: 50px;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-secondary-custom:hover {
      background: #980517;
      color: white;
      transform: translateY(-3px);
    }

    .hero-image-container {
      position: relative;
      animation: fadeInRight 1s ease 0.3s both;
    }

    @keyframes fadeInRight {
      from { opacity: 0; transform: translateX(50px); }
      to { opacity: 1; transform: translateX(0); }
    }

    .hero-image {
      width: 100%;
      max-width: 500px;
      height: auto;
      border-radius: 30px;
      box-shadow: 0 30px 60px rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease;
    }

    .hero-image:hover {
      transform: scale(1.05) rotate(2deg);
    }

    .floating-element {
      position: absolute;
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
    }

    .floating-1 {
      top: 10%;
      right: -5%;
      font-size: 3rem;
      animation-delay: 0s;
    }

    .floating-2 {
      bottom: 15%;
      right: 5%;
      font-size: 2.5rem;
      animation-delay: 2s;
    }

    /* INFO SECTION */
    .info-section {
      padding: 100px 0;
      background: white;
      position: relative;
      overflow: hidden;
    }

    .info-section::before {
      content: '';
      position: absolute;
      width: 600px;
      height: 600px;
      background: radial-gradient(circle, rgba(152, 5, 23, 0.08) 0%, transparent 70%);
      bottom: -200px;
      left: -200px;
      border-radius: 50%;
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
      background-clip: text;
    }

    /* HANYA untuk judul What Our Graduates Say! */
.section-title-custom {
  background: none !important;
  -webkit-text-fill-color: #000 !important;
  color: #000 !important;
}

/* warna merah khusus untuk OUR */
.section-title-custom .our-red {
  color: #980517 !important;
  -webkit-text-fill-color: #980517 !important;
}



    .section-subtitle {
      text-align: center;
      color: #000000;
      font-size: 1.1rem;
      margin-bottom: 60px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }

    .subtitle-full {
  max-width: none !important;     /* hilangkan batas 700px */
  width: 100% !important;         /* biar full baris */
  text-align: center;             /* tetap di tengah */
  margin-left: 0 !important;
  margin-right: 0 !important;
}


    .sesi-judul {
  font-family: 'Raleway', sans-serif;
  font-weight: 200; 
  line-height: 1.2;
  margin-bottom: 10px;
}

.garis-baris {
  font-weight: 501;
  font-size: 3rem;
}

/* Baris pertama */
.sesi-judul .info-baris {
  color: #000; /* hitam */
}

/* Baris kedua: Graduation tetap hitam */
.sesi-judul .garis-baris {
  color: #000; /* hitam */
}

/* Kata Schedule warna merah */
.sesi-judul .text-merah {
  color: #980517;
}

    /* CARD MODEL BARU PERSIS DENGAN CONTOH */
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

/* BACKGROUND FOTO DI DALAM CARD */
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
 /* transparansi disesuaikan */
  z-index: 2;
}

    @keyframes rotate {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    .date-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 30px 80px rgba(152, 5, 23, 0.4);
    }

    /* KONTEN CARD */
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

.date-icon img {
  width: 30px;
  height: auto;
  display: block;
  margin-top: 5%;
}

  .date-text {
  font-family: 'Radio Canada', sans-serif;
  font-size: 2.7rem;
  font-weight: 700;
  color: #ffffff;
  margin: 5px 0;
}

/* Lokasi */
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

    /* STATISTICS */
    .statistics-section {
      background: linear-gradient(135deg, #980517 0%, #c41e3a 100%);
      padding: 80px 0;
      position: relative;
      overflow: hidden;
    }

    .statistics-section::before {
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      background-image: 
        repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255, 255, 255, 0.03) 35px, rgba(255, 255, 255, 0.03) 70px);
      animation: moveBackground 20s linear infinite;
    }

    @keyframes moveBackground {
      from { transform: translateX(0); }
      to { transform: translateX(70px); }
    }

    .stat-card {
      text-align: center;
      color: white;
      padding: 5px;
      transition: all 0.3s ease;
      position: relative;
      z-index: 1;
    }

    .stat-card:hover {
      transform: translateY(-10px);
    }

    .stat-icon {
      font-size: 4rem;
      margin-bottom: 20px;
      filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.3));
      transition: all 0.3s ease;
    }

    .stat-card:hover .stat-icon {
      transform: scale(1.2) rotate(5deg);
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

    /* MEDIA CAROUSEL */
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
      background: linear-gradient(135deg, #980517 20%, #c41e3a 80%);
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 3rem;
      color: white;
      font-weight: 700;
    }

    .carousel-slide img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  object-position: center;
  display: block;
}


    .carousel-button {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      background: rgba(255, 255, 255, 0.95);
      border: none;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      cursor: pointer;
      font-size: 1.5rem;
      color: #980517;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
      z-index: 10;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .carousel-button:hover {
      background: white;
      transform: translateY(-50%) scale(1.15);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
    }

    .carousel-button.prev {
      left: 30px;
    }

    .carousel-button.next {
      right: 30px;
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

    .carousel-dot:hover {
      transform: scale(1.4);
    }

    /* TESTIMONIALS */
    .testimonials-section {
      padding: 100px 0;
      background: white;
    }

    .testimonials-badge {
      display: inline-block;
      padding: 12px 30px;
      background: linear-gradient(135deg, rgba(152, 5, 23, 0.1) 0%, rgba(196, 30, 58, 0.1) 100%);
      border-radius: 10px;
      font-weight: 600;
      color: #980517;
      margin: 0 auto 30px;
      display: block;
      width: fit-content;
      border: 2px solid rgba(152, 5, 23, 0.2);
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

    .testimonial-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
      border-color: #980517;
    }

    .testimonial-card.center {
      background: linear-gradient(135deg, rgba(152, 5, 23, 0.03) 0%, rgba(196, 30, 58, 0.03) 100%);
    }

    /* Row khusus testimonial: jadi slider horizontal */
.testimonial-row {
  display: flex;
  flex-wrap: nowrap;          /* biar ke samping, bukan ke bawah */
  overflow-x: auto;           /* bisa di-scroll / di-geser */
  scroll-snap-type: x mandatory;
  -webkit-overflow-scrolling: touch;
  column-gap: 20px;
  padding-bottom: 15px;
}

/* Hilangkan wrap dari col dan atur lebar tiap card */
.testimonial-row > .col-lg-4 {
  flex: 0 0 33.333%;          /* 3 card per layar di desktop */
  scroll-snap-align: start;
}

/* Tablet: 2 card per layar */
@media (max-width: 992px) {
  .testimonial-row > .col-lg-4 {
    flex: 0 0 50%;
  }
}

/* HP: 1 card per layar */
@media (max-width: 576px) {
  .testimonial-row > .col-lg-4 {
    flex: 0 0 85%;
  }
}

/* Optional: scrollbar cantik */
.testimonial-row::-webkit-scrollbar {
  height: 6px;
}
.testimonial-row::-webkit-scrollbar-track {
  background: #f3f3f3;
  border-radius: 10px;
}
.testimonial-row::-webkit-scrollbar-thumb {
  background: #d1d1d1;
  border-radius: 10px;
}
.testimonial-row::-webkit-scrollbar-thumb:hover {
  background: #b5b5b5;
}

.testimonial-dots {
  display: flex;
  justify-content: center;
  margin-top: 10px;
  gap: 10px;
}

.testimonial-dots .dot {
  width: 14px;
  height: 14px;
  border-radius: 50%;
  background: #d9d9d9;
  display: inline-block;
  transition: background 0.3s;
}

.testimonial-dots .dot.active {
  background: #980517; /* warna merah kamu */
}

/* === Compact Testimonial Card === */

.testimonial-card.compact {
  padding: 25px 28px;       /* lebih kecil dari 40px */
  height: auto;             /* biar tidak memanjang ke bawah */
  min-height: 260px;        /* biar tetap rapi dan se-level */
  border-radius: 20px;
}

/* Quote icon */
.testimonial-card.compact .quote-icon i {
  font-size: 2rem;          /* lebih kecil dari sebelumnya */
  color: #d9979d;           /* soft pink seperti contoh */
  margin-bottom: 15px;
}

/* Testimonial text lebih cantik */
.testimonial-card.compact .testimonial-text {
  font-size: 1rem;
  line-height: 1.6;
  margin-bottom: 25px;
  color: #555;
}

/* Garis tipis sebelum author (mirip contoh kanan) */
.testimonial-card.compact .testimonial-text {
  position: relative;
}

/* Avatar bagian bawah */
.testimonial-card.compact .testimonial-author {
  margin-top: 20px;
  display: flex;
  align-items: center;
  gap: 12px;
  justify-content: center;
  text-align: center;
}

.testimonial-card.compact .author-info {
  text-align: center;
}

/* Name + Year */
.testimonial-card.compact .author-name {
  font-size: 1.1rem;
  font-weight: 600;
  color: #980517; /* merah elegan */
  margin-bottom: 3px;
}

.testimonial-card.compact .author-year {
  font-size: 0.95rem;
  color: #777;
}


    .quote-icon {
      font-size: 3rem;
      color: #980517;
      opacity: 0.3;
      margin-bottom: 20px;
    }

    .testimonial-text {
      font-size: 1.05rem;
      line-height: 1.8;
      color: #555;
      margin-bottom: 30px;
      font-style: italic;
    }

    .testimonial-author {
      display: flex;
      align-items: center;
      gap: 15px;
      padding-top: 20px;
      border-top: 2px solid #f0f0f0;
    }

    .author-avatar {
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: linear-gradient(135deg, #980517 0%, #c41e3a 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      color: white;
      font-size: 1.5rem;
      font-weight: 700;
      box-shadow: 0 5px 15px rgba(152, 5, 23, 0.3);
    }

    .author-info {
      flex: 1;
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

.footer-col h4::after {
  content: "";
  width: 40px;
  height: 3px;
  background: #ffffff;
  position: absolute;
  left: 0;
  bottom: -8px;
  opacity: 0.8;
}

.footer-col p {
  margin: 0 0 12px;
  font-size: 0.95rem;
  line-height: 1.6;
  opacity: 0.9;
}

.footer-col strong {
  font-weight: 600;
  opacity: 1;
}

/* SOCIAL */
.footer-social {
  display: flex;
  justify-content: center;
  gap: 22px;
  margin-bottom: 30px;
}

.footer-social a {
  text-decoration: none;
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

.footer-social i:hover {
  background: #ffffff;
  color: #800016;
  transform: translateY(-3px);
}

/* LINE */
.footer-line {
  width: 70%;
  height: 1px;
  background: rgba(255,255,255,0.4);
  margin: 0 auto 20px;
}

/* COPYRIGHT */
.footer-copy {
  text-align: center;
  font-size: 0.85rem;
  letter-spacing: 0.4px;
  opacity: 0.85;
}

.footer a,
.footer p,
.footer h4 {
  transition: color 0.3s ease;
}

.footer p:hover,
.footer h4:hover,
.footer-copy:hover {
  color: #C6AF5F;
}

.footer-social i:hover {
  background: #C6AF5F;
  color: #800016;
  border-color: #C6AF5F;
  transform: translateY(-3px);
}

.footer-col h4::after {
  transition: background 0.3s ease;
}

.footer-col h4:hover::after {
  background: #C6AF5F;
}

@media (hover: hover) {
  .footer p:hover,
  .footer h4:hover,
  .footer-copy:hover {
    color: #C6AF5F;
  }
}



    /* FOOTER 
    .footer {
      background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
      color: white;
      padding: 80px 0 30px;
      position: relative;
      overflow: hidden;
    }

    .footer::before {
      content: '';
      position: absolute;
      width: 100%;
      height: 100%;
      background-image: 
        repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255, 255, 255, 0.02) 35px, rgba(255, 255, 255, 0.02) 70px);
    }

    .footer-section {
      margin-bottom: 40px;
      position: relative;
      z-index: 1;
    }

    .footer-title {
      font-size: 1.4rem;
      font-weight: 700;
      margin-bottom: 25px;
      position: relative;
      padding-bottom: 15px;
    }

    .footer-title::after {
      content: '';
      position: absolute;
      left: 0;
      bottom: 0;
      width: 60px;
      height: 3px;
      background: linear-gradient(90deg, #980517 0%, #c41e3a 100%);
      border-radius: 2px;
    }

    .contact-item {
      display: flex;
      align-items: start;
      margin-bottom: 20px;
      transition: transform 0.3s ease;
    }

    .contact-item:hover {
      transform: translateX(10px);
    }

    .contact-icon {
      width: 45px;
      height: 45px;
      background: linear-gradient(135deg, #980517 0%, #c41e3a 100%);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-right: 15px;
      flex-shrink: 0;
      box-shadow: 0 5px 15px rgba(152, 5, 23, 0.3);
    }

    .contact-icon i {
      font-size: 1.1rem;
    }

    .contact-text a {
      color: rgba(255, 255, 255, 0.9);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .contact-text a:hover {
      color: #c41e3a;
    }

    .footer-link {
      color: rgba(255, 255, 255, 0.8);
      text-decoration: none;
      padding: 10px 15px;
      display: inline-block;
      transition: all 0.3s ease;
      border-radius: 8px;
      margin: 5px;
    }

    .footer-link:hover {
      background: rgba(152, 5, 23, 0.2);
      color: white;
      transform: translateX(5px);
    }

    .social-links a {
      width: 45px;
      height: 45px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 12px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin: 0 5px;
      transition: all 0.3s ease;
      color: white;
      font-size: 1.2rem;
    }

    .social-links a:hover {
      background: linear-gradient(135deg, #980517 0%, #c41e3a 100%);
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(152, 5, 23, 0.3);
    }

    .footer-bottom {
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      padding-top: 30px;
      margin-top: 50px;
      text-align: center;
      color: rgba(255, 255, 255, 0.7);
    }

    */

    /* RESPONSIVE */

    /* === FIX HERO SECTION MOBILE === */
@media (max-width: 576px) {

  /* Biar layout lebih rapi */
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

  .hero-description {
    width: 90%;
    margin: 0 auto 20px;
    font-size: 0.95rem !important;
    line-height: 1.6;
  }

  /* === FIX GAMBAR YANG KELEBIHAN LEBAR === */
  .hero-image-container img {
    width: 90% !important;      /* Biar pas ukuran HP */
    margin: 0 auto !important;  /* Center */
    display: block;
    margin-top: 10px !important; /* Hapus margin negatif */
  }
}

/* ===== FIX MOBILE INFO SECTION PERFECT VERSION ===== */
@media (max-width: 576px) {

  /* Gambar laki-laki biar lebih besar dan center */
  .img-left-wrapper img {
    width: 60% !important;
    margin: 0 auto !important;
    margin-top: -15% !important;
    display: block;
  }

  /* Rapihin circle background */
  .img-left-wrapper {
    display: flex;
    justify-content: center;
    align-items: center; /* Vertikal alignment */
    text-align: center; /* Optional: To center align text if needed */
}

.responsive-img {
    max-width: 100%;
    height: auto;
}


  .img-left-wrapper:before {
    content: "";
    position: center;
    width: 260px;
    height: 260px;
    background: url('images2/bg-circle.png') center/contain no-repeat;
    opacity: 0.25;
    z-index: -1;
    top: -10%;
  }

  /* Rapihin jarak judul ke gambar */
  .info-section .sesi-judul {
    margin-bottom: 10px !important;
  }

  .section-subtitle {
    margin-bottom: 20px !important;
  }

  /* Card tanggal biar makin proportional */
  .date-card {
    width: 92% !important;
    margin-top: -5% !important;
    padding: 20px 0 !important;
    border-radius: 22px !important;
    height: auto !important;
  }

  .date-text {
    font-size: 1.6rem !important;
  }

  .location-text {
    font-size: 0.85rem !important;
  }
}

/* RAPIH-IN STATISTIK DI MOBILE */
@media (max-width: 576px) {

  .stat-card {
    text-align: center !important;
    padding: 25px 10px !important;
  }

  /* IKON + ANGKA BIAR CENTER DAN SEJAJAR */
  .stat-number {
    display: flex;
    flex-direction: row;       /* icon + angka sejajar */
    justify-content: center;   /* rata tengah */
    align-items: center;
    gap: 10px;                 /* jarak lebih rapi */
    margin-bottom: 8px;
  }

  .stat-number img {
    width: 38px;               /* ikon lebih kecil biar proporsional */
    height: auto;
  }

  .stat-number span {
    font-size: 2rem !important;
  }

  /* GARIS TIPIS DI BAWAH ANGKA */
  .stat-label {
    border-top: 1px solid rgba(255,255,255,0.4) !important;
    padding-top: 10px;
    width: 70%;
    margin-left: auto;
    margin-right: auto;
    font-size: 1rem;
  }

}
/* FIX RESPONSIVE STATISTICS — MOBILE MODE */
@media (max-width: 576px) {

  .statistics-section {
    padding: 50px 0;
  }

  .stat-card {
    padding: 20px 0;
  }

  /* ICON */
  .stat-number img {
    width: 45px !important;
    margin-bottom: -5px;
  }

  /* NUMBER BESAR */
  .stat-number span {
    font-size: 2rem !important;
    margin-left: 8px;
  }

  /* TEXT LABEL BAWAH */
  .stat-label {
    font-size: 1rem !important;
    min-width: unset !important;
    width: 100%;
    text-align: center;
    padding-top: 10px;
    border-top: 1.5px solid rgba(255,255,255,0.5) !important;
  }

  /* JARAK ANTAR ITEM */
  .col-md-4 {
    margin-bottom: 25px;
  }
}


/* ===== FIX MOBILE INFO SECTION ===== */
@media (max-width: 576px) {

  /* Biar judul rapi, center */
  .info-section .sesi-judul,
  .info-section .section-subtitle {
    margin-left: 0 !important;
    text-align: center !important;
  }

  /* Gambar laki-laki biar ga gede & ga keluar frame */
  .img-left-wrapper img {
    width: 85% !important;
    margin-left: 0 !important;
    margin-top: -5% !important;
    display: block;
    margin-right: auto;
    margin-left: auto;
  }

  /* Card tanggal biar kecil & rapi */
  .date-card {
    width: 90% !important;
    height: auto !important;
    margin: 20px auto 0 auto !important;
    border-radius: 25px !important;
  }

  .date-card-content {
    padding: 20px 10px !important;
  }

  .date-text {
    font-size: 1.8rem !important;
  }

  .location-text {
    font-size: 0.9rem !important;
  }
}

    @media (max-width: 992px) {
  .hero-title {
    font-size: 3rem;
  }

      .section-title {
        font-size: 2.5rem;
      }

      .carousel-container {
        height: 400px;
      }

      .testimonial-card {
        margin-bottom: 30px;
      }
    }

    @media (max-width: 768px) {
      .img-left-wrapper {
        justify-content: center;  /* Memusatkan gambar di layar kecil */
    }

    .responsive-img {
        width: 80%;  /* Mengurangi ukuran gambar untuk layar kecil */
        margin-left: 0;  /* Menghapus margin kiri */
        margin-top: 0;  /* Menghapus margin atas */
    }
      @media (max-width: 768px) {
  .logo-wrapper {
    display: none;
  }
}

      .hero-section {
        padding: 80px 0 60px;
      }

      .hero-title {
    font-size: 2.2rem;
  }

      .hero-subtitle {
        font-size: 2rem;
      }

      .hero-description {
        font-size: 1rem;
      }

      .section-title {
        font-size: 2rem;
      }

      .date-card {
        padding: 35px 25px;
      }

      .date-text {
        font-size: 2.5rem;
      }

      .stat-number {
        font-size: 3rem;
      }

      .carousel-container {
        height: 300px;
        border-radius: 20px;
      }

      .carousel-button {
        width: 45px;
        height: 45px;
        font-size: 1.2rem;
      }

      .carousel-button.prev {
        left: 15px;
      }

      .carousel-button.next {
        right: 15px;
      }

      .btn-primary-custom,
      .btn-secondary-custom {
        padding: 12px 30px;
        font-size: 0.95rem;
      }
    }

    @media (max-width: 576px) {
      .hero-title {
    font-size: 1.8rem;
  }

      .date-icon {
        font-size: 3rem;
      }

      .date-text {
        font-size: 2rem;
      }

      .location-text {
        font-size: 1rem;
        flex-direction: column;
        gap: 5px;
      }

      .stat-icon {
        font-size: 3rem;
      }

      .stat-number {
        font-size: 2.5rem;
      }

      .carousel-container {
        height: 250px;
      }
    }

    /* Smooth scroll behavior */
    html {
      scroll-behavior: smooth;
    }

    /* Selection color */
    ::selection {
      background: #980517;
      color: white;
    }

    
  </style>

</head>

<body>

  <!-- MAIN CONTENT SECTION -->
 <!-- HERO SECTION -->
  <section class="hero-section" id="home">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 hero-content">

           <!--<div class="hero-badge">
           <i class="fas fa-sparkles me-2"></i>
            Selamat Datang di Universitas Horizon
          </div>-->
          
          <div class="hero-subtitle">
            <span class="text-graduation">Sistem</span>
            <span class="text-system">Wisuda</span>
          </div>

          <h1 class="hero-title">
  <span class="line-1">
    Universitas <span class="text-red">Horizon</span>
  </span>
  <br>
  <span class="line-2">
    Indonesia
  </span>
</h1>


          
          <p class="hero-description">
            Sistem wisuda Universitas Horizon yang memfasilitasi akses jadwal, informasi, dan dokumentasi wisuda</p>
          <!--<div class="hero-buttons">
            <a href="#info" class="btn-primary-custom">
              <i class="fas fa-calendar-check me-2"></i>
              Cek Jadwal
            </a>
            <a href="#media" class="btn-secondary-custom">
              <i class="fas fa-play-circle me-2"></i>
              Lihat Galeri
            </a>
          </div>-->
        </div>
        <div class="col-lg-6 mt-5 mt-lg-0">
          <div class="hero-image-container">
            <div class="text-center">
              <img src="images/org1.png" alt="Mahasiswa Wisuda" style="width: 140%; margin-left: 6%; margin-top: -43%;">
            </div>
            <!--<div class="floating-element floating-1">✨</div>
            <div class="floating-element floating-2">📚</div>-->
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- INFO SECTION -->
  <section class="info-section" id="info">

  <style>
/* Geser judul & subtitle hanya dalam info-section */
.info-section .sesi-judul,
.info-section .section-subtitle {
  text-align: left;
  margin-left: 40%;
  margin-bottom: 0px;
}

/* Biar tidak patah di layar kecil */
@media (max-width: 992px) {
  .info-section .sesi-judul,
  .info-section .section-subtitle {
    margin-left: 0;
    text-align: center;
  }
}

</style>


  <div class="container">
    <h2 class="sesi-judul">
  <span class="info-baris">Informasi</span><br>
  <span class="garis-baris">
    Jadwal <span class="text-merah">Wisuda</span>
  </span>
</h2>

    <p class="section-subtitle" style="margin-bottom: 0px;">
      Cek jadwal wisuda terbaru untuk setiap program studi agar momen berharga Anda berjalan lancar.</p>

    <div class="row align-items-center">
      
      <!-- GAMBAR DI KIRI -->
      <div class="col-lg-6 order-lg-1 img-left-wrapper">
    <img src="images/org2.png" alt="Wisudawan" class="responsive-img" style="margin-left: -25%;">
</div>


      <!-- KALENDAR + TULISAN DI KANAN -->
      <div class="col-lg-6 mb-4 mb-lg-0 order-lg-2" style="margin-top: 0px;">
        <div class="date-card" style="margin-top: 0px;">
          <div class="date-card-content">
            <div class="date-icon" style="margin-top: -5%;">
              <img src="images/date.png" alt="">
            </div>
            <div class="date-text" style="margin-top: -2%;">20 Jan 2025</div>
            <div class="location-text">
              <i class="fas fa-map-marker-alt"></i>
              <span>Hotel Resinda - Karawang</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>


  <!-- STATISTICS SECTION -->
  <section class="statistics-section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="stat-card">
            <!--<div class="stat-icon">🎓</div>-->
            <div class="stat-number"><img src="images/Vector.png" alt="">
              <span>5,025</span></div>
            <div class="stat-label">Total Lulusan</div>
          </div>
        </div>
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="stat-card">
            <!--<div class="stat-icon">👥</div>-->
            <div class="stat-number"><img src="images/Vector2.png" alt="">
              <span>5,025</span></div>
            <div class="stat-label">Mahasiswa Aktif</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="stat-card">
            <!--<div class="stat-icon">✨</div>-->
            <div class="stat-number"><img src="images/Vector3.png" alt="">
              <span>5,025</span></div>
            <div class="stat-label">Calon Lulusan</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MEDIA SECTION -->
  <section class="media-section" id="media">
    <div class="container">
      <h2 class="section-title">MEDIA WISUDA</h2>
      <!--<p class="section-subtitle">
        Kenang kembali momen berkesan dan rayakan pencapaian melalui koleksi media wisuda kami yang terpilih.
      </p>-->
      
      <div class="carousel-container">
        <!--<button class="carousel-button prev" onclick="moveSlide(-1)">
          <i class="fas fa-chevron-left"></i>-->
        </button>
        <div class="carousel-track" id="carouselTrack">
          <div class="carousel-slide"><img src="images/gmr1.png" alt=""></div>
          <div class="carousel-slide"><img src="images/gmr2.png" alt=""></div>
          <div class="carousel-slide"><img src="images/gmr3.png" alt=""></div>
          <div class="carousel-slide"><img src="images/gmr4.png" alt=""></div>
        </div>
        <!--<button class="carousel-button next" onclick="moveSlide(1)">
          <i class="fas fa-chevron-right"></i>-->
        </button>
      </div>
      <div class="carousel-indicators" id="carouselIndicators"></div>
    </div>
  </section>

  <!-- TESTIMONIALS SECTION -->
  <section class="testimonials-section" id="testimonials">
    <div class="container">
      <div class="testimonials-badge">
        <!--<i class="fas fa-star me-2"></i>-->
        Jangkauan Kami
      </div>
      <h2 class="section-title section-title-custom">
  Apa Kata <span class="our-red">Lulusan</span> Kami!
</h2>


      <p class="section-subtitle subtitle-full">
  Wisuda adalah pencapaian yang membanggakan — temukan kisah inspiratif dari lulusan Universitas Horizon Indonesia
</p>

      <div class="row testimonial-row">
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="testimonial-card compact">
            <div class="quote-icon">
              <i class="fas fa-quote-left"></i>
            </div>
            <p class="testimonial-text">
              Universitas Horizon Indonesia membentuk saya menjadi pribadi yang siap menghadapi dunia kerja. Pengalamannya benar-benar transformatif.
            </p>
              <div class="author-info">
                <div class="author-name">Liana</div>
                <div class="author-year">Lulusan 2025</div>
              </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
          <div class="testimonial-card compact">
            <div class="quote-icon">
              <i class="fas fa-quote-left"></i>
            </div>
            <p class="testimonial-text">
              Para dosen di sini sangat suportif dan selalu mendorong kami untuk meraih impian. Saya selamanya berterima kasih atas bimbingan mereka.
            </p>
              <div class="author-info">
                <div class="author-name">Ririn</div>
                <div class="author-year">Lulusan 2025</div>
              </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
          <div class="testimonial-card compact">
            <div class="quote-icon">
              <i class="fas fa-quote-left"></i>
            </div>
            <p class="testimonial-text">
              Fasilitas kampus yang hebat dan lingkungan belajar yang kondusif membuat perjalanan studi saya menyenangkan dan produktif setiap hari.
            </p>
              <div class="author-info">
                <div class="author-name">Nimas</div>
                <div class="author-year">Lulusan 2025</div>
              </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
          <div class="testimonial-card compact">
            <div class="quote-icon">
              <i class="fas fa-quote-left"></i>
            </div>
            <p class="testimonial-text">
              Kurikulum praktis benar-benar membantu saya memahami tantangan industri nyata dan mempersiapkan saya dengan baik untuk karier.
            </p>
              <div class="author-info">
                <div class="author-name">Hani</div>
                <div class="author-year">Lulusan 2024</div>
              </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
          <div class="testimonial-card compact">
            <div class="quote-icon">
              <i class="fas fa-quote-left"></i>
            </div>
            <p class="testimonial-text">
              Saya tidak hanya mendapat ilmu tetapi juga koneksi berharga dan persahabatan seumur hidup. Kenangan ini akan selalu bersama saya.
            </p>
              <div class="author-info">
                <div class="author-name">Wulan</div>
                <div class="author-year">Lulusan 2024</div>
              </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 mb-4">
          <div class="testimonial-card compact">
            <div class="quote-icon">
              <i class="fas fa-quote-left"></i>
            </div>
            <p class="testimonial-text">
              Keputusan terbaik yang saya buat adalah memilih Universitas Horizon untuk perjalanan pendidikan saya. Melebihi semua ekspektasi saya.
            </p>
              <div class="author-info">
                <div class="author-name">Gita</div>
                <div class="author-year">Lulusan 2024</div>
              </div>
          </div>
        </div>
      </div>
      <div class="testimonial-dots">
  <span class="dot active"></span>
  <span class="dot"></span>
  <span class="dot"></span>
  <span class="dot"></span>
</div>

    </div>
  </section>

  <!--footer desain-->
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

    <div class="footer-line"></div>

    <p class="footer-copy">
      © 2025 <strong>GRAD-System</strong> | Horizon University Indonesia
    </p>

  </div>
</footer>



  <!-- FOOTER ver me
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6 footer-section">
          <h3 class="footer-title">
            <i class="fas fa-phone-alt me-2"></i>
            Contact Us
          </h3>
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-phone"></i>
            </div>
            <div class="contact-text">
              <strong>Phone</strong><br>
              <a href="tel:08118454800">0811-8454-800</a>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-envelope"></i>
            </div>
            <div class="contact-text">
              <strong>Email</strong><br>
              <a href="mailto:info.krw@horizon.ac.id">info.krw@horizon.ac.id</a>
            </div>
          </div>
          <div class="contact-item">
            <div class="contact-icon">
              <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="contact-text">
              <strong>Address</strong><br>
              Jl. Pangkal Perjuangan KM. 1<br>
              By Pass Karawang - Jawa Barat
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6 footer-section">
          <h3 class="footer-title">
            <i class="fas fa-link me-2"></i>
            Quick Links
          </h3>
          <div class="d-flex flex-column">
            <a href="#" class="footer-link">
              <i class="fas fa-chevron-right me-2"></i>About University
            </a>
            <a href="#" class="footer-link">
              <i class="fas fa-chevron-right me-2"></i>Academic Programs
            </a>
            <a href="#" class="footer-link">
              <i class="fas fa-chevron-right me-2"></i>Student Portal
            </a>
            <a href="#" class="footer-link">
              <i class="fas fa-chevron-right me-2"></i>Career Services
            </a>
            <a href="#" class="footer-link">
              <i class="fas fa-chevron-right me-2"></i>Alumni Network
            </a>
          </div>
        </div>

        <div class="col-lg-4 col-md-12 footer-section">
          <h3 class="footer-title">
            <i class="fas fa-university me-2"></i>
            About Us
          </h3>
          <p style="line-height: 1.8; color: rgba(255, 255, 255, 0.8);">
            Horizon University Indonesia is committed to providing the best education and services to prepare students for success in their careers and life.
          </p>
          <div class="social-links mt-4">
            <a href="#" title="Facebook">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" title="Twitter">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#" title="Instagram">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" title="LinkedIn">
              <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="#" title="YouTube">
              <i class="fab fa-youtube"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <p class="mb-0">
          © <script>document.write(new Date().getFullYear());</script>2024 Horizon University Indonesia - GRAD-System | All Rights Reserved
        </p>
      </div>
    </div>
  </footer>-->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<!-- Testimonial Dots Script -->
<script>
  const row = document.querySelector('.testimonial-row');
  const dots = document.querySelectorAll('.testimonial-dots .dot');

  if (row && dots.length > 0) {
    row.addEventListener('scroll', () => {
      const slideWidth = row.children[0].offsetWidth;
      const index = Math.round(row.scrollLeft / slideWidth);

      dots.forEach((dot, i) => {
        dot.classList.toggle('active', i === index);
      });
    });
  }
</script>

<!-- Carousel Functionality Script -->
<script>
  // Carousel functionality
  let currentSlide = 0;
  const totalSlides = 4;
  let autoSlideInterval;

  function initCarousel() {
    const indicators = document.getElementById('carouselIndicators');
    if (!indicators) return;
    
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
    autoSlideInterval = setInterval(() => {
      moveSlide(1);
    }, 5000);
  }

  function resetAutoSlide() {
    clearInterval(autoSlideInterval);
    startAutoSlide();
  }

  // Touch/swipe support
  let touchStartX = 0;
  let touchEndX = 0;

  function handleGesture() {
    if (touchEndX < touchStartX - 50) moveSlide(1);
    if (touchEndX > touchStartX + 50) moveSlide(-1);
  }

  const carouselTrack = document.getElementById('carouselTrack');
  
  if (carouselTrack) {
    carouselTrack.addEventListener('touchstart', e => {
      touchStartX = e.changedTouches[0].screenX;
    });

    carouselTrack.addEventListener('touchend', e => {
      touchEndX = e.changedTouches[0].screenX;
      handleGesture();
    });
  }

  // Initialize
  window.addEventListener('DOMContentLoaded', () => {
    initCarousel();
  });
</script>

<!-- Smooth Scroll Navigation -->
<script>
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
</script>

</body>
</html>