<form method="POST" action="{{ route('password.verify.otp.submit') }}">
    @csrf
    <input type="text" name="username" placeholder="Masukkan Username" required>
    <input type="text" name="otp" placeholder="Masukkan OTP" required>
    <input type="password" name="password" placeholder="Password Baru" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password Baru" required>
    <button type="submit">Reset Password</button>
</form>
