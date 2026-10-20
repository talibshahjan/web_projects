# Laravel Authentication Lab - Solution

## How to use
1. composer create-project laravel/laravel it-auth-lab "^12.0" ; cd it-auth-lab
2. Create empty DB `it_auth_lab` in phpMyAdmin; copy values from env-settings.txt into .env
3. Copy this folder's `routes/`, `app/`, `resources/` into the project (overwrite when asked;
   delete the generated AuthController first or just overwrite it).
4. php artisan config:clear && php artisan migrate && php artisan serve
5. php artisan route:list  -> check the 6 named routes.

## Oral questions
1. Hash::make(): passwords are stored as one-way hashes, so even if the database leaks,
   the real passwords can't be read. Auth::attempt() compares the typed password to the hash.
2. auth middleware: checks for a signed-in session; if none, redirects to the `login` route.
   (guest middleware does the opposite, so logged-in users can't see /login or /register.)
3. @csrf: adds a hidden _token field tied to the session; Laravel rejects POSTs without a
   valid token (419), blocking forged cross-site requests.

## Test checklist: all rows should be Pass after following the steps above.
