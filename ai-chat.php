<?php
session_start();

if (!isset($_SESSION['uid'])) {
    echo json_encode(['error' => 'Not authenticated']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputJSON = file_get_contents('php://input');
    $input = json_decode($inputJSON, TRUE);
    $message = isset($input['message']) ? trim($input['message']) : (isset($_POST['message']) ? trim($_POST['message']) : '');

    if (empty($message)) {
        echo json_encode(['error' => 'Message is empty']);
        exit;
    }

    // Role-based context (if session role exists)
    $role = isset($_SESSION['role']) ? $_SESSION['role'] : 'User';
    $current_date = date('F j, Y');

    // Refined "Short & Sweet" Interactive persona
    $system_prompt = "You are the 'Campus Smart Assistant' (v3.6 Elite).
    Role Context: $role. Date: $current_date.
    
    PERSONALITY RULES:
    1. BE SHORT & SWEET: Keep text answers to 1-2 thin paragraphs max. No fluff.
    2. BE INTERACTIVE: Always end your response with a short, sweet follow-up question related to the topic.
    3. USE EMOJIS: Use 1-2 relevant emojis per message to keep it friendly.
    4. DATA: Use TABLES only if specifically asked for lots of data, otherwise use lists.
    5. STYLE: Modern, approachable, and fast.
    
    If you don't know something about the campus, say 'Good question! I'm not sure yet, but you can check with the Admin office. Anything else?'";
    
    // Using Pollinations Text API (No Key Required)
    $url = "https://text.pollinations.ai/prompt/" . urlencode($message) . "?system=" . urlencode($system_prompt) . "&model=openai";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200 && !empty($response)) {
        // Clean potential reasoning tags if the model used is DeepSeek/similar
        $clean_response = preg_replace('/<think>.*?<\/think>/s', '', $response);
        echo json_encode(['reply' => trim($clean_response)]);
    } else {
        echo json_encode(['error' => 'Smart Assistant API error.']);
    }
} else {
    echo json_encode(['error' => 'Invalid request method']);
}
?>
