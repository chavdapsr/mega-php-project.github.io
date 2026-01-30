<?php
$title = htmlspecialchars($post['title']);
ob_start();
?>

<article class="post-detail">
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <p class="post-meta">
        By <?= htmlspecialchars($post['username'] ?? 'Unknown') ?> 
        on <?= date('F j, Y g:i A', strtotime($post['created_at'])) ?>
    </p>
    
    <div class="post-content">
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </div>

    <?php if (isset($user) && $user && $post['user_id'] == $user['id']): ?>
        <div class="post-actions">
            <a href="/posts/<?= $post['id'] ?>/edit" class="btn btn-secondary">Edit</a>
            <form method="POST" action="/posts/<?= $post['id'] ?>/delete" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this post?');">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrf_token ?? '') ?>">
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    <?php endif; ?>
</article>

<a href="/posts" class="btn btn-link">← Back to Posts</a>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>
