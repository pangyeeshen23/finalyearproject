This project is build with Laravel, Interia Js and Vue JS

To run this project in development you will need to do the installation
npm install
composer install

Run code is
npm run dev - frontend
php artisan serve - backend
both run code must be used to serve the project

Run the seeder for the demo datas.
php artisan migrate - to create database

php artisan db:seed --class=AdminTablesSeeder
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=DatabaseSeeder

Requirement
Google map is being used, Need the Google Console Key to be configured.
In the admin.php folder.
