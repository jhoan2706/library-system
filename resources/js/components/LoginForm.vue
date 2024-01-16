<template>
    <form @submit.prevent="loginUser">
        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input
                    v-model="email"
                    class="input"
                    type="email"
                    name="email"
                    required
                />
            </div>
        </div>

        <div class="field">
            <label class="label">Password</label>
            <div class="control">
                <input
                    v-model="password"
                    class="input"
                    type="password"
                    name="password"
                    required
                />
            </div>
        </div>

        <button type="submit" class="button is-primary">Login</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        async loginUser() {
            try {
                const response = await axios.post("/api/login", {
                    email: this.email,
                    password: this.password,
                });

                console.log("response", response);
                const { token, redirect_path } = response.data;

                // Store the token in a secure way (e.g., in a cookie or local storage)
                localStorage.setItem("token", token);
                // Redirect the user based on their role
                window.location.href = redirect_path;
            } catch (error) {
                // Handle login error
                console.error("Login failed", error);
            }
        },
    },
};
</script>

<style scoped>
/* Add your component-specific styles here */
</style>
