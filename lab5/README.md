# Laravel Beginner Lab — Solved

This folder contains the completed solution for the Kabul University **Laravel: Your First Web Page** beginner lab.

## Completed tasks

- Laravel 12 project dependency configuration
- Home Blade view: `resources/views/home.blade.php`
- About Blade view: `resources/views/about.blade.php`
- `/` route with the `course` variable
- `/about` GET route
- Navigation links between Home and About
- `.env.example` configured with file-based session and cache settings

## Run it on Windows

1. Open Command Prompt in this folder.
2. Make sure PHP 8.2+ and Composer are installed.
3. Run:

```text
composer install
copy .env.example .env
php artisan key:generate
php artisan config:clear
php artisan serve
```

4. Open:

```text
http://127.0.0.1:8000
```

5. Test `/about` and both navigation links.

## Important

The ZIP intentionally does **not** include `vendor/` because Composer dependencies are generated locally by `composer install`.
