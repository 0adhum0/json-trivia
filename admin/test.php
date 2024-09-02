<?php
$file = '../data/questions.json';
$data = ['test' => 'This is a test'];

if (file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT)) !== false) {
    echo 'File written successfully';
} else {
    echo 'Failed to write to file';
}
?>
