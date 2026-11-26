<?php require_once __DIR__.'/functions.php'; ?>
<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title><?= e($pageTitle ?? APP_NAME) ?></title><link rel="stylesheet" href="<?= BASE_URL ?>/assets/style.css"></head><body>
<header class="topbar"><a class="brand" href="<?= BASE_URL ?>/index.php">✦ Glow & Go</a><nav>
<a href="<?= BASE_URL ?>/index.php">Home</a><a href="<?= BASE_URL ?>/services.php">Services</a>
<?php if (current_user()): ?><a href="<?= BASE_URL ?>/dashboard.php">My account</a><?php if (in_array(current_user()['role'],['admin','staff'],true)): ?><a href="<?= BASE_URL ?>/admin.php">Manage</a><?php endif; ?><a href="<?= BASE_URL ?>/logout.php">Logout</a>
<?php else: ?><a href="<?= BASE_URL ?>/login.php">Login</a><a class="nav-cta" href="<?= BASE_URL ?>/register.php">Sign up</a><?php endif; ?>
</nav></header><main class="container"><?php show_flash(); ?>
