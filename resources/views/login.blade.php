@if (session('success'))
    <div style="color:green;">
        <p>{{ session('success') }}</p>
    </div>
@endif
 
<form method="POST" action="{{ route('login.submit') }}">
    @csrf
    <div class="mb-3">
        <label>Username / NIM</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>

@if($errors->any())
    <div style="color:red;">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<br>

<!-- Tombol/link menuju halaman register -->
<a href="{{ route('register.form') }}">
    <button type="button">Register</button>
</a>

<br><br>

<a href="{{ route('forgot.form') }}">
    <button type="button">Lupa Kata Sandi?</button>
</a>