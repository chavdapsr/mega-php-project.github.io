<?php
$title = 'Login';
ob_start();
?>

<div class="auth-container">
    <div class="auth-card">
        <h2>Login</h2>
        <form method="POST" action="/login">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
        
        <p class="auth-link">
            Don't have an account? <a href="/register">Register here</a>
        </p>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>
