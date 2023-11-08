<form action="/api/auth/login" method="POST">
    @csrf
    <input type="text" name="email">
    <input type="text" name="password">
    <button type="submit">Submit</button>
</form>
