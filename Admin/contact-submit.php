<?php
session_start();
require_once "../Admin/config/db.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

// RATE LIMIT (30 sec)
if (!empty($_SESSION['last_submit']) && time() - $_SESSION['last_submit'] < 30) {
    http_response_code(429);
    exit('Too many requests. Please wait 30 seconds.');
}
$_SESSION['last_submit'] = time();

// Clean inputs
function clean($value) {
    $value = trim($value ?? '');
    $value = preg_replace('/\s+/', ' ', $value);
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// Inputs
$name    = clean($_POST['name'] ?? '');
$email   = clean($_POST['email'] ?? '');
$company = clean($_POST['company_name'] ?? '');
$url     = filter_var($_POST['company_url'] ?? '', FILTER_SANITIZE_URL);
$phone   = preg_replace('/[^0-9]/', '', $_POST['phone'] ?? '');
$details = clean($_POST['project_details'] ?? '');
$servicesArr = $_POST['services'] ?? [];
$services = implode(', ', array_map('clean', $servicesArr));
$region = clean($_POST['region'] ?? '');
$job    = clean($_POST['looking_job'] ?? '');

// ---------------------------
// VALIDATION
// ---------------------------

// Name: letters + space only, 3–50 chars
if (!preg_match('/^[A-Za-z ]{3,20}$/', $name)) {
    http_response_code(422);
    exit('Invalid name. Only letters and spaces allowed (3–20 chars).');
}

// Email: valid format
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strpos($email, ' ') !== false) {
    http_response_code(422);
    exit('Invalid email address.');
}

// Optional: allow only certain domains (uncomment if needed)
// if (!preg_match('/@gmail\.com$/', $email)) {
//     http_response_code(422);
//     exit('Email must be a Gmail address.');
// }

// Phone: digits only, 7–15 digits
if (!preg_match('/^[0-9]{7,15}$/', $phone)) {
    http_response_code(422);
    exit('Invalid phone number. Must be 7–15 digits.');
}

// Company URL: optional but must be valid if provided
if ($url && !filter_var($url, FILTER_VALIDATE_URL)) {
    http_response_code(422);
    exit('Invalid company URL.');
}

// Project details: 1–50 words
$wordCount = str_word_count($details);
if ($wordCount < 1 || $wordCount > 20) {
    http_response_code(422);
    exit('Project details must be 1 to 20 words.');
}

// Services: at least one selected
if (empty($servicesArr)) {
    http_response_code(422);
    exit('Please select at least one service.');
}

// Required fields check
if (!$name || !$email || !$phone) {
    http_response_code(422);
    exit('Please fill all required fields.');
}

// ---------------------------
// INSERT INTO DATABASE
// ---------------------------
$stmt = $conn->prepare("
    INSERT INTO contact_messages
    (name,email,company_name,company_url,phone,region,services,project_details,looking_job)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
");
$stmt->bind_param(
    "sssssssss",
    $name,
    $email,
    $company,
    $url,
    $phone,
    $region,
    $services,
    $details,
    $job
);

if ($stmt->execute()) {
    echo 'Thank you! Your message has been sent.';
} else {
    http_response_code(500);
    echo 'Something went wrong. Please try again later.';
}

$stmt->close();
$conn->close();
