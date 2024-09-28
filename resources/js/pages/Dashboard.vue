<template>
    <h1>{{ email }}</h1>
    <h2>{{ message }}</h2>
    <img id="qrcode" src="" alt="" />
    <button @click="onLogout">Logout</button>
    <button @click="getPDF">Get Users</button>
    <button @click="getApi">Get Api</button>
    <button @click="getContracts">Get Contracts</button>
</template>
<script lang="ts" setup>
import { ref, onMounted } from "vue";
import apiRequest from "@/utils/apiRequest";
import { useRoute, useRouter } from "vue-router";
import QRCode from "qrcode";
import { getMessaging, onMessage } from "firebase/messaging";

const messaging = getMessaging();
onMessage(messaging, (payload) => {
    console.log("Message received. ", payload);
});
const router = useRouter();
const route = useRoute();
const email = ref(null);
const users = ref(null);
const message = ref(null);
async function onLogout() {
    try {
        await apiRequest.get("/logout");
        router.push({ name: "Login" });
    } catch (error) {
        console.log(error);
    }
}

async function getContracts() {
    try {
        const response = await apiRequest.get("/contracts");
        const url = await QRCode.toDataURL(
            `http://localhost:8000/contract/${response.data[0].id}`
        );
        (document.getElementById("qrcode") as HTMLImageElement).src = url;
    } catch (error) {
        console.log(error);
    }
}

async function getApi() {
    try {
        const response = await apiRequest.get("/contract/delete");
        console.log(response.data);
    } catch (error) {
        console.log(error);
    }
}

async function getPDF() {
    try {
        const response = await apiRequest.get("/users/pdf");
        const url = window.URL.createObjectURL(new Blob([response.data]));
        const link = document.createElement("a");
        link.href = url;
        link.setAttribute("download", "users.pdf");
        document.body.appendChild(link);
        link.click();
    } catch (error) {
        console.log(error);
    }
}

const getUser = async () => {
    try {
        const response = await apiRequest.get("/user");
        email.value = response.data.email;
    } catch (error) {
        console.log(error);
    }
};

const getUsers = async () => {
    try {
        await apiRequest.get("/users");
    } catch (error) {
        console.log(error);
    }
};

window.Echo.private("message").listen("NewMessage", (e: Event) => {
    message.value = (e.target as any).message;
});

onMounted(async () => {
    getUsers();
    getUser();
    getContracts();
});
</script>
