<?php
$title = 'Create Post';
ob_start();
?>

<h1>Create New Post</h1>

<form method="POST" action="/posts" class="post-form">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
    
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required autofocus>
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" name="content" rows="10" required></textarea>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Create Post</button>
        <a href="/posts" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>
