<?php
header('Content-Type: application/json; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed.',
    ]);
    exit;
}

$rawInput = file_get_contents('php://input');
$payload = json_decode($rawInput, true);

if (!is_array($payload)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request payload.',
    ]);
    exit;
}

function value_or_empty($value) {
    return is_string($value) ? trim($value) : '';
}

$name = value_or_empty($payload['name'] ?? '');
$restaurantName = value_or_empty($payload['restaurantName'] ?? '');
$email = filter_var(value_or_empty($payload['email'] ?? ''), FILTER_VALIDATE_EMAIL);
$phone = value_or_empty($payload['phone'] ?? '');
$website = value_or_empty($payload['website'] ?? '');
$socialChannel = value_or_empty($payload['socialChannel'] ?? '');
$socialHandle = value_or_empty($payload['socialHandle'] ?? '');

if ($name === '' || $restaurantName === '' || !$email || $phone === '') {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Please fill in all required fields.',
    ]);
    exit;
}

$to = 'alihamxatech@gmail.com';
$subject = 'New Xorvian Demo Request - ' . $restaurantName;
$fromAddress = 'xorvian@hiskytechs.com';

$messageLines = [
    'New Xorvian Voice AI demo request received.',
    '',
    'Full Name: ' . $name,
    'Restaurant / Business: ' . $restaurantName,
    'Email: ' . $email,
    'Phone: ' . $phone,
    'Website: ' . ($website !== '' ? $website : 'Not provided'),
    'Social Channel: ' . ($socialChannel !== '' ? $socialChannel : 'Not provided'),
    'Social Handle / URL: ' . ($socialHandle !== '' ? $socialHandle : 'Not provided'),
    '',
    'Submitted from xorvian.hiskytechs.com',
];

$headers = [
    'MIME-Version: 1.0',
    'Content-Type: text/plain; charset=UTF-8',
    'From: Xorvian Website <' . $fromAddress . '>',
    'Reply-To: ' . $email,
    'X-Mailer: PHP/' . phpversion(),
];

$sent = mail($to, $subject, implode("\r\n", $messageLines), implode("\r\n", $headers));

if (!$sent) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'The request was captured, but email sending failed on the server. Please check Hostinger mail settings.',
    ]);
    exit;
}

echo json_encode([
    'success' => true,
    'message' => 'Demo request sent successfully.',
]);
