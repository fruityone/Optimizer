## About Project
Project functionality info link : https://docs.google.com/document/d/1jUofI2dRnNfPWhsz2mQ9TwG8nafTD5YghNRwY4QXumE/view
Project is considered as json report handling functionality with CRUD (create,read,update,delete) module. 
Used - [Laravel Passport](https://laravel.com/docs/10.x/passport) auth system to detect update / adding events.
Laravel passport generated token is active for 5 minutes (can be changed depending on needs). This token allows to check and find already registered user
and add or update json report for him. 

## Running a Laravel project with Nginx
<h3>Steop 1: Clone Project repository</h3>
Clone the repository to the folder /var/www/html or the one you are going to use.

    git clone https://github.com/fruityone/task.git
<h3>Step 2: Install Nginx</h3>
 - sudo apt-get update
 - sudo apt-get install nginx

Example Nginx configuration file for a Laravel project:

<h3>Step 3: Configure Nginx</h3>

    server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/yourdomain.com/public;

    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.1-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
In the above example, replace yourdomain.com with your actual domain name, and /var/www/yourdomain.com/public with the path to your Laravel project's public directory.

Save this file as /etc/nginx/sites-available/yourdomain.com.conf and create a symbolic link to /etc/nginx/sites-enabled/yourdomain.com.conf using the following command:


    sudo ln -s /etc/nginx/sites-available/yourdomain.com.conf /etc/nginx/sites-enabled/
Restart Nginx to apply the changes:

    sudo systemctl restart nginx
<h3>Stop 4 Configure Laravel</h3>
Configure your laravel project settings and use .env.example to change database credentials. 

    composer install
    php artisan key:generate
After this, check Laravel Passport installed and run
    
    php artisan migrate
    php artisan passport:keys
    php artisan optimize:clear
Run the seeder to seed the users  DB

     php  artisan db:seed --class=DatabaseSeeder
     php artisan passport:install
Now you are free to get Laravel passport token , by default every user password is "password" 
    
     php artisan user:auth <dbseededusername> password
