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
  font-size: 3.2rem;
  font-weight: 850;
  line-height: 1.2;
  margin-top: 0px;
  margin-bottom: 30px;
  letter-spacing: 0.5px;
  color: #000;
  animation: slideInLeft 0.8s ease 0.2s both;
}

.text-red {
  color: #980517;
}

    @keyframes slideInLeft {
      from { opacity: 0; transform: translateX(-50px); }
      to { opacity: 1; transform: translateX(0); }
    }

    .hero-subtitle {
      font-size: 2.4rem;
      color: #555;
      margin-bottom: 1px;
      font-weight: 600;
      font-family: 'Raleway', sans-serif;
      letter-spacing: 1px;
      animation: slideInLeft 0.8s ease 0.3s both;
    }

    .text-graduation { color: #980517; font-weight: 400; }
    .text-system { color: #000000; font-weight: 400; }

    .hero-description {
      font-family: 'Raleway', sans-serif;
      font-size: 1.15rem;
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

    .floating-element {
      position: absolute;
      animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
    }

    .floating-1 { top: 10%; right: -5%; font-size: 2.5rem; animation-delay: 0s; }
    .floating-2 { bottom: 15%; right: 5%; font-size: 2rem; animation-delay: 2s; }

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
      font-size: 2.5rem;
      font-weight: 600;
      text-align: center;
      margin-bottom: 20px;
      background: linear-gradient(135deg, #980517 0%, #c41e3a 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .section-title-custom {
      background: none !important;
      -webkit-text-fill-color: #000 !important;
      color: #000 !important;
    }

    .section-title-custom .our-red {
      color: #980517 !important;
      -webkit-text-fill-color: #980517 !important;
    }

    .section-subtitle {
      text-align: center;
      color: #000000;
      font-size: 1.2rem;
      margin-bottom: 60px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }

    .subtitle-full {
      max-width: none !important;
      width: 100% !important;
      text-align: center;
      margin-left: 0 !important;
      margin-right: 0 !important;
    }

    .sesi-judul {
      font-family: 'Raleway', sans-serif;
      font-weight: 200;
      line-height: 1.2;
      margin-bottom: 10px;
    }

    .garis-baris { font-weight: 501; font-size: 2.5rem; }
    .sesi-judul .info-baris { color: #000; }
    .sesi-judul .garis-baris { color: #000; }
    .sesi-judul .text-merah { color: #980517; }

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

    .date-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 30px 80px rgba(152, 5, 23, 0.4);
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

    .date-icon img { width: 30px; height: auto; display: block; margin-top: 5%; }

    .date-text {
      font-family: 'Radio Canada', sans-serif;
      font-size: 2.2rem;
      font-weight: 700;
      color: #ffffff;
      margin: 5px 0;
    }

    .location-text {
      font-family: 'Radio Canada', sans-serif;
      font-size: 1.1rem;
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
      background-image: repeating-linear-gradient(45deg, transparent, transparent 35px, rgba(255, 255, 255, 0.03) 35px, rgba(255, 255, 255, 0.03) 70px);
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

    .stat-card:hover { transform: translateY(-10px); }
    .stat-icon { font-size: 4rem; margin-bottom: 20px; filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.3)); transition: all 0.3s ease; }
    .stat-card:hover .stat-icon { transform: scale(1.2) rotate(5deg); }

    .stat-number {
      font-size: 2.5rem;
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
    .media-section { padding: 100px 0; background: #f8f9fa; position: relative; }

    .carousel-container {
  position: relative;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
  width: 100%;
  height: 500px;
  background: #1a1a1a;  /* ← tambahkan ini */
}

    .carousel-track {
      display: flex;
      transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
      height: 100%;
    }

    .carousel-slide {
      min-width: 100%;
      height: 100%;
      background: #1a1a1a;
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
  object-fit: contain;
  object-position: center center;
  background: #1a1a1a;
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

    .carousel-button.prev { left: 30px; }
    .carousel-button.next { right: 30px; }

    .carousel-indicators { display: flex; justify-content: center; gap: 12px; margin-top: 40px; }

    .carousel-dot {
      width: 14px;
      height: 14px;
      border-radius: 50%;
      cursor: pointer;
      transition: all 0.3s ease;
      border: 2px solid #980517;
    }

    .carousel-dot.active { background: #980517; transform: scale(1.3); box-shadow: 0 5px 15px rgba(152, 5, 23, 0.4); }
    .carousel-dot.inactive { background: transparent; }
    .carousel-dot:hover { transform: scale(1.4); }

    /* TESTIMONIALS */
    .testimonials-section { padding: 100px 0; background: white; }

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

    .testimonial-row {
      display: flex;
      flex-wrap: nowrap;
      overflow-x: auto;
      scroll-snap-type: x mandatory;
      -webkit-overflow-scrolling: touch;
      column-gap: 20px;
      padding-bottom: 15px;
    }

    .testimonial-row > .col-lg-4 { flex: 0 0 33.333%; scroll-snap-align: start; }

    @media (max-width: 992px) { .testimonial-row > .col-lg-4 { flex: 0 0 50%; } }
    @media (max-width: 576px) { .testimonial-row > .col-lg-4 { flex: 0 0 85%; } }

    .testimonial-row::-webkit-scrollbar { height: 6px; }
    .testimonial-row::-webkit-scrollbar-track { background: #f3f3f3; border-radius: 10px; }
    .testimonial-row::-webkit-scrollbar-thumb { background: #d1d1d1; border-radius: 10px; }
    .testimonial-row::-webkit-scrollbar-thumb:hover { background: #b5b5b5; }

    .testimonial-dots { display: flex; justify-content: center; margin-top: 10px; gap: 10px; }
    .testimonial-dots .dot { width: 14px; height: 14px; border-radius: 50%; background: #d9d9d9; display: inline-block; transition: background 0.3s; }
    .testimonial-dots .dot.active { background: #980517; }

    .testimonial-card.compact { padding: 25px 28px; height: auto; min-height: 260px; border-radius: 20px; }
    .testimonial-card.compact .quote-icon i { font-size: 2rem; color: #d9979d; margin-bottom: 15px; }
    .testimonial-card.compact .testimonial-text { font-size: 1rem; line-height: 1.6; margin-bottom: 25px; color: #555; }
    .testimonial-card.compact .testimonial-author { margin-top: 20px; display: flex; align-items: center; gap: 12px; justify-content: center; text-align: center; }
    .testimonial-card.compact .author-info { text-align: center; }
    .testimonial-card.compact .author-name { font-size: 1.1rem; font-weight: 600; color: #980517; margin-bottom: 3px; }
    .testimonial-card.compact .author-year { font-size: 0.95rem; color: #777; }

    .quote-icon { font-size: 3rem; color: #980517; opacity: 0.3; margin-bottom: 20px; }
    .testimonial-text { font-size: 1.15rem; line-height: 1.8; color: #555; margin-bottom: 30px; font-style: italic; }
    .testimonial-author { display: flex; align-items: center; gap: 15px; padding-top: 20px; border-top: 2px solid #f0f0f0; }
    .author-name { font-size: 1.2rem; font-weight: 600; color: #980517; margin-bottom: 3px; }
    .author-year { font-size: 1rem; color: #777; }

    .footer {
      background: linear-gradient(135deg, #800016, #5e0011);
      padding: 60px 0 25px;
      color: #fff;
      font-family: 'Radio Canada', sans-serif;
    }

    .footer-content { display: flex; justify-content: space-between; gap: 40px; margin-bottom: 45px; flex-wrap: wrap; }
    .footer-col { flex: 1; min-width: 250px; }
    .footer-col h4 { font-size: 1.15rem; font-weight: 700; margin-bottom: 18px; text-transform: uppercase; letter-spacing: 1px; position: relative; }
    .footer-col h4::after { content: ""; width: 40px; height: 3px; background: #ffffff; position: absolute; left: 0; bottom: -8px; opacity: 0.8; }
    .footer-col p { margin: 0 0 12px; font-size: 1.05rem; line-height: 1.6; opacity: 0.9; }
    .footer-social { display: flex; justify-content: center; gap: 22px; margin-bottom: 30px; }
    .footer-social a { text-decoration: none; }
    .footer-social i { color: #fff; border: 2px solid rgba(255,255,255,0.8); width: 42px; height: 42px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; transition: all 0.3s ease; }
    .footer-line { width: 70%; height: 1px; background: rgba(255,255,255,0.4); margin: 0 auto 20px; }
    .footer-copy { text-align: center; font-size: 0.85rem; letter-spacing: 0.4px; opacity: 0.85; }

    /* RESPONSIVE */
    @media (max-width: 576px) {
      .hero-section { text-align: center; padding-top: 40px; }
      .hero-title { font-size: 1.8rem !important; line-height: 1.3 !important; }
      .hero-subtitle { font-size: 1.4rem !important; margin-bottom: 15px; }
      .hero-description { width: 90%; margin: 0 auto 20px; font-size: 0.95rem !important; }
      .hero-image-container img { width: 90% !important; margin: 0 auto !important; display: block; margin-top: 10px !important; }
      .img-left-wrapper img { width: 60% !important; margin: 0 auto !important; margin-top: -15% !important; display: block; }
      .img-left-wrapper { display: flex; justify-content: center; align-items: center; text-align: center; }
      .responsive-img { max-width: 100%; height: auto; }
      .info-section .sesi-judul { margin-bottom: 10px !important; }
      .section-subtitle { margin-bottom: 20px !important; }
      .date-card { width: 92% !important; margin-top: -5% !important; padding: 20px 0 !important; border-radius: 22px !important; height: auto !important; }
      .date-text { font-size: 1.6rem !important; }
      .location-text { font-size: 0.85rem !important; }
      .stat-card { text-align: center !important; padding: 25px 10px !important; }
      .stat-number { display: flex; flex-direction: row; justify-content: center; align-items: center; gap: 10px; margin-bottom: 8px; }
      .stat-number img { width: 38px; height: auto; }
      .stat-number span { font-size: 2rem !important; }
      .stat-label { border-top: 1px solid rgba(255,255,255,0.4) !important; padding-top: 10px; width: 70%; margin-left: auto; margin-right: auto; font-size: 1rem; }
      .statistics-section { padding: 50px 0; }
      .stat-card { padding: 20px 0; }
      .stat-number img { width: 45px !important; margin-bottom: -5px; }
      .stat-number span { font-size: 2rem !important; margin-left: 8px; }
      .stat-label { font-size: 1rem !important; min-width: unset !important; width: 100%; text-align: center; padding-top: 10px; border-top: 1.5px solid rgba(255,255,255,0.5) !important; }
      .col-md-4 { margin-bottom: 25px; }
      .info-section .sesi-judul, .info-section .section-subtitle { margin-left: 0 !important; text-align: center !important; }
      .img-left-wrapper img { width: 85% !important; margin-left: 0 !important; margin-top: -5% !important; display: block; margin-right: auto; margin-left: auto; }
      .date-card { width: 90% !important; height: auto !important; margin: 20px auto 0 auto !important; border-radius: 25px !important; }
      .date-card-content { padding: 20px 10px !important; }
      .date-text { font-size: 1.8rem !important; }
      .location-text { font-size: 0.9rem !important; }
      .hero-title { font-size: 1.8rem; }
      .date-icon { font-size: 3rem; }
      .date-text { font-size: 2rem; }
      .location-text { font-size: 1rem; flex-direction: column; gap: 5px; }
      .stat-icon { font-size: 3rem; }
      .stat-number { font-size: 2.5rem; }
      .carousel-container { max-height: 220px; }
    }

    @media (max-width: 992px) {
      .hero-title { font-size: 2.8rem; }
      .section-title { font-size: 2.2rem; }
      .carousel-container { max-height: 400px; }
      .testimonial-card { margin-bottom: 30px; }
    }

    @media (max-width: 768px) {
      .img-left-wrapper { justify-content: center; }
      .responsive-img { width: 80%; margin-left: 0; margin-top: 0; }
      .hero-section { padding: 80px 0 60px; }
      .hero-title { font-size: 2.4rem; }
      .hero-subtitle { font-size: 1.8rem; }
      .hero-description { font-size: 1.1rem; }
      .section-title { font-size: 1.8rem; }
      .date-card { padding: 35px 25px; }
      .date-text { font-size: 2rem; }
      .stat-number { font-size: 2.2rem; }
      .carousel-container { max-height: 350px; border-radius: 15px; }
      .carousel-button { width: 45px; height: 45px; font-size: 1.2rem; }
      .carousel-button.prev { left: 15px; }
      .carousel-button.next { right: 15px; }
      .btn-primary-custom, .btn-secondary-custom { padding: 12px 30px; font-size: 0.95rem; }
    }

    /* Q&A SECTION */
    .qna-section {
      padding: 80px 0;
      background: #f8f9fa;
    }

    .qna-card {
      background: #fff;
      border-radius: 16px;
      margin-bottom: 12px;
      border: 1px solid rgba(0,0,0,0.05);
      box-shadow: 0 4px 12px rgba(0,0,0,0.03);
      overflow: hidden;
      transition: all 0.3s ease;
    }

    .qna-card:hover {
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
      transform: translateY(-2px);
    }

    .qna-header {
      width: 100%;
      padding: 20px 25px;
      background: none;
      border: none;
      display: flex;
      align-items: center;
      gap: 15px;
      text-align: left;
      cursor: pointer;
    }

    .qna-icon-box {
      width: 40px;
      height: 40px;
      background: #fff0f0;
      color: #980517;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.2rem;
      flex-shrink: 0;
    }

    .qna-question {
      font-size: 1.15rem;
      font-weight: 600;
      color: #2c2c2c;
      flex: 1;
    }

    .qna-answer {
      padding: 0 25px 20px 80px;
      font-size: 1.05rem;
      color: #555;
      line-height: 1.7;
    }

    .qna-chevron {
      color: #aaa;
      transition: transform 0.3s ease;
    }

    .qna-header:not(.collapsed) .qna-chevron {
      transform: rotate(180deg);
      color: #980517;
    }

    html { scroll-behavior: smooth; }
    ::selection { background: #980517; color: white; }
</style>

</head>
<body>

  <!-- HERO SECTION -->
  <section class="hero-section" id="home">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 hero-content">
          <div class="hero-subtitle">
            <span class="text-graduation">Graduation</span>
            <span class="text-system">System</span>
          </div>
          <h1 class="hero-title">
            <span class="line-1">Universitas <span class="text-red">Horizon</span></span>
            <br>
            <span class="line-2">Indonesia</span>
          </h1>
          <p class="hero-description">
            Horizon University graduation system — your hub for schedules, information, and graduation documents.</p>
        </div>
        <div class="col-lg-6 mt-5 mt-lg-0">
          <div class="hero-image-container">
            <div class="text-center">
              <img src="images/org1.png" alt="Graduation Student" style="width: 140%; margin-left: 6%; margin-top: -43%;">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- INFO SECTION -->
  <section class="info-section" id="info">
  <style>
    .info-section .sesi-judul, .info-section .section-subtitle { text-align: left; margin-left: 40%; margin-bottom: 0px; }
    @media (max-width: 992px) { .info-section .sesi-judul, .info-section .section-subtitle { margin-left: 0; text-align: center; } }
  </style>
  <div class="container">
    <h2 class="sesi-judul">
      <span class="info-baris">Graduation</span><br>
      <span class="garis-baris">Schedule <span class="text-merah">Info</span></span>
    </h2>
    <p class="section-subtitle" style="margin-bottom: 0px;">
      Check the latest graduation schedule so your big day goes smoothly.</p>
    <div class="row align-items-center">
      <div class="col-lg-6 order-lg-1 img-left-wrapper">
        <img src="images/org2.png" alt="Graduate" class="responsive-img" style="margin-left: -25%;">
      </div>
      <div class="col-lg-6 mb-4 mb-lg-0 order-lg-2" style="margin-top: 0px;">
        <div class="date-card" style="margin-top: 0px;">
          <div class="date-card-content">
            <div class="date-icon" style="margin-top: -5%;">
              <img src="images/date.png" alt="">
            </div>
            <div class="date-text" style="margin-top: -2%;">
              {{ $info ? \Carbon\Carbon::parse($info->jadwal_wisuda)->format('d M Y') : '-' }}
            </div>
            <div class="location-text">
              <i class="fas fa-map-marker-alt"></i>
              <span>{{ $info->lokasi ?? '-' }}</span>
            </div>
          </div>
        </div>
        @if($info && $info->informasi_baak)
        <section style="background: #fff; padding: 50px 0;">
          <div class="container">
            <div style="border-left: 5px solid #980517; background: #fff8f8; border-radius: 0 12px 12px 0; padding: 25px 30px; box-shadow: 0 4px 15px rgba(152,5,23,0.08);">
              <div style="display:flex; align-items:center; gap:10px; margin-bottom:12px;">
                <i class="fas fa-bullhorn" style="color:#980517; font-size:1.3rem;"></i>
                <h5 style="margin:0; font-weight:700; color:#980517; font-family:'Raleway',sans-serif;">Notice from BAAK</h5>
              </div>
              <p style="margin:0; color:#333; font-size:1rem; line-height:1.8; white-space:pre-line;">{{ $info->informasi_baak }}</p>
            </div>
          </div>
        </section>
        @endif
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
            <div class="stat-number"><img src="images/Vector.png" alt=""><span>{{ number_format($info->jumlah_wisudawan ?? 0) }}</span></div>
            <div class="stat-label">Total Graduates</div>
          </div>
        </div>
        <div class="col-md-4 mb-4 mb-md-0">
          <div class="stat-card">
            <div class="stat-number"><img src="images/Vector2.png" alt=""><span>{{ number_format($info->mahasiswa_aktif ?? 0) }}</span></div>
            <div class="stat-label">Active Students</div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="stat-card">
            <div class="stat-number"><img src="images/Vector3.png" alt=""><span>{{ number_format($info->calon_lulusan ?? 0) }}</span></div>
            <div class="stat-label">Upcoming Graduates</div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- MEDIA SECTION -->
  <section class="media-section" id="media">
    <div class="container">
      <h2 class="section-title">GRADUATION GALLERY</h2>
      <div class="carousel-container">
        <div class="carousel-track" id="carouselTrack">
          @php
            // Kumpulkan semua foto dari semua data informasi
            $semuaFoto = [];
            foreach ($allInfo as $item) {
              foreach (['foto_gallery','foto_gallery_2','foto_gallery_3','foto_gallery_4'] as $f) {
                if (!empty($item->$f)) $semuaFoto[] = $item->$f;
              }
            }
          @endphp

          @if(count($semuaFoto) > 0)
            @foreach($semuaFoto as $foto)
              <div class="carousel-slide">
                <img src="{{ asset($foto) }}" alt="Gallery">
              </div>
            @endforeach
          @else
            {{-- Fallback ke gambar statis --}}
            <div class="carousel-slide"><img src="images/gmr1.png" alt=""></div>
            <div class="carousel-slide"><img src="images/gmr2.png" alt=""></div>
            <div class="carousel-slide"><img src="images/gmr3.png" alt=""></div>
            <div class="carousel-slide"><img src="images/gmr4.png" alt=""></div>
          @endif
        </div>
      </div>
      <div class="carousel-indicators" id="carouselIndicators"></div>
    </div>
  </section>

  <!-- TESTIMONIALS SECTION -->
  <section class="testimonials-section" id="testimonials">
    <div class="container">
      <div class="testimonials-badge">Our Reach</div>
      <h2 class="section-title section-title-custom">
        What Our <span class="our-red">Graduates</span> Say!
      </h2>
      <p class="section-subtitle subtitle-full">
        Graduation is a proud achievement — read inspiring stories from Horizon University Indonesia alumni.
      </p>
      <div class="row testimonial-row">
        @forelse($kesan as $k)
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="testimonial-card compact">
            <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
            <p class="testimonial-text">{{ $k->kesan }}</p>
            <div class="author-info">
              <div class="author-name">{{ $k->nama }}</div>
              <div class="author-year">Class of {{ \Carbon\Carbon::parse($k->tanggal)->format('Y') }}</div>
            </div>
          </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
          <i class="fas fa-quote-left" style="font-size:3rem; color:#ddd;"></i>
          <p class="mt-3 text-muted">No testimonials published yet.</p>
        </div>
        @endforelse
      </div>
      <div class="testimonial-dots">
        <span class="dot active"></span>
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
      </div>
    </div>
  </section>

  <!-- Q&A SECTION -->
  <section class="qna-section" id="faq">
    <div class="container">
      <div class="text-center mb-5">
        <div class="testimonials-badge">FAQ</div>
        <h2 class="section-title section-title-custom">
          Frequently Asked <span class="our-red">Questions</span>
        </h2>
        <p class="section-subtitle">
          Everything you need to know about the graduation process.
        </p>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-10">
          @if(isset($qna) && count($qna) > 0)
            <div class="accordion" id="qnaAccordion">
              @foreach($qna as $i => $q)
                <div class="qna-card">
                  <button class="qna-header collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#qna{{ $i }}">
                    <div class="qna-icon-box">
                      <i class="bi bi-question-lg"></i>
                    </div>
                    <span class="qna-question">{{ $q->pertanyaan }}</span>
                    <i class="bi bi-chevron-down qna-chevron"></i>
                  </button>
                  <div id="qna{{ $i }}" class="collapse" data-bs-parent="#qnaAccordion">
                    <div class="qna-answer">
                      <i class="bi bi-chat-left-text-fill me-2" style="color: #980517; opacity: 0.7;"></i>
                      {{ $q->jawaban }}
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <div class="text-center py-5">
              <i class="bi bi-question-circle" style="font-size: 3rem; color: #ddd;"></i>
              <p class="mt-3 text-muted">No questions available yet.</p>
            </div>
          @endif
        </div>
      </div>
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
          <p>Jl. Pangkal Perjuangan<br>KM.1 By Pass Karawang<br>Jawa Barat, Indonesia</p>
        </div>
      </div>
      <div class="footer-social">
        <a href="#"><i class="fab fa-instagram"></i></a>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-tiktok"></i></a>
      </div>
      <div class="footer-line"></div>
      <p class="footer-copy">© 2025 <strong>GRAD-System</strong> | Horizon University Indonesia</p>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

  <script>
    // ✅ Hitung total slides dari elemen yang ada di DOM
    const totalSlides = document.querySelectorAll('#carouselTrack .carousel-slide').length;
    let currentSlide = 0;
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
      if (currentSlide < 0) currentSlide = totalSlides - 1;
      else if (currentSlide >= totalSlides) currentSlide = 0;
      updateCarousel();
      resetAutoSlide();
    }

    function goToSlide(index) {
      currentSlide = index;
      updateCarousel();
      resetAutoSlide();
    }

    function startAutoSlide() {
      autoSlideInterval = setInterval(() => moveSlide(1), 5000);
    }

    function resetAutoSlide() {
      clearInterval(autoSlideInterval);
      startAutoSlide();
    }

    let touchStartX = 0, touchEndX = 0;
    function handleGesture() {
      if (touchEndX < touchStartX - 50) moveSlide(1);
      if (touchEndX > touchStartX + 50) moveSlide(-1);
    }

    const carouselTrack = document.getElementById('carouselTrack');
    if (carouselTrack) {
      carouselTrack.addEventListener('touchstart', e => { touchStartX = e.changedTouches[0].screenX; });
      carouselTrack.addEventListener('touchend', e => { touchEndX = e.changedTouches[0].screenX; handleGesture(); });
    }

    window.addEventListener('DOMContentLoaded', () => { initCarousel(); });
  </script>

  <script>
    const row = document.querySelector('.testimonial-row');
    const dots = document.querySelectorAll('.testimonial-dots .dot');
    if (row && dots.length > 0) {
      row.addEventListener('scroll', () => {
        const slideWidth = row.children[0].offsetWidth;
        const index = Math.round(row.scrollLeft / slideWidth);
        dots.forEach((dot, i) => { dot.classList.toggle('active', i === index); });
      });
    }
  </script>

  <script>
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) { target.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
      });
    });
  </script>

</body>
</html>