This project is build with Laravel, Interia Js and Vue JS

To run this project, you will need to install and configure the environment
NodeJs
Composer
Nginx
PHP
Mysql

Then, navigate to the project folder and run the following commands

npm install
composer install

After that, you will need to create the .env file for the laravel project
and change the value based on the .env file

Then run php artisan migrate - to create database

For development, you will need to run these command in different terminal
npm run dev - development
php artisan serve - backend
both run code must be used to serve the project

For Demo Datas
php artisan migrate
php artisan db:seed --class=AdminTablesSeeder
php artisan db:seed --class=AdminSeeder
php artisan db:seed --class=DatabaseSeeder

Requirement
Google map is being used, Need the Google Console Key to be configured.
in the admin.php folder.

To deploy the project run
npm run build - to build the frontend project
and point the root directory in nginx to the public folder of the laravel project

Lastly, configure the folder permission to allow the public to be able to access the laravel project.
