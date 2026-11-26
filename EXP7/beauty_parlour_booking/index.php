<?php
require 'config.php'; require 'includes/functions.php';
$pageTitle='Welcome | '.APP_NAME;
$services=$pdo->query("SELECT * FROM services WHERE active=1 ORDER BY id DESC LIMIT 3")->fetchAll();
require 'includes/header.php';
?>
<section class="hero"><div class="hero-copy"><span class="eyebrow">YOUR MOMENT. YOUR GLOW.</span><h1>Beauty appointments,<br><em>beautifully simple.</em></h1><p>Discover your favourite treatments, choose a stylist and reserve a time that works for you.</p><a class="button" href="services.php">Explore services</a></div><div class="hero-art"><div class="hero-circle">✿</div><div class="hero-note">Feel good<br><strong>look radiant</strong></div></div></section>
<section class="section-head"><div><span class="eyebrow">OUR SERVICES</span><h2>A little care goes a long way</h2></div><a href="services.php" class="text-link">View all services →</a></section>
<div class="service-grid"><?php foreach($services as $s): ?><article class="service-card"><div class="service-icon">✧</div><h3><?=e($s['name'])?></h3><p><?=e($s['description'])?></p><div class="card-bottom"><strong><?=money((float)$s['price'])?></strong><span><?= (int)$s['duration_minutes'] ?> min</span></div><a class="text-link" href="book.php?service=<?=(int)$s['id']?>">Book this service →</a></article><?php endforeach; ?></div>
<section class="banner"><div><span class="eyebrow">READY FOR SOME YOU-TIME?</span><h2>Your next appointment is just a few clicks away.</h2></div><a class="button light" href="register.php">Create an account</a></section>
<?php require 'includes/footer.php'; ?>