<?php
function e(?string $v):string{return htmlspecialchars($v??'',ENT_QUOTES,'UTF-8');}
function go(string $p):never{header('Location: '.APP_URL.'/'.ltrim($p,'/'));exit;}
function current_user():?array{return $_SESSION['user']??null;}
function require_login():void{if(!current_user())go('login.php');}
function require_admin():void{require_login();if(current_user()['role']!=='admin'){http_response_code(403);exit('Administrator access required.');}}
function flash(string $m,string $type='success'):void{$_SESSION['flash']=[$m,$type];}
function show_flash():void{if(isset($_SESSION['flash'])){[$m,$t]=$_SESSION['flash'];unset($_SESSION['flash']);echo '<div class="notice '.e($t).'">'.e($m).'</div>';}}
function csrf_field():string{$_SESSION['csrf']??=bin2hex(random_bytes(32));return '<input type="hidden" name="csrf" value="'.e($_SESSION['csrf']).'">';}
function verify_csrf():void{if($_SERVER['REQUEST_METHOD']==='POST'&&!hash_equals($_SESSION['csrf']??'',$_POST['csrf']??'')){http_response_code(419);exit('Invalid form token. Refresh and try again.');}}
function cart_count():int{return array_sum($_SESSION['cart']??[]);}
function money($v):string{return '₹'.number_format((float)$v,2);}
