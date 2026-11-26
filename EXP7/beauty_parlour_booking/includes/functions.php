<?php
function e(?string $value): string { return htmlspecialchars($value ?? '', ENT_QUOTES, 'UTF-8'); }
function redirect(string $path): never { header('Location: ' . BASE_URL . '/' . ltrim($path, '/')); exit; }
function current_user(): ?array { return $_SESSION['user'] ?? null; }
function require_login(): void { if (!current_user()) redirect('login.php'); }
function require_admin(): void {
    require_login();
    if (!in_array(current_user()['role'], ['admin','staff'], true)) { http_response_code(403); exit('Access denied.'); }
}
function flash(string $message, string $type='success'): void { $_SESSION['flash'] = [$message, $type]; }
function show_flash(): void {
    if (!empty($_SESSION['flash'])) {
        [$message,$type] = $_SESSION['flash']; unset($_SESSION['flash']);
        echo '<div class="alert '.e($type).'">'.e($message).'</div>';
    }
}
function csrf_field(): string {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));
    return '<input type="hidden" name="csrf" value="'.e($_SESSION['csrf']).'">';
}
function verify_csrf(): void {
    if ($_SERVER['REQUEST_METHOD']==='POST' && !hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(419); exit('Invalid request token. Please go back and try again.');
    }
}
function money(float $amount): string { return '₹'.number_format($amount, 2); }
function slot_is_available(PDO $pdo, int $stylistId, string $date, string $time, int $duration, int $exclude=0): bool {
    $start = strtotime("$date $time");
    $end = $start + $duration * 60;
    $stmt = $pdo->prepare("SELECT appointment_date, appointment_time, duration_minutes FROM bookings WHERE stylist_id=? AND appointment_date=? AND status IN ('pending','confirmed') AND id<>?");
    $stmt->execute([$stylistId, $date, $exclude]);
    foreach ($stmt->fetchAll() as $row) {
        $otherStart = strtotime($row['appointment_date'].' '.$row['appointment_time']);
        $otherEnd = $otherStart + (int)$row['duration_minutes']*60;
        if ($start < $otherEnd && $end > $otherStart) return false;
    }
    return true;
}
