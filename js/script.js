document.addEventListener("DOMContentLoaded", () => {
	const quizContainer = document.getElementById("quiz-container");
	const questionElement = document.getElementById("question");
	const optionsElement = document.getElementById("options");
	const resultElement = document.getElementById("result");
	const submitButton = document.getElementById("submit-answer");
	const nextButton = document.getElementById("next-question");

	let currentQuestionId;

	function fetchQuestion() {
		fetch("admin/quiz.php")
			.then((response) => response.json())
			.then((data) => {
				if (data.status === "success") {
					currentQuestionId = data.id;
					questionElement.textContent = data.question;
					optionsElement.innerHTML = data.options
						.map(
							(option, index) =>
								`<label><input type="radio" name="answer" value="${index}"> ${option}</label><br>`
						)
						.join("");
					resultElement.textContent = ""; // Clear result
					nextButton.style.display = "none"; // Hide "Next Question" button
				} else {
					questionElement.textContent = "Error loading question";
				}
			});
	}

	function submitAnswer() {
		const selectedOption = document.querySelector(
			'input[name="answer"]:checked'
		);

		if (!selectedOption) {
			resultElement.textContent = "Please select an answer.";
			return;
		}

		const userAnswer = parseInt(selectedOption.value);

		fetch("admin/validate_answer.php", {
			method: "POST",
			headers: { "Content-Type": "application/x-www-form-urlencoded" },
			body: new URLSearchParams({
				id: currentQuestionId,
				answer: userAnswer,
			}),
		})
			.then((response) => response.json())
			.then((data) => {
				if (data.status === "success") {
					if (data.isCorrect) {
						resultElement.textContent = "Correct!";
					} else {
						resultElement.textContent = data.message;
					}
					submitButton.style.display = "none"; // Hide "Submit Answer" button
					nextButton.style.display = "inline"; // Show "Next Question" button
				} else {
					resultElement.textContent = "Error validating answer";
				}
			});
	}

	function loadNextQuestion() {
		submitButton.style.display = "inline"; // Show "Submit Answer" button
		fetchQuestion();
	}

	submitButton.addEventListener("click", submitAnswer);
	nextButton.addEventListener("click", loadNextQuestion);

	fetchQuestion(); // Load the first question on page load
});
