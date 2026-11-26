<?php
function e(?string $s):string{return htmlspecialchars($s??'',ENT_QUOTES,'UTF-8');}
function go(string $p):never{header('Location: '.APP_URL.'/'.ltrim($p,'/'));exit;}
function user():?array{return $_SESSION['user']??null;}
function need_login():void{if(!user())go('login.php');}
function need_role(array $roles):void{need_login();if(!in_array(user()['role'],$roles,true)){http_response_code(403);exit('Access denied.');}}
function flash(string $m,string $t='success'):void{$_SESSION['flash']=[$m,$t];}
function flashes():void{if(isset($_SESSION['flash'])){[$m,$t]=$_SESSION['flash'];unset($_SESSION['flash']);echo '<div class="alert '.e($t).'">'.e($m).'</div>';}}
function csrf():string{$_SESSION['csrf']??=bin2hex(random_bytes(32));return '<input type="hidden" name="csrf" value="'.e($_SESSION['csrf']).'">';}
function verify():void{if($_SERVER['REQUEST_METHOD']==='POST'&&!hash_equals($_SESSION['csrf']??'',$_POST['csrf']??'')){http_response_code(419);exit('Invalid form token.');}}
function rupee($n):string{return '₹'.number_format((float)$n,2);}
function available(PDO $db,int $doctor,string $date,string $time,int $exclude=0):bool{
 $q=$db->prepare("SELECT id FROM appointments WHERE doctor_id=? AND appointment_date=? AND appointment_time=? AND status IN ('pending','confirmed') AND id<>?");
 $q->execute([$doctor,$date,$time,$exclude]);return !$q->fetch();
}
