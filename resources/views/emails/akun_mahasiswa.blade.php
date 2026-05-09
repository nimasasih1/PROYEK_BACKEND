<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background:#f4f4f4; padding:20px; }
        .card { background:#fff; border-radius:10px; padding:30px; max-width:500px; margin:0 auto; }
        .header { background:#980517; color:#fff; padding:20px; border-radius:8px; text-align:center; margin-bottom:20px; }
        .info-box { background:#fff8f8; border-left:4px solid #980517; padding:15px; border-radius:4px; margin:15px 0; }
        .label { font-size:0.85rem; color:#888; margin-bottom:4px; }
        .value { font-size:1.1rem; font-weight:bold; color:#333; }
        .footer { text-align:center; font-size:0.8rem; color:#aaa; margin-top:20px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="header">
            <h2 style="margin:0;">🎓 GRAD-System</h2>
            <p style="margin:5px 0 0; opacity:0.85;">Horizon University Indonesia</p>
        </div>

        <p>Halo, <strong>{{ $nama }}</strong>!</p>
        <p>Akun kamu untuk sistem wisuda Horizon University sudah dibuat. Berikut informasi login kamu:</p>

        <div class="info-box">
            <div class="label">Username / NIM</div>
            <div class="value">{{ $nim }}</div>
        </div>

        <div class="info-box">
            <div class="label">Password</div>
            <div class="value">{{ $password }}</div>
        </div>

        <p style="color:#e07b00; font-size:0.9rem;">
            ⚠️ Segera ganti password kamu setelah login pertama kali!
        </p>

        <p>Login di: <a href="{{ config('app.url') }}">{{ config('app.url') }}</a></p>

        <div class="footer">
            © {{ date('Y') }} Horizon University Indonesia. All rights reserved.
        </div>
    </div>
</body>
</html>