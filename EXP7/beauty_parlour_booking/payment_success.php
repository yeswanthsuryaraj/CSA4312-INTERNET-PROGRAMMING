<?php
require 'config.php'; require 'includes/functions.php'; require_login();
$booking=(int)($_GET['booking']??0);$sessionId=$_GET['session_id']??'';
if(!STRIPE_SECRET_KEY||!preg_match('/^cs_[A-Za-z0-9_]+$/',$sessionId)){flash('Payment could not be verified.','error');redirect('dashboard.php');}
$ch=curl_init('https://api.stripe.com/v1/checkout/sessions/'.rawurlencode($sessionId));curl_setopt_array($ch,[CURLOPT_RETURNTRANSFER=>true,CURLOPT_USERPWD=>STRIPE_SECRET_KEY.':']);$response=curl_exec($ch);$code=curl_getinfo($ch,CURLINFO_HTTP_CODE);curl_close($ch);$result=json_decode($response,true);
if($code===200&&($result['payment_status']??'')==='paid'&&(int)($result['metadata']['booking_id']??0)===$booking){
    $q=$pdo->prepare("UPDATE bookings SET payment_status='deposit_paid',payment_reference=? WHERE id=? AND user_id=?");$q->execute([$sessionId,$booking,current_user()['id']]);flash('Deposit payment received. The salon will confirm your appointment.');
}else flash('Payment is not marked as paid. Please contact the salon if you were charged.','error');
redirect('dashboard.php');
