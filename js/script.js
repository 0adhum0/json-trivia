document.addEventListener("DOMContentLoaded", () => {
	const quizContainer = document.getElementById("quiz-container");
	const questionElement = document.getElementById("question");
	const optionsElement = document.getElementById("options");
	const resultElement = document.getElementById("result");
	const submitButton = document.getElementById("submit-answer");

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
					fetchQuestion(); // Fetch a new question
				} else {
					resultElement.textContent = "Error validating answer";
				}
			});
	}

	submitButton.addEventListener("click", submitAnswer);

	fetchQuestion(); // Load the first question on page load
});
