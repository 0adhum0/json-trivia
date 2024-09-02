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

// Get the question ID and user answer from the request
$questionId = intval($_POST['id']);
$userAnswer = intval($_POST['answer']);

if (!isset($questions[$questionId])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid question ID']);
    exit;
}

$correctAnswer = $questions[$questionId]['answer'];
$isCorrect = ($userAnswer === $correctAnswer);

$response = [
    'status' => 'success',
    'isCorrect' => $isCorrect,
    'correctAnswer' => $questions[$questionId]['options'][$correctAnswer]
];

if (!$isCorrect) {
    $response['message'] = 'Incorrect. The correct answer is: ' . $response['correctAnswer'];
}

echo json_encode($response);
?>
