<script setup>
import '@/assets/css/signup.css'
</script>


<template>
    
    <!-- Form Container -->
    <div class="form-container">
        <div class="col col-3">
            <div class="image-layer">
                <img src="@/assets/img/white-outline.png" class="form-image-main">
                <img src="@/assets/img/pandas_1.png" class="form-image pandas">

            </div>
            <p class="featured-words">Enter your <span>personal details</span> to use all of site features. </p>
        </div>

        <div class="col col-4">

            <!-- Register Form Container -->
            <div class="register-form">
                <div class="form-title">
                    <span>Create Account</span>
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
                            <label for="input-pass" class="login__label">Username</label>

                            <div class="login__box">
                                <input type="text" placeholder="Username" required class="login__input" id="input-pass">
                                <i class="bx bx-user login__eye icon" id="input-icon"></i>
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


                    <div class="input-box">
                        <button class="input-submit">
                            <span>Sign Up</span>
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
            </div>
        </div>
    </div>

</template>