<template>
    <div>
        <h1>Edit Book</h1>
        <form @submit.prevent="editBook">
            <div class="field">
                <label class="label">Title</label>
                <div class="control">
                    <input class="input" v-model="book.title" required />
                </div>
            </div>

            <div class="field">
                <label class="label">Author</label>
                <div class="control">
                    <input class="input" v-model="book.author" required />
                </div>
            </div>

            <div class="field">
                <label class="label">Genre</label>
                <div class="control">
                    <input class="input" v-model="book.genre" required />
                </div>
            </div>

            <div class="field">
                <label class="label">ISBN</label>
                <div class="control">
                    <input class="input" v-model="book.isbn" required />
                </div>
            </div>

            <div class="field">
                <label class="label">Total Copies</label>
                <div class="control">
                    <input
                        class="input"
                        type="number"
                        v-model="book.total_copies"
                        required
                    />
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-primary">
                        Save Changes
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        book: {
            type: Object,
            required: true,
        },
    },
    methods: {
        async editBook() {
            try {
                const response = await axios.put(
                    `/api/books/${this.book.id}`,
                    this.book
                );

                // Handle successful book edit
                console.log("Book edited successfully", response.data);
                alert("Book edited successfully");

                // Redirect the user or show a success message
            } catch (error) {
                // Handle error during book edit
                console.error("Failed to edit book", error);
            }
        },
    },
};
</script>

<style scoped>
/* Your Bulma or custom styling goes here */
</style>
