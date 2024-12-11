<template>
    <div class="container">
        <div class="login-card">
            <h2>Login1</h2>
            <form @submit.prevent="onLogin">
                <label for="username">Username1:</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    v-model="form.email"
                />

                <label for="password">Password:</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    v-model="form.password"
                />

                <button type="submit">Login</button>
            </form>
            <button @click="loginWithGitHub">Login with Github</button>
            <a href="/forgot-password">Forgot Password</a>
        </div>
    </div>
</template>
<script lang="ts" setup>
import { onMounted, ref } from "vue";
import apiRequest from "@/utils/apiRequest";
import { useRoute, useRouter } from "vue-router";

const router = useRouter();
const route = useRoute();
const form = ref({
    email: null,
    password: null,
});

function loginWithGitHub() {
    window.location.href = "/api/login/github";
}

async function onLogin() {
    try {
        const response = await apiRequest.post("/login", form.value);
        if (response.status === 200) router.push({ name: "Dashboard" });
    } catch (error) {
        console.log(error);
    }
}

onMounted(async () => {
    try {
        const response = await apiRequest.get("/user");
        if (response.status === 200) router.push({ name: "Dashboard" });
    } catch (error) {
        console.log(error);
    }
});
</script>
