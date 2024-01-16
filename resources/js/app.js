require("./bootstrap");

import { createApp } from "vue";

const app = createApp({});

app.component("login-form", require("./components/LoginForm.vue").default);
app.component(
    "register-form",
    require("./components/RegisterForm.vue").default
);
app.component("search-books", require("./components/SearchBooks.vue").default);
app.component("books-index", require("./components/BooksIndex.vue").default);

app.mount("#app");
