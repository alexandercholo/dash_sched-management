<form method="POST" action="{{ route('admin.login') }}">
    @csrf
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
    </div>

    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" required>
    </div>

    <button type="submit">Login</button>
</form>

@error('email')
    <div>{{ $message }}</div>
@enderror
