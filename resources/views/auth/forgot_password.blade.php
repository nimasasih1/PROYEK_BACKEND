<h3>Lupa Password</h3>

<!-- Request OTP -->
<form action="{{ route('forgot.requestOtp') }}" method="POST">
    @csrf
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Email tujuan (siswa)</label>
    <input type="email" name="send_to" required>

    <button type="submit">Kirim OTP</button>
</form>

<hr>

<!-- Reset Password -->
<form action="{{ route('forgot.resetPassword') }}" method="POST">
    @csrf
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Kode OTP</label>
    <input type="text" name="otp_code" required>

    <label>Password Baru</label>
    <input type="password" name="new_password" required>

    <label>Konfirmasi Password Baru</label>
    <input type="password" name="new_password_confirmation" required>

    <button type="submit">Reset Password</button>
</form>
