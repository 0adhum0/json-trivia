<?php
header('Content-Type: application/json');

// Path to the questions file
$jsonFilePath = '../data/questions.json';

// Read questions from the file
$jsonData = file_get_contents($jsonFilePath);
$questions = json_decode($jsonData, true);

if ($questions === null || empty($questions)) {
    echo json_encode(['status' => 'error', 'message' => 'No questions available']);
    exit;
}

// Get a random question
$randomIndex = array_rand($questions);
$question = $questions[$randomIndex];

// Return the question as JSON
echo json_encode([
    'status' => 'success',
    'question' => $question['question'],
    'options' => $question['options'],
    'id' => $randomIndex  // Include an ID to identify the question for validation
]);
?>
