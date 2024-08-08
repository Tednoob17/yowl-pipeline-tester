<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=²https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css">
    <title>Mail Verification</title>
</head>

<body>
    <section class="max-w-2xl px-6 py-8 mx-auto bg-white dark:bg-gray-900">
        <main class="mt-8">
            <h2 class="text-gray-700 dark:text-gray-200">Verifaction</h2>

            <p class="mt-2 leading-loose text-gray-600 dark:text-gray-300">
                Welcome to <span class="font-semibold ">Free Pandas</span>.
                <br>
                Please verify your email address to complete your registration.
            </p>

            <a href="{{ route('mail.verify', $token) }}"
                class="px-6 py-2 mt-4 text-sm font-medium tracking-wider text-white capitalize transition-colors duration-300 transform bg-blue-600 rounded-lg hover:bg-blue-500 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-80">
                Verify Email
            </a>

            <p class="mt-8 text-gray-600 dark:text-gray-300">
                Thanks, <br>
                The Free Pandas Team
            </p>
        </main>


        <footer class="mt-8">
            <p class="mt-3 text-gray-500 dark:text-gray-400">© 2024 Free PANDAS. All Rights
                Reserved.</p>
        </footer>
    </section>
</body>

</html>
