<?php
require 'config.php';
$accounts=[
 ['Salon Administrator','admin@glowandgo.test','admin12345','admin','Management'],
 ['Aarav Stylist','stylist@glowandgo.test','stylist12345','stylist','Hair styling'],
 ['Mira Stylist','mira@glowandgo.test','mira12345','stylist','Skin and beauty']
];
foreach($accounts as $a){
 $q=$pdo->prepare("INSERT IGNORE INTO users(name,email,password_hash,role,speciality) VALUES(?,?,?,?,?)");
 $q->execute([$a[0],$a[1],password_hash($a[2],PASSWORD_DEFAULT),$a[3],$a[4]]);
}
echo 'Setup complete. Delete setup.php now. Admin: admin@glowandgo.test / admin12345';
