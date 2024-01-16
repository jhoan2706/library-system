<!-- resources/js/components/BooksIndex.vue -->

<template>
    <div class="container">
        <h1 class="title">Books</h1>

        <a v-if="isLibrarian" href="books/add" class="button is-primary"
            >Add New Book</a
        >
        <a href="/books/search" class="button is-info">Search</a>

        <div v-if="success" class="notification is-success">
            {{ success }}
        </div>

        <div v-if="error" class="notification is-danger">
            {{ error }}
        </div>

        <table class="table is-fullwidth">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Genre</th>
                    <th>ISBN</th>
                    <th>Total Copies</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="book in books" :key="book.id">
                    <td>{{ book.title }}</td>
                    <td>{{ book.author }}</td>
                    <td>{{ book.genre }}</td>
                    <td>{{ book.isbn }}</td>
                    <td>{{ book.total_copies }}</td>
                    <td>
                        <a
                            v-if="isLibrarian"
                            :href="'/books/edit/' + book.id"
                            class="button is-info"
                            >Edit</a
                        >
                        <button
                            v-if="isLibrarian"
                            @click="deleteBook(book.id)"
                            class="button is-danger"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Pagination links -->
        <div v-if="books.length">
            <ul class="pagination">
                <li v-if="books.current_page > 1">
                    <a
                        @click.prevent="fetchBooks(books.current_page - 1)"
                        href="#"
                        >Previous</a
                    >
                </li>
                <li
                    v-for="page in books.last_page"
                    :key="page"
                    :class="{ 'is-current': page === books.current_page }"
                >
                    <a @click.prevent="fetchBooks(page)" href="#">{{ page }}</a>
                </li>
                <li v-if="books.current_page < books.last_page">
                    <a
                        @click.prevent="fetchBooks(books.current_page + 1)"
                        href="#"
                        >Next</a
                    >
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            books: [],
            isLibrarian: false, // Set to true if the user is a librarian
            success: "",
            error: "",
        };
    },
    mounted() {
        this.fetchBooks();
    },
    methods: {
        fetchBooks(page = 1) {
            // Make an asynchronous request to fetch paginated books
            axios
                .get(`/api/books?page=${page}`)
                .then((response) => {
                    this.books = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching books:", error);
                });
        },
        deleteBook(bookId) {
            // Make an asynchronous request to delete the book
            axios
                .delete(`/api/books/${bookId}`)
                .then((response) => {
                    // Handle success, e.g., remove the deleted book from the list
                    this.success = response.data.success;
                    this.fetchBooks();
                })
                .catch((error) => {
                    console.error("Error deleting book:", error);
                    this.error = "Error deleting book.";
                });
        },
    },
};
</script>
