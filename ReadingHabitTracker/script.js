document.addEventListener("DOMContentLoaded", function () {

    const addBookForm = document.getElementById("addBookForm");
    const bookList = document.getElementById("bookList");
    const searchInput = document.getElementById("searchInput");
    const categoryFilter = document.getElementById("categoryFilter");
    const statusFilter = document.getElementById("statusFilter");
    const sortFilter = document.getElementById("sortFilter");
    const discoverBookList = document.getElementById("discoverBookList");
    const categoryButtons = document.querySelectorAll(".category-buttons button");
    const contactForm = document.getElementById("contactForm");

    let appBooks = JSON.parse(localStorage.getItem("books")) || [];

    // Read fixed books from discover page
    const fixedBooks = [];
    if (discoverBookList) {
        discoverBookList.querySelectorAll(".book-card").forEach(card => {
            fixedBooks.push({
                title: card.querySelector("p").innerText,
                author: card.querySelector("small").innerText,
                category: card.dataset.category,
                status: "Fixed",
                image: card.querySelector("img").src
            });
        });
    }

    function getAllBooks() {
        return [...fixedBooks, ...appBooks];
    }

    function saveBooks() {
        localStorage.setItem("books", JSON.stringify(appBooks));
    }

    // Display books on App page
    function displayAppBooks(bookArray) {
        if (!bookList) return;
        bookList.innerHTML = "";
        bookArray.forEach((book, index) => {
            let html = `
            <div class="col-md-4 mt-3">
                <div class="card">
                    <img src="${book.image || 'images/book.jpg'}" class="card-img-top" alt="Book Image" style="height:200px;object-fit:cover;">
                    <div class="card-body">
                        <h6>${book.title}</h6>
                        <p>${book.author}</p>
                        <p><small>${book.category} | ${book.status}</small></p>
                        <button class="btn btn-outline-dark btn-sm edit-btn" data-index="${index}">Edit</button>
                        <button class="btn btn-outline-danger btn-sm delete-btn" data-index="${index}">Delete</button>
                    </div>
                </div>
            </div>`;
            bookList.innerHTML += html;
        });
    }

    // Display books on Discover page
    function displayDiscoverBooks(bookArray) {
        if (!discoverBookList) return;
        discoverBookList.innerHTML = "";
        if (bookArray.length === 0) {
            discoverBookList.innerHTML = `<p class="text-center mt-3">No books found.</p>`;
            return;
        }
        bookArray.forEach(book => {
            let html = `
            <div class="col-md-3 book-card" data-category="${book.category}">
                <div class="card">
                    <img src="${book.image || 'images/book.jpg'}" class="card-img-top" alt="Book Image">
                    <div class="card-body text-center">
                        <p>${book.title}</p>
                        <small>${book.author}</small>
                    </div>
                </div>
            </div>`;
            discoverBookList.innerHTML += html;
        });
    }

    displayAppBooks(appBooks);
    displayDiscoverBooks(getAllBooks());

    // ADD BOOK
    if (addBookForm) {
        addBookForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const title = document.getElementById("bookTitle").value.trim();
            const author = document.getElementById("bookAuthor").value.trim();
            const category = document.getElementById("bookCategory").value;
            const status = document.getElementById("bookStatus").value;
            const image = document.getElementById("bookImage").value.trim();

            if (!title || !author || !category || !status) {
                alert("Please fill all fields.");
                return;
            }

            appBooks.push({ title, author, category, status, image });
            saveBooks();
            displayAppBooks(appBooks);
            displayDiscoverBooks(getAllBooks());
            addBookForm.reset();

            const addModal = bootstrap.Modal.getInstance(document.getElementById("addBookModal"));
            if (addModal) addModal.hide();
        });
    }

    // EDIT & DELETE
    if (bookList) {
        bookList.addEventListener("click", function (e) {
            const index = e.target.dataset.index;

            if (e.target.classList.contains("delete-btn")) {
                if (confirm("Delete this book?")) {
                    appBooks.splice(index, 1);
                    saveBooks();
                    displayAppBooks(appBooks);
                    displayDiscoverBooks(getAllBooks());
                }
            }

            if (e.target.classList.contains("edit-btn")) {
                const book = appBooks[index];
                document.getElementById("editBookIndex").value = index;
                document.getElementById("editBookTitle").value = book.title;
                document.getElementById("editBookAuthor").value = book.author;
                document.getElementById("editBookCategory").value = book.category;
                document.getElementById("editBookStatus").value = book.status;
                document.getElementById("editBookImage").value = book.image || "";
                const editModal = new bootstrap.Modal(document.getElementById("editBookModal"));
                editModal.show();
            }
        });
    }

    // SAVE EDIT
    const editBookForm = document.getElementById("editBookForm");
    if (editBookForm) {
        editBookForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const index = document.getElementById("editBookIndex").value;
            const newTitle = document.getElementById("editBookTitle").value.trim();
            const newAuthor = document.getElementById("editBookAuthor").value.trim();
            const newCategory = document.getElementById("editBookCategory").value;
            const newStatus = document.getElementById("editBookStatus").value;
            const newImage = document.getElementById("editBookImage").value.trim();

            if (!newTitle || !newAuthor || !newCategory || !newStatus) {
                alert("Please fill all fields.");
                return;
            }

            appBooks[index] = { title: newTitle, author: newAuthor, category: newCategory, status: newStatus, image: newImage };
            saveBooks();
            displayAppBooks(appBooks);
            displayDiscoverBooks(getAllBooks());

            const editModal = bootstrap.Modal.getInstance(document.getElementById("editBookModal"));
            if (editModal) editModal.hide();
        });
    }

    // LOGIN FORM
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const username = document.getElementById("loginUsername").value.trim();
            const password = document.getElementById("loginPassword").value.trim();
            const errorDiv = document.getElementById("loginError");

            // Simple credential check - change these as needed
            if (username === "admin" && password === "1234") {
                errorDiv.style.display = "none";
                const loginModal = bootstrap.Modal.getInstance(document.getElementById("loginModal"));
                if (loginModal) loginModal.hide();
                alert("Welcome, " + username + "!");
                loginForm.reset();
            } else {
                errorDiv.style.display = "block";
            }
        });
    }

    // SEARCH
    if (searchInput) {
        searchInput.addEventListener("keyup", function () {
            const value = searchInput.value.toLowerCase();
            const filtered = appBooks.filter(book =>
                book.title.toLowerCase().includes(value) ||
                book.author.toLowerCase().includes(value)
            );
            displayAppBooks(filtered);
        });
    }

    // CATEGORY FILTER
    if (categoryFilter) {
        categoryFilter.addEventListener("change", function () {
            const value = this.value;
            const filtered = value === "All" ? appBooks : appBooks.filter(book => book.category === value);
            displayAppBooks(filtered);
        });
    }

    // STATUS FILTER
    if (statusFilter) {
        statusFilter.addEventListener("change", function () {
            const value = this.value;
            const filtered = value === "All" ? appBooks : appBooks.filter(book => book.status === value);
            displayAppBooks(filtered);
        });
    }

    // SORT
    if (sortFilter) {
        sortFilter.addEventListener("change", function () {
            const type = this.value;
            const sorted = [...appBooks];
            if (type === "title") sorted.sort((a, b) => a.title.localeCompare(b.title));
            if (type === "author") sorted.sort((a, b) => a.author.localeCompare(b.author));
            displayAppBooks(sorted);
        });
    }

    // DISCOVER CATEGORY BUTTONS
    if (categoryButtons.length && discoverBookList) {
        categoryButtons.forEach(button => {
            button.addEventListener("click", () => {
                const category = button.dataset.category;
                categoryButtons.forEach(btn => btn.classList.remove("active"));
                button.classList.add("active");
                const filtered = category === "All"
                    ? getAllBooks()
                    : getAllBooks().filter(book => book.category === category);
                displayDiscoverBooks(filtered);
            });
        });
    }

    // CONTACT FORM
    if (contactForm) {
        contactForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const name = document.getElementById("name").value.trim();
            const email = document.getElementById("email").value.trim();
            const subject = document.getElementById("subject").value.trim();
            const message = document.getElementById("message").value.trim();

            if (!name || !email || !subject || !message) {
                alert("Please fill in all fields.");
                return;
            }

            alert("Message sent successfully!");
            contactForm.reset();
        });
    }

});
