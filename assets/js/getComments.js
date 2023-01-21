const idNews = document.getElementById("ID_News").innerText;
const commentsSection = document.getElementById("comments");

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
