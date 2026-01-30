<?php
$title = 'All Posts';
ob_start();
?>

<h1>All Posts</h1>

<?php if (empty($posts)): ?>
    <p>No posts yet. <a href="/posts/create">Create the first one!</a></p>
<?php else: ?>
    <div class="posts-grid">
        <?php foreach ($posts as $post): ?>
            <div class="post-card">
                <h3><a href="/posts/<?= $post['id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h3>
                <p class="post-meta">
                    By <?= htmlspecialchars($post['username'] ?? 'Unknown') ?> 
                    on <?= date('F j, Y', strtotime($post['created_at'])) ?>
                </p>
                <p class="post-excerpt"><?= htmlspecialchars(substr($post['content'], 0, 150)) ?>...</p>
                <a href="/posts/<?= $post['id'] ?>" class="btn btn-sm">Read More</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';
?>
