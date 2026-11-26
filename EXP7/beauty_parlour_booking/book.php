<?php
require 'config.php'; require 'includes/functions.php'; require_login(); verify_csrf();
$services=$pdo->query("SELECT * FROM services WHERE active=1 ORDER BY name")->fetchAll();
$stylists=$pdo->query("SELECT id,name,speciality FROM users WHERE role IN ('stylist','staff','admin') AND active=1 ORDER BY name")->fetchAll();
$selected=(int)($_GET['service']??$_POST['service_id']??0);
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $sid=(int)$_POST['service_id']; $tid=(int)$_POST['stylist_id']; $date=$_POST['date']??''; $time=$_POST['time']??'';
    $s=$pdo->prepare("SELECT * FROM services WHERE id=? AND active=1"); $s->execute([$sid]); $service=$s->fetch();
    $t=$pdo->prepare("SELECT id FROM users WHERE id=? AND role IN ('stylist','staff','admin') AND active=1"); $t->execute([$tid]);
    if (!$service || !$t->fetch() || strtotime($date)<strtotime(date('Y-m-d')) || !preg_match('/^(09|1[0-8]):(00|30)$/',$time) || !slot_is_available($pdo,$tid,$date,$time,(int)$service['duration_minutes'])) flash('Please check your selection. That time may be unavailable.','error');
    else {
        $deposit=round((float)$service['price']*0.20,2);
        $q=$pdo->prepare("INSERT INTO bookings(user_id,service_id,stylist_id,appointment_date,appointment_time,duration_minutes,total_amount,deposit_amount,status,payment_status) VALUES(?,?,?,?,?,?,?,?, 'pending','unpaid')");
        $q->execute([current_user()['id'],$sid,$tid,$date,$time,$service['duration_minutes'],$service['price'],$deposit]); $bid=(int)$pdo->lastInsertId();
        flash('Appointment request created. Pay the deposit or contact the salon to confirm.'); redirect('dashboard.php');
    }
}
$pageTitle='Book an appointment'; require 'includes/header.php';
?>
<div class="form-wrap"><div class="form-card wide"><span class="eyebrow">MAKE TIME FOR YOU</span><h1>Book an appointment</h1><p>Select a treatment, stylist and a time. Available hours are 09:00–18:30 in 30-minute intervals.</p>
<form method="post"><?=csrf_field()?><label>Service<select name="service_id" required><option value="">Choose a service</option><?php foreach($services as $s):?><option value="<?=$s['id']?>" <?=$selected===$s['id']?'selected':''?>><?=e($s['name'])?> — <?=money((float)$s['price'])?> (<?=$s['duration_minutes']?> min)</option><?php endforeach;?></select></label>
<label>Stylist<select name="stylist_id" required><option value="">Choose a stylist</option><?php foreach($stylists as $t):?><option value="<?=$t['id']?>"><?=e($t['name'])?><?=!empty($t['speciality'])?' — '.e($t['speciality']):''?></option><?php endforeach;?></select></label>
<div class="two-col"><label>Date<input type="date" name="date" min="<?=date('Y-m-d')?>" required></label><label>Start time<select name="time" required><option value="">Choose time</option><?php for($h=9;$h<=18;$h++)foreach([0,30] as $m){if($h===18&&$m===30){} $v=sprintf('%02d:%02d',$h,$m);?><option value="<?=$v?>"><?=$v?></option><?php }?></select></label></div>
<div class="notice">A 20% deposit is requested to secure your booking. The salon can confirm your appointment after payment or direct confirmation.</div><button class="button full">Request appointment</button></form></div></div>
<?php require 'includes/footer.php'; ?>