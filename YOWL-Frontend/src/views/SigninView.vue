<script setup>
import '@/assets/css/signin.css'
</script>


<template>

    <!-- Form Container -->
    <div class="form-container">
        <div class="col col-1">
            <div class="image-layer">
                <img src="@/assets/img/white-outline.png" class="form-image-main">
                <img src="@/assets/img/pandas_1.png" class="form-image pandas">

            </div>
            <p class="featured-words">Register with your <span>personal details</span> use all of site features.</p>
        </div>

        <div class="col col-2">

            <!-- Login Form Container -->
            <div class="login-form">
                <div class="form-title">
                    <span>Sign In</span>
                </div>

                <div>
                    <div class="login__inputs">
                        <div>
                            <label for="input-email" class="login__label">Email</label>

                            <div class="login__box">
                                <input type="email" placeholder="Enter your email address" required class="login__input"
                                    id="input-email">
                                <i class="bx bx-envelope login__eye icon"></i>
                            </div>
                        </div>

                        <div>
                            <label for="input-pass" class="login__label">Password</label>

                            <div class="login__box">
                                <input type="password" placeholder="Enter your password" required class="login__input"
                                    id="input-pass">
                                <i class="ri-eye-off-line login__eye" id="input-icon"></i>
                            </div>
                        </div>
                    </div>

                    <div class="login__check">
                        <input type="checkbox" class="login__check-input" id="input-check">
                        <label for="input-check" class="login__check-label">Remember me</label>
                    </div>

                    <div class="input-box">
                        <button class="input-submit">
                            <span>Sign In</span>
                            <i class="bx bx-right-arrow-alt"> </i>
                        </button>
                    </div>
                </div>
                <div class="social-login">
                    <i class="bx bxl-google"></i>
                    <i class="bx bxl-facebook"></i>
                    <i class="bx bxl-twitter"></i>
                    <i class="bx bxl-github"></i>
                </div>

                <div class="input-box">
                    <p>Not a Member</p>
                    <button class="input-submit">
                        <a href="/signup">
                            <span>Sign Up</span>
                        </a>
                        <i class="bx bx-right-arrow-alt"> </i>
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>