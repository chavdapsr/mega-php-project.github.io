<?php
$title = 'Home';
ob_start();
?>

<div class="hero">
    <h1>Welcome to Mega PHP Learning Project</h1>
    <p class="lead">A comprehensive PHP project demonstrating MVC architecture, authentication, CRUD operations, and RESTful APIs.</p>
    
    <?php if (!isset($user) || !$user): ?>
        <div class="cta-buttons">
            <a href="/register" class="btn btn-primary">Get Started</a>
            <a href="/login" class="btn btn-secondary">Login</a>
        </div>
    <?php else: ?>
        <div class="cta-buttons">
            <a href="/posts" class="btn btn-primary">View Posts</a>
            <a href="/posts/create" class="btn btn-secondary">Create Post</a>
        </div>
    <?php endif; ?>
</div>

<div class="features">
    <div class="feature-card">
        <h3>🔐 Authentication</h3>
        <p>User registration, login, and session management with secure password hashing.</p>
    </div>
    <div class="feature-card">
        <h3>📝 CRUD Operations</h3>
        <p>Full Create, Read, Update, Delete functionality for posts with user ownership.</p>
    </div>
    <div class="feature-card">
        <h3>🌐 RESTful API</h3>
        <p>JSON API endpoints for posts and users with proper HTTP status codes.</p>
    </div>
    <div class="feature-card">
        <h3>🏗️ MVC Architecture</h3>
        <p>Clean separation of concerns with Models, Views, and Controllers.</p>
    </div>
    <div class="feature-card">
        <h3>🔒 Security</h3>
        <p>CSRF protection, prepared statements, and password hashing.</p>
    </div>
    <div class="feature-card">
        <h3>💾 Database</h3>
        <p>PDO-based database abstraction with singleton pattern.</p>
    </div>
</div>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>
