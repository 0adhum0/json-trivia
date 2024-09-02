<?php
header('Content-Type: application/json');
$jsonFilePath = '../data/questions.json';

if (!file_exists($jsonFilePath)) {
    echo json_encode(['status' => 'error', 'message' => 'File not found']);
    exit;
}

$jsonData = file_get_contents($jsonFilePath);
$questions = json_decode($jsonData, true);

$newQuestion = [
    'question' => $_POST['question'],
    'options' => explode(',', $_POST['options']),
    'answer' => intval($_POST['answer']),
    'region' => $_POST['region']
];

$questions[] = $newQuestion;

if (file_put_contents($jsonFilePath, json_encode($questions, JSON_PRETTY_PRINT)) === false) {
    $error = error_get_last();
    echo json_encode(['status' => 'error', 'message' => 'Failed to write to file: ' . $error['message']]);
} else {
    echo json_encode(['status' => 'success', 'message' => 'Question added successfully']);
}
?>
