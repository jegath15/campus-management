<?php
header("Content-Type: application/json");

$topic = $_POST['topic'] ?? '';
if(!$topic) {
    echo json_encode(["error" => "No topic provided"]);
    exit;
}

$system_prompt = "You are an educational tool built into a campus system. Generate a 5-question multiple-choice quiz with answers for the provided topic. Output entirely as HTML without using markdown blocks or backticks. Format rules: Use <h4> for question text, <ol type='A'> for options, and put the answer key at the very end wrapped in a <div class='alert alert-info mt-4'>. Do NOT introduce yourself or mention you are an AI.";
$user_prompt = "Generate a quiz for this topic: " . $topic;

$url = "https://text.pollinations.ai/prompt/" . urlencode($user_prompt) . "?system=" . urlencode($system_prompt);

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_TIMEOUT => 45
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200 || $response === false) {
    echo json_encode(["error" => "Service unavailable or connection failed."]);
    exit;
}

// Strip markdown block and reasoning tags
$output = trim($response);
$output = preg_replace('/^```x?h?t?m?l?\s+|^```\s+/', '', $output);
$output = preg_replace('/\s+```$/', '', $output);
$output = preg_replace('/<think>.*?<\/think>/s', '', $output);

echo json_encode([
    "quiz" => trim($output)
]);
?>
