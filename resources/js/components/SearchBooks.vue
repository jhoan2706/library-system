<template>
    <div class="container">
        <h1 class="title">Search Books</h1>

        <form @submit.prevent="searchBooks">
            <div class="field">
                <label class="label">Search</label>
                <div class="control">
                    <input
                        v-model="query"
                        class="input"
                        type="text"
                        name="query"
                        required
                    />
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-info">Search</button>
                </div>
            </div>
        </form>

        <table v-if="books && books.data.length" class="table is-fullwidth">
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
                <tr v-for="book in books.data" :key="book.id">
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
        <nav class="pagination" role="navigation" aria-label="pagination">
            <ul class="pagination-list">
                <li v-if="books.prev_page_url">
                    <a
                        @click.prevent="fetchPage(books.current_page - 1)"
                        class="pagination-link"
                        aria-label="previous"
                        >Previous</a
                    >
                </li>
                <li v-for="page in books.links" :key="page.url">
                    <a
                        @click.prevent="fetchPage(page.label)"
                        class="pagination-link"
                        :class="{
                            'is-current': page.label === books.current_page,
                        }"
                        >{{ page.label }}</a
                    >
                </li>
                <li v-if="books.next_page_url">
                    <a
                        @click.prevent="fetchPage(books.current_page + 1)"
                        class="pagination-link"
                        aria-label="next"
                        >Next</a
                    >
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import { checkIsLibrarian } from "../utils/auth";

export default {
    data() {
        return {
            query: "",
            books: { data: [] },
            isLibrarian: false, // Set to true if the user is a librarian
        };
    },
    async mounted() {
        // Check the user's role and set isLibrarian accordingly
        this.isLibrarian = await checkIsLibrarian();
    },
    methods: {
        searchBooks() {
            // Make an asynchronous request to searchBooks endpoint
            axios
                .get(`/api/books/search?query=${this.query}`)
                .then((response) => {
                    this.books = response.data;
                })
                .catch((error) => {
                    console.error("Error fetching books:", error);
                });
        },
        fetchPage(page) {
            // Make an asynchronous request to fetch a specific page of search results
            axios
                .get(`/api/books/search?query=${this.query}&page=${page}`)
                .then((response) => {
                    this.books = response.data;
                })
                .catch((error) => {
                    console.error(
                        `Error fetching page ${page} of books:`,
                        error
                    );
                });
        },
        deleteBook(bookId) {
            // Make an asynchronous request to delete the book
            axios
                .delete(`/api/books/${bookId}`)
                .then((response) => {
                    // Handle success, e.g., remove the deleted book from the list
                    this.books.data = this.books.data.filter(
                        (book) => book.id !== bookId
                    );
                })
                .catch((error) => {
                    console.error("Error deleting book:", error);
                });
        },
    },
};
</script>
