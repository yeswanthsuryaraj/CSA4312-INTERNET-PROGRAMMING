<?php
require 'config.php';require 'includes/functions.php';verify();
if($_SERVER['REQUEST_METHOD']==='POST'){
 $name=trim($_POST['name']??'');$email=strtolower(trim($_POST['email']??''));$phone=trim($_POST['phone']??'');$pw=$_POST['password']??'';
 if(!$name||!filter_var($email,FILTER_VALIDATE_EMAIL)||strlen($pw)<8)flash('Enter a valid name/email and password of at least 8 characters.','error');
 else{try{$q=$pdo->prepare("INSERT INTO users(name,email,phone,password_hash,role) VALUES(?,?,?,?,'patient')");$q->execute([$name,$email,$phone,password_hash($pw,PASSWORD_DEFAULT)]);flash('Registration successful. Please log in.');go('login.php');}catch(PDOException $e){flash('Email is already registered.','error');}}
}
$title='Patient registration';require 'includes/header.php';?>
<div class="formbox"><span class="tag">PATIENT PORTAL</span><h1>Create patient account</h1><form method="post"><?=csrf()?><label>Full name<input name="name" required></label><label>Email<input name="email" type="email" required></label><label>Phone<input name="phone"></label><label>Password<input name="password" type="password" minlength="8" required></label><button class="btn full">Register</button></form><p>Already registered? <a href="login.php">Login</a></p></div><?php require 'includes/footer.php';?>