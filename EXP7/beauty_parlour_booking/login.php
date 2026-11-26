<?php
require 'config.php'; require 'includes/functions.php'; verify_csrf();
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $q=$pdo->prepare("SELECT * FROM users WHERE email=? AND active=1"); $q->execute([strtolower(trim($_POST['email']??''))]); $u=$q->fetch();
    if ($u && password_verify($_POST['password']??'', $u['password_hash'])) { session_regenerate_id(true); $_SESSION['user']=['id'=>$u['id'],'name'=>$u['name'],'email'=>$u['email'],'role'=>$u['role']]; redirect('dashboard.php'); }
    flash('Email or password is incorrect.','error');
}
$pageTitle='Login'; require 'includes/header.php';
?>
<div class="form-wrap"><div class="form-card"><span class="eyebrow">GOOD TO SEE YOU</span><h1>Log in</h1><p>Continue to your personal beauty dashboard.</p><form method="post"><?=csrf_field()?><label>Email address<input type="email" name="email" required></label><label>Password<input type="password" name="password" required></label><button class="button full">Log in</button></form><p class="muted">New here? <a href="register.php">Create an account</a></p></div></div>
<?php require 'includes/footer.php'; ?>