<?php
// ============================================================
// PASTE YOUR N8N WEBHOOK URL HERE
// ============================================================
$webhook_url = 'https://shahbaz1929.app.n8n.cloud/webhook-test/contact-form';

$success = false;
$error   = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']    ?? '');
    $email   = trim($_POST['email']   ?? '');
    $phone   = trim($_POST['phone']   ?? '');
    $service = trim($_POST['service'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (!$name || !$email || !$message || !$service) {
        $error = 'Please fill in all required fields.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Please enter a valid email address.';
    } elseif (!empty($_POST['_honey'])) {
        $success = true;
    } else {
        $payload = json_encode([
            'name'      => $name,
            'email'     => $email,
            'phone'     => $phone ?: 'Not provided',
            'service'   => $service,
            'message'   => $message,
            'timestamp' => date('Y-m-d H:i:s'),
        ]);

        $ch = curl_init($webhook_url);
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HTTPHEADER     => ['Content-Type: application/json'],
            CURLOPT_TIMEOUT        => 10,
        ]);
        curl_exec($ch);
        curl_close($ch);
        $success = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact — HiskyTechs</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@600;700;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
  :root {
    --accent: #00C896;
    --accent-dark: #009970;
    --bg: #09090B;
    --card: #111113;
    --border: rgba(255,255,255,0.09);
    --text: #F4F4F5;
    --muted: #A1A1AA;
    --red: #F87171;
  }
  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg);
    color: var(--text);
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 16px;
  }
  body::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image:
      linear-gradient(rgba(0,200,150,0.04) 1px, transparent 1px),
      linear-gradient(90deg, rgba(0,200,150,0.04) 1px, transparent 1px);
    background-size: 50px 50px;
    pointer-events: none;
    z-index: 0;
  }
  .wrap {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 560px;
  }
  .brand {
    text-align: center;
    margin-bottom: 32px;
  }
  .brand-logo {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
  }
  .brand-logo-icon {
    width: 38px; height: 38px;
    background: var(--accent);
    border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
  }
  .brand-logo-icon svg { width: 20px; height: 20px; }
  .brand-name {
    font-family: 'Syne', sans-serif;
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -0.5px;
  }
  .brand-name span { color: var(--accent); }
  .brand h1 {
    font-family: 'Syne', sans-serif;
    font-size: 32px;
    font-weight: 800;
    line-height: 1.2;
    letter-spacing: -1px;
    margin-bottom: 8px;
  }
  .brand p { color: var(--muted); font-size: 15px; font-weight: 300; }
  .card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 20px;
    padding: 36px 32px;
  }
  .row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
  .field { margin-bottom: 18px; }
  .field label {
    display: block;
    font-size: 13px;
    font-weight: 500;
    color: var(--muted);
    margin-bottom: 7px;
  }
  .field label span { color: var(--accent); }
  .field input,
  .field select,
  .field textarea {
    width: 100%;
    background: rgba(255,255,255,0.04);
    border: 1px solid var(--border);
    border-radius: 10px;
    color: var(--text);
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    padding: 12px 15px;
    outline: none;
    transition: border-color 0.2s, box-shadow 0.2s;
    -webkit-appearance: none;
  }
  .field select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23A1A1AA' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 14px center;
    padding-right: 36px;
    cursor: pointer;
  }
  .field select option { background: #1A1A1E; }
  .field textarea { resize: vertical; min-height: 120px; line-height: 1.6; }
  .field input:focus,
  .field select:focus,
  .field textarea:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(0,200,150,0.12);
  }
  .field input::placeholder,
  .field textarea::placeholder { color: rgba(255,255,255,0.2); }
  .hp { display: none; }
  .btn {
    width: 100%;
    padding: 14px;
    background: var(--accent);
    color: #09090B;
    font-family: 'Syne', sans-serif;
    font-size: 16px;
    font-weight: 700;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
    margin-top: 4px;
  }
  .btn:hover { background: var(--accent-dark); }
  .btn:active { transform: scale(0.99); }
  .btn:disabled { opacity: 0.6; cursor: not-allowed; }
  .alert {
    border-radius: 10px;
    padding: 14px 16px;
    font-size: 14px;
    margin-bottom: 20px;
    display: flex;
    align-items: flex-start;
    gap: 10px;
  }
  .alert-error {
    background: rgba(248,113,113,0.1);
    border: 1px solid rgba(248,113,113,0.25);
    color: var(--red);
  }
  .success-box { text-align: center; padding: 40px 20px; }
  .success-icon {
    width: 64px; height: 64px;
    background: rgba(0,200,150,0.12);
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 20px;
  }
  .success-icon svg { width: 32px; height: 32px; }
  .success-box h2 {
    font-family: 'Syne', sans-serif;
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 8px;
  }
  .success-box p { color: var(--muted); font-size: 15px; }
  .note {
    text-align: center;
    margin-top: 20px;
    font-size: 13px;
    color: var(--muted);
  }
  .note span { color: var(--accent); font-weight: 500; }
  @media (max-width: 500px) {
    .row { grid-template-columns: 1fr; }
    .card { padding: 24px 20px; }
    .brand h1 { font-size: 26px; }
  }
