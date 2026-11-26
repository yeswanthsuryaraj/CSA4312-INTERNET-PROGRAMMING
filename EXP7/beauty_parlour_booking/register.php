<?php
require 'config.php'; require 'includes/functions.php'; verify_csrf();
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $name=trim($_POST['name']??''); $email=strtolower(trim($_POST['email']??'')); $phone=trim($_POST['phone']??''); $pass=$_POST['password']??'';
    if ($name==='' || !filter_var($email,FILTER_VALIDATE_EMAIL) || strlen($pass)<8) flash('Enter a name, valid email and password with at least 8 characters.','error');
    else {
        try { $q=$pdo->prepare("INSERT INTO users(name,email,phone,password_hash,role) VALUES(?,?,?,?, 'customer')"); $q->execute([$name,$email,$phone,password_hash($pass,PASSWORD_DEFAULT)]); flash('Account created. Please log in.'); redirect('login.php'); }
        catch(PDOException $e){ flash('That email address is already registered.','error'); }
    }
}
$pageTitle='Create account'; require 'includes/header.php';
?>
<div class="form-wrap"><div class="form-card"><span class="eyebrow">WELCOME TO GLOW & GO</span><h1>Create your account</h1><p>Save your details and manage all your appointments in one place.</p><form method="post"><?=csrf_field()?><label>Full name<input name="name" required maxlength="100" value="<?=e($_POST['name']??'')?>"></label><label>Email address<input type="email" name="email" required value="<?=e($_POST['email']??'')?>"></label><label>Phone number<input name="phone" maxlength="30" value="<?=e($_POST['phone']??'')?>"></label><label>Password<input type="password" name="password" required minlength="8"></label><button class="button full">Create account</button></form><p class="muted">Already registered? <a href="login.php">Log in</a></p></div></div>
<?php require 'includes/footer.php'; ?>