<?php
$title = 'Register';
ob_start();
?>

<div class="auth-container">
    <div class="auth-card">
        <h2>Register</h2>
        <form method="POST" action="/register">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required minlength="6">
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required minlength="6">
            </div>

            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
        
        <p class="auth-link">
            Already have an account? <a href="/login">Login here</a>
        </p>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>
