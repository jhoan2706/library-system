<template>
    <div class="container">
        <h1 class="title">Add New Book</h1>

        <form @submit.prevent="addBook">
            <div class="field">
                <label class="label">Title</label>
                <div class="control">
                    <input v-model="title" class="input" type="text" required />
                </div>
            </div>

            <div class="field">
                <label class="label">Author</label>
                <div class="control">
                    <input
                        v-model="author"
                        class="input"
                        type="text"
                        required
                    />
                </div>
            </div>

            <div class="field">
                <label class="label">Genre</label>
                <div class="control">
                    <input v-model="genre" class="input" type="text" required />
                </div>
            </div>

            <div class="field">
                <label class="label">ISBN</label>
                <div class="control">
                    <input v-model="isbn" class="input" type="text" required />
                </div>
            </div>

            <div class="field">
                <label class="label">Total Copies</label>
                <div class="control">
                    <input
                        v-model="totalCopies"
                        class="input"
                        type="number"
                        required
                    />
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-primary">
                        Add Book
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            title: "",
            author: "",
            genre: "",
            isbn: "",
            totalCopies: 0,
        };
    },
    methods: {
        async addBook() {
            try {
                const response = await axios.post("/api/books", {
                    title: this.title,
                    author: this.author,
                    genre: this.genre,
                    isbn: this.isbn,
                    total_copies: this.totalCopies,
                });

                // Handle successful addition of a new book
                console.log("Book added successfully", response.data);
                alert("Book added successfully");

                // Redirect the user or show a success message
            } catch (error) {
                // Handle error during book addition
                console.error("Failed to add book", error);
            }
        },
    },
};
</script>

<style scoped>
/* Your Bulma or custom styling goes here */
</style>