</style>
</head>
<body>
<div class="wrap">

  <div class="brand">
    <div class="brand-logo">
      <div class="brand-logo-icon">
        <svg viewBox="0 0 24 24" fill="none" stroke="#09090B" stroke-width="2.5" stroke-linecap="round">
          <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/>
        </svg>
      </div>
      <div class="brand-name">Hisky<span>Techs</span></div>
    </div>
    <h1>Let's Work Together</h1>
    <p>Fill the form — data goes straight to Google Sheets via n8n.</p>
  </div>

  <div class="card">

    <?php if ($success): ?>

      <div class="success-box">
        <div class="success-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="#00C896" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="20 6 9 17 4 12"/>
          </svg>
        </div>
        <h2>Message Received!</h2>
        <p>Your data has been saved to Google Sheets.<br>We'll get back to you within 24 hours.</p>
      </div>

    <?php else: ?>

      <?php if ($error): ?>
        <div class="alert alert-error">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
          </svg>
          <?= htmlspecialchars($error) ?>
        </div>
      <?php endif; ?>

      <form method="POST" action="" id="contactForm">
        <input type="text" name="_honey" class="hp" tabindex="-1" autocomplete="off">

        <div class="row">
          <div class="field">
            <label>Full Name <span>*</span></label>
            <input type="text" name="name" placeholder="Ali Khan" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
          </div>
          <div class="field">
            <label>Email Address <span>*</span></label>
            <input type="email" name="email" placeholder="ali@hiskytechs.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
          </div>
        </div>

        <div class="row">
          <div class="field">
            <label>Phone Number</label>
            <input type="text" name="phone" placeholder="+92 300 0000000" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
          </div>
          <div class="field">
            <label>Service Needed <span>*</span></label>
            <select name="service" required>
              <option value="" disabled <?= empty($_POST['service']) ? 'selected' : '' ?>>Select a service</option>
              <option value="n8n Automation">n8n Automation</option>
              <option value="AI Agent Development">AI Agent Development</option>
              <option value="WhatsApp Bot">WhatsApp Bot</option>
              <option value="CRM Integration">CRM Integration</option>
              <option value="API Integration">API Integration</option>
              <option value="Other">Other</option>
            </select>
          </div>
        </div>

        <div class="field">
          <label>Your Message <span>*</span></label>
          <textarea name="message" placeholder="Tell us about your project..." required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn" id="submitBtn">Send Message →</button>
      </form>

    <?php endif; ?>

  </div>

  <p class="note">Powered by <span>n8n</span> + Google Sheets automation</p>

</div>
<script>
  document.getElementById('contactForm')?.addEventListener('submit', function() {
    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.textContent = 'Sending...';
  });
</script>
</body>
</html>
