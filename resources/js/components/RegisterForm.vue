<template>
    <form @submit.prevent="registerUser">
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input class="input" type="text" v-model="name" required />
            </div>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" type="email" v-model="email" required />
            </div>
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input
                    class="input"
                    type="password"
                    v-model="password"
                    required
                />
            </div>
        </div>

        <div class="field">
            <label class="label">Confirm Password</label>
            <div class="control">
                <input
                    class="input"
                    type="password"
                    v-model="passwordConfirmation"
                    required
                />
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-primary">
                    Register
                </button>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            passwordConfirmation: "",
        };
    },
    methods: {
        async registerUser() {
            try {
                const response = await axios.post("/api/register", {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.passwordConfirmation,
                });

                // Handle successful registration, e.g., redirect or show a success message
                console.log("Registration successful", response.data);

                // Store the token in a secure way (e.g., in a cookie or local storage)
                document.cookie = `token=${response.data.token}; path=/;`;

                // Redirect the user after successful registration
                window.location.href = "/login";
            } catch (error) {
                // Handle registration error
                console.error("Registration failed", error);
            }
        },
    },
};
</script>

<style scoped>
/* Add your component-specific styles here */
</style>
