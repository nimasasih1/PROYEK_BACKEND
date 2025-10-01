<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <form method="POST" action="{{ route('reset.password') }}">
        @csrf
        <input type="hidden" name="email" value="{{ $email }}">
        <label>Password Baru:</label>
        <input type="password" name="password" required>
        <br>
        <label>Konfirmasi Password:</label>
        <input type="password" name="password_confirmation" required>
        <br>
        <button type="submit">Simpan Password</button>
    </form>
</body>
</html>
