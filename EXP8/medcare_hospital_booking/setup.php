<?php require 'config.php';
$admin=['MedCare Administrator','admin@medcare.test','admin12345','admin'];
$q=$pdo->prepare("INSERT IGNORE INTO users(name,email,password_hash,role) VALUES(?,?,?,'admin')");$q->execute([$admin[0],$admin[1],password_hash($admin[2],PASSWORD_DEFAULT)]);
$h=$pdo->prepare("SELECT id FROM hospitals WHERE name='MedCare City Hospital' LIMIT 1");$h->execute();$hid=$h->fetchColumn();
if(!$hid){$q=$pdo->prepare("INSERT INTO hospitals(name,address,city,latitude,longitude) VALUES(?,?,?,?,?)");$q->execute(['MedCare City Hospital','Anna Salai','Chennai',13.0604,80.2496]);$hid=(int)$pdo->lastInsertId();}
$sample=[['Dr. Ananya Rao','ananya@medcare.test','Cardiology',700],['Dr. Karthik Iyer','karthik@medcare.test','Dermatology',500],['Dr. Meera Nair','meera@medcare.test','Pediatrics',600]];
foreach($sample as $s){$q=$pdo->prepare("INSERT IGNORE INTO users(name,email,password_hash,role) VALUES(?,?,?,'doctor')");$q->execute([$s[0],$s[1],password_hash('doctor12345',PASSWORD_DEFAULT)]);$q=$pdo->prepare("SELECT id FROM users WHERE email=?");$q->execute([$s[1]]);$uid=$q->fetchColumn();$q=$pdo->prepare("INSERT IGNORE INTO doctors(user_id,hospital_id,specialty,consultation_fee) VALUES(?,?,?,?)");$q->execute([$uid,$hid,$s[2],$s[3]]);}
echo 'Demo data created. Admin: admin@medcare.test / admin12345. Delete setup.php now.';
