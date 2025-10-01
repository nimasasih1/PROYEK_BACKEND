<form method="POST" action="{{ route('password.send.otp') }}">
    @csrf
    <input type="text" name="username" placeholder="Masukkan Username" required>
    <button type="submit">Kirim OTP</button>
</form>
