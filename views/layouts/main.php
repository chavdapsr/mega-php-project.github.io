<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Mega PHP Learning Project' ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="/" class="logo">PHP Learning</a>
            <ul class="nav-menu">
                <li><a href="/">Home</a></li>
                <li><a href="/posts">Posts</a></li>
                <?php if (isset($user) && $user): ?>
                    <li><a href="/posts/create">Create Post</a></li>
                    <li><span class="user-info">Welcome, <?= htmlspecialchars($user['username']) ?></span></li>
                    <li>
                        <form method="POST" action="/logout" style="display: inline;">
                            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(\App\Core\Session::get('csrf_token') ?? '') ?>">
                            <button type="submit" class="btn-link">Logout</button>
                        </form>
                    </li>
                <?php else: ?>
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <main class="container">
        <?php if ($flash_message = \App\Core\Session::flash('success')): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($flash_message) ?>
            </div>
        <?php endif; ?>

        <?php if ($flash_message = \App\Core\Session::flash('error')): ?>
            <div class="alert alert-error">
                <?= htmlspecialchars($flash_message) ?>
            </div>
        <?php endif; ?>

        <?= $content ?? '' ?>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?= date('Y') ?> Mega PHP Learning Project. Built for educational purposes.</p>
        </div>
    </footer>
</body>
</html>
