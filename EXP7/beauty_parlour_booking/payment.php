<?php
require 'config.php'; require 'includes/functions.php'; require_login();
if (!STRIPE_SECRET_KEY) { flash('Online card payments are not configured yet. Add your Stripe secret key in config.php. Your booking remains pending.','error'); redirect('dashboard.php'); }
$bookingId=(int)($_GET['booking']??0);
$q=$pdo->prepare("SELECT b.*,s.name FROM bookings b JOIN services s ON s.id=b.service_id WHERE b.id=? AND b.user_id=? AND b.status='pending'");$q->execute([$bookingId,current_user()['id']]);$b=$q->fetch();
if(!$b){flash('Booking not found.','error');redirect('dashboard.php');}
$amount=(int)round((float)$b['deposit_amount']*100);
$data=http_build_query(['mode'=>'payment','success_url'=>BASE_URL.'/payment_success.php?booking='.$bookingId.'&session_id={CHECKOUT_SESSION_ID}','cancel_url'=>BASE_URL.'/dashboard.php','line_items[0][price_data][currency]'=>'inr','line_items[0][price_data][unit_amount]'=>$amount,'line_items[0][price_data][product_data][name]'=>'Appointment deposit: '.$b['name'],'line_items[0][quantity]'=>1,'metadata[booking_id]'=>$bookingId]);
$ch=curl_init('https://api.stripe.com/v1/checkout/sessions');curl_setopt_array($ch,[CURLOPT_POST=>true,CURLOPT_POSTFIELDS=>$data,CURLOPT_RETURNTRANSFER=>true,CURLOPT_USERPWD=>STRIPE_SECRET_KEY.':']);$response=curl_exec($ch);$code=curl_getinfo($ch,CURLINFO_HTTP_CODE);curl_close($ch);$result=json_decode($response,true);
if($code>=200&&$code<300&&!empty($result['url'])){header('Location: '.$result['url']);exit;}
flash('Unable to start Stripe checkout. Check your Stripe settings.','error');redirect('dashboard.php');
