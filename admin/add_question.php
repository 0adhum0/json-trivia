<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Question</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        #admin-container {
            width: 80%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="admin-container">
        <h2>Add a New Question</h2>
        <form action="add_question.php" method="post">
            <label for="question">Question:</label>
            <input type="text" id="question" name="question" required>

            <label for="options">Options (comma separated):</label>
            <input type="text" id="options" name="options" required>

            <label for="answer">Index of Correct Answer:</label>
            <input type="text" id="answer" name="answer" required>

            <label for="region">Region:</label>
            <input type="text" id="region" name="region" required>

            <button type="submit">Add Question</button>
        </form>
    </div>
</body>
</html>
