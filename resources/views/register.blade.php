<!DOCTYPE html>
<html>
<head>
    <title>Register Multi Role</title>
</head>
<body>
    <h2>Register</h2>

    @if (session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li style="color:red;">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Role:</label><br>
        <select name="role" required>
            <option value="mahasiswa">Mahasiswa</option>
            <option value="baak">BAAK</option>
            <option value="finance">FINANCE</option>
            <option value="perpustakaan">PERPUSTAKAAN</option>
            <option value="fakultas">FAKULTAS</option>
        </select><br><br>

        <button type="submit">Register</button>
    </form>
</body>
</html>
