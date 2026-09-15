Student Admission Application - Lab (Kabul University, Web Information Systems)

SETUP
1. Copy the "admission_lab" folder into:  C:\xampp\htdocs\
2. Start Apache and MySQL in the XAMPP Control Panel.
3. Open http://localhost/phpmyadmin -> SQL tab -> paste the contents of
   database.sql -> Go.  (Creates admission_db and the applications table.)
4. Open: http://localhost/admission_lab/admission.php

FILES
- database.sql   Task 1: database + table
- db.php         Task 3: OOP MySQLi connection
- admission.php  Tasks 2-4: form, validation, prepared insert, redirect, table

TEST CHECKLIST (Task 5)
[ ] Page opens with no PHP warnings/errors
[ ] Save 3 applications with different programs
    e.g. Ahmad Karimi / Mahmood / ahmad@example.com / 0700123456 / Information Systems
         Sara Rahimi  / Nasir   / sara@example.com  / +93799111222 / Software Engineering
         Omid Noori   / Habib   / omid@example.com  / 0788333444 / Computer Science
[ ] Records appear in phpMyAdmin and in the browser table (newest first)
[ ] Empty fields / invalid email are rejected (to test PHP validation, remove
    the "required" attribute with browser DevTools and submit)
[ ] Refresh after saving does not insert a duplicate (redirect)
[ ] Close and reopen the page - records are still visible

NOTE: Bootstrap is loaded from a CDN, so internet is needed for styling.
