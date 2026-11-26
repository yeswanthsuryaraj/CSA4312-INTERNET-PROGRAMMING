<?php
require 'config.php'; require 'includes/functions.php';
$pageTitle='Our services'; $services=$pdo->query("SELECT * FROM services WHERE active=1 ORDER BY name")->fetchAll();
require 'includes/header.php'; ?>
<div class="page-intro"><span class="eyebrow">THE GLOW MENU</span><h1>Find your feel-good treatment.</h1><p>Thoughtful treatments, talented stylists and time set aside just for you.</p></div>
<div class="service-grid"><?php foreach($services as $s): ?><article class="service-card"><div class="service-icon">✧</div><h3><?=e($s['name'])?></h3><p><?=e($s['description'])?></p><div class="card-bottom"><strong><?=money((float)$s['price'])?></strong><span><?= (int)$s['duration_minutes'] ?> min</span></div><a class="button small" href="book.php?service=<?=(int)$s['id']?>">Book appointment</a></article><?php endforeach; ?></div>
<?php require 'includes/footer.php'; ?>