const button = document.getElementById("AddComment");
const content = document.getElementById("contentComment");

button.addEventListener("click", () => {
	const idNews = document.getElementById("ID_News").innerText;
	let data = { news: idNews, content: content.value };
	async function add() {
		const response = await fetch("/comments-create", {
			method: "POST",
			headers: {
				"Content-type": "application/json; charset=UTF-8",
			},
			body: JSON.stringify(data),
		});
		if (response.status === 200) {
			content.value = "";
			refreshComments();
		}
	}
	add();
});

function refreshComments() {
	const idNews = document.getElementById("ID_News").innerText;
	const commentsSection = document.getElementById("comments");
	const myForm = document.getElementById("myForm");
	commentsSection.innerHTML = "";
	commentsSection.appendChild(myForm);

	let comments;
	fetch("/comments-news/" + idNews)
		.then((res) => res.json())
		.then((res) => {
			res.forEach((element) => {
				// console.log(element);
				let commentElement = document.createElement("div");
				commentElement.classList.add("comments__single");
				// -----------------------------
				let paragraph = document.createElement("p");
				paragraph.classList.add("comments__content");
				let content = document.createTextNode(element.content);
				paragraph.appendChild(content);
				commentElement.appendChild(paragraph);
				// -----------------------------
				let author = document.createElement("p");
				author.classList.add("comments__author");
				content = document.createTextNode(element.author);
				author.appendChild(content);
				commentElement.appendChild(author);
				// -----------------------------
				let date = document.createElement("p");
				date.classList.add("comments__date");
				content = document.createTextNode(element.date_created);
				date.appendChild(content);
				commentElement.appendChild(date);
				// -----------------------------
				commentsSection.appendChild(commentElement);
			});
		});
}
