<template>
    <div>
        <form @submit.prevent="submit" method="post">
            <input type="email" v-model="user.email">
            <div>
                {{ result }}
            </div>
            <input type="password" v-model="user.password">
            <button type="submit">
                Connexion
            </button>
        </form>

        <button @click="logoutAll">
            Logout
        </button>
    </div>
</template>

<script setup>
import {  ref, onBeforeMount } from 'vue';
import { authService } from '@/services/auth.service';

const user = ref({
    email: "",
    password: ""
})
const auth = authService();
const result = ref({});

onBeforeMount(() => {
    auth.register({
        name: "Georges AYENI",
        email: "adminx@mail.com",
        password: "Password@7",
        birthdate: "12-01-2003",
        terms: true,
        password_confirm: "Password@7"
    })
})

const logoutAll = () => {
    auth.logout().then((res) => {
        console.log("Nexus", res);
    })
}

const submit = () => {
    auth.login(user.value).then((res) => {
        // result.value = res.data
        console.log(res);
        // localStorage.setItem('token', res.data.access_token)
    }).catch((err) => {
        console.log(err);
    })
}
</script>