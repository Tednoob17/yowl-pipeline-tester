<script setup>
import LoginForm from "@/components/forms/LoginForm.vue";

</script>

<template>
    <div class="container" id="container">

        <login-form></login-form>

        <div class="toggle-container">
            <div class="toggle">
                <!-- <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div> -->
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Register with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>