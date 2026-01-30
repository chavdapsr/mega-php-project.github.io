<?php
$title = 'Edit Post';
ob_start();
?>

<h1>Edit Post</h1>

<form method="POST" action="/posts/<?= $post['id'] ?>" class="post-form">
    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token) ?>">
    
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="<?= htmlspecialchars($post['title']) ?>" required autofocus>
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea id="content" name="content" rows="10" required><?= htmlspecialchars($post['content']) ?></textarea>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">Update Post</button>
        <a href="/posts/<?= $post['id'] ?>" class="btn btn-secondary">Cancel</a>
    </div>
</form>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>
