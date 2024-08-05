<script setup>
import { Head, Link } from '@inertiajs/vue3';

const liens = [
    { name: 'Home', url: 'home' },
    { name: 'Login', url: 'login' },
    { name: 'Register', url: 'register' },
];
</script>

<template>
    <Head title="Admin free pandas" />
    <div class="h-screen flex flex-col justify-center items-center">
        <div class="my-8 text-6xl tracking-widest text-blue-600 font-bold">
            FREE PANDA'S
        </div>
        <div v-if="!$page.props.auth.user">
            <Link class="mx-2" :href="route(lin.url)" v-for="lin in liens" :key="lin">
                {{ lin.name }}
            </Link>
        </div>
        <div v-else class="flex flex-col items-center">
            <p>Welcome {{ $page.props.auth.user.name }}</p>
            <div class="mt-4 flex space-x-2 hover:bg-blue-500 p-2 transition-colors duration-300 ease-in-out">
                <p>Go to </p>
                <Link :href="route('dashboard')">dashboard</Link>
            </div>
        </div>
    </div>
</template>
