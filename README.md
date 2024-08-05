# YOWL PROJECT

## Description

This project is a simple implementation of a RESTful API for a web app that allow users to comments every visible content on the internet. The project is built using laravel 11 and vuejs 3.

## Installation
First of all, you need to have composer and npm installed on your machine. If you don't have them installed, you can download them from the following links: [Composer](https://getcomposer.org/download/) and [Npm](https://nodejs.org/en/download/).

After that you have to clone the repository qith `git clone https://github.com/EpitechCodingAcademyPromo2024/C-DEV-160-COT-1-2-yowl-georges.ayeni`

### Backend
1. Cd to the folder "yowl-Backend" and run `composer update` in order to install and update the backend dependencies.
2. Create a new database and add the database credentials to the .env file.
3. Run `php artisan migrate --seed` to create the tables and seed the database.
4. Run `php artisan serve` to start the server.

### Frontend

The projet use pnpm so first you need to install it with `npm install -g pnpm`. You can also use : `curl -fsSL https://get.pnpm.io/install.sh | sh -` if you are on linux.

1. Cd to the folder "YOWL-Frontend" and run `pnpm install` in order to install the frontend dependencies.
2. Run `pnpm run dev` to start the server.
3. Open your browser and go to `http://localhost:5173` to see the app.

## Usage

The app is very simple to use. You can create an account, login, logout, create a post, comment on a post, like a post, dislike a post, and delete a post.

## Authors

- [Georges Ayeni]("http://github.com/Georges987")
- [BELLO-YESSOUF Karim]("")
- [Ted]("")
- [Ollaniyi]("")

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details.

## Acknowledgments

- [Epitech Coding Academy](https://www.epitech.eu/)
- [Laravel](https://laravel.com/)
- [Vuejs](https://vuejs.org/)
- [Vuetify](https://vuetifyjs.com/)
- [Axios](https://axios-http.com/)
- [Tailwindcss](https://tailwindcss.com/)
- [Vue Router](https://router.vuejs.org/)
- [Pinia](https://pinia.esm.dev/)
- [PNPM](https://pnpm.io/)
- [Laravel Sanctum](https://laravel.com/docs/8.x/sanctum)
- [Laravel Jetstream](https://jetstream.laravel.com/2.x/introduction.html)
- [Laravel Scout](https://laravel.com/docs/8.x/scout)
- [Laravel Socialite](https://laravel.com/docs/8.x/socialite)
- [Spatie Laravel Permission](https://spatie.be/docs/laravel-permission/v5/introduction)