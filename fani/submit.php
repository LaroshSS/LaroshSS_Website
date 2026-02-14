<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// File to store responses
$file = 'responses.json';

// Get the posted data
$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (!$data) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid data']);
    exit;
}

// Add timestamp
$data['timestamp'] = date('Y-m-d H:i:s');
$data['ip'] = $_SERVER['REMOTE_ADDR'];

// Read existing responses
$responses = [];
if (file_exists($file)) {
    $content = file_get_contents($file);
    $responses = json_decode($content, true) ?: [];
}

// Add new response
$responses[] = $data;

// Save to file
if (file_put_contents($file, json_encode($responses, JSON_PRETTY_PRINT))) {
    http_response_code(200);
    echo json_encode(['success' => true, 'message' => 'Response saved']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to save response']);
}
?>
