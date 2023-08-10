# Deploying a WordPress Site using LEMP (Linux, Nginx, MySQL, PHP) stack by GitHub Actions
 
 ## Description
 I'd happily guide you through the general steps to provision a Virtual Private Server (VPS) on a primary cloud provider like AWS, Azure, Google Cloud, or DigitalOcean to host a WordPress website. Please note that specific steps might vary depending on the cloud provider you choose.

## Pre-Requisite
 * Once you have any of the above infrastructure you can start the installation. For this, you need four different software components:
  * NGINX: The actual web server.
  * MySQL: A database that stores the content of your WordPress site, among other things.
  * PHP: The scripting language that enables dynamic elements on your website.
  * WordPress: The content management system helps you define the look of your website and manage the content.
All the software components you need for your WordPress installation are available for free. I explain how to install and properly configure each component.

## Update Ubuntu System:
```
sudo apt update -y
sudo apt upgrade -y
```

## Step 1: Install NGINX
```
sudo apt install nginx -y
```
```
sudo systemctl status nginx
```
Exit the status display by pressing “Q” (like Quit) on your keyboard.

## Step 2: Install MySQL

Next, you need to install a database. WordPress works with both MySQL and MariaDB. We decided to use the classic MySQL even though they both fared equally as well in the MariaB vs. MySQL comparison.
```
sudo apt install mysql-server -y
```
Again, you can test if the installation has worked by checking the status:
```
sudo systemctl status mysql
```
The database is now installed, but it still needs to be configured. To do this, first log in:
```
sudo mysql -u root -p
```
Now you are in the MySQL area, which is where you can create a new database for your WordPress installation:
```
CREATE DATABASE WordPress CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
```
And here is where you also create a new user including password for this database and assign the required rights. You’re free to choose the username and password:

```
CREATE USER 'user'@'localhost' IDENTIFIED BY 'password'
GRANT ALL PRIVILEGES ON WordPress.* TO 'user'@'localhost'
```
Now leave MySQL again:
```
EXIT;
```
## Step 3: Install PHP

The last step before you install WordPress is to install the PHP scripting language. For this, you need only one command, which then automatically installs the latest PHP version:
```
sudo apt install php-fpm -y
```
During the installation process, you will also see which version is installed on your system. With this information, you can then verify that PHP is working correctly. In our case, version 8.2 was installed. If you already have a newer version, you must adjust the command accordingly:
```
sudo systemctl status php8.2-fpm
```
In order for PHP to work with the MySQL database, install the following extension:
```
sudo apt-get install php-mysql -y
```
In order for PHP to work with the MySQL database, install the following extension:
```
sudo apt-get install php-mysql -y
```
## Step 4: Install WordPress

Now you can install WordPress. This can also be done directly via the Ubuntu terminal. First, however, create a folder so that you can install the content management system afterward. It is recommended to name the folder with the domain name. This way it makes it easier to keep several websites apart later on. So create the appropriate folder and then change it to this one:
```
sudo mkdir -p /var/www/html/example.com
cd /var/www/html/example.com
```
Now it’s time to download the latest version from the official WordPress site and unzip the file:
```
wget https://wordpress.org/latest.tar.gz
tar -xvzf latest.tar.gz
```
Since the web server needs to make changes to the folder, you must give NGINX the appropriate authorization:
```
sudo chown -R nginx: /var/www/html/example.com/
```
## Step 5: Customize the WordPress configuration file

You need to configure WordPress so that the CMS can work with your LEMP server. To do this, go to the WordPress directory and create the sample configuration file wp-config.php. Then open the file:
```
cd /var/www/html/example.com
sudo cp wp-config-sample.php wp-config.php
sudo nano wp-config.php
```
 You still need to adjust the file, which you can do by changing the following lines in the document:
 ```
/** The name of the database for WordPress */
define( 'DB_NAME', 'Your database name' );

/** Database username */
define( 'DB_USER', 'The created username' );

/** Database password */
define( 'DB_PASSWORD', 'The password you set' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );
```
We set the required information for this in step 2. In our case the database is called “WordPress”, the username is simply “user” and the password we have simply set as “password”. When you have entered your data, you can save the document and close it again.

## Step 6: Set NGINX 
Now you need to configure NGINX for WordPress. To do this, create a new configuration file in the NGINX file folder:

```
sudo nano /etc/nginx/conf.d/example.com.conf
```
Enter the following code in the empty document:
```
server {
    listen 80;
    root /var/www/html/example.com;
    index  index.php index.html index.htm;
    server_name  wordpress.example.com;

    client_max_body_size 500M;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location = /favicon.ico {
        log_not_found off;
        access_log off;
    }

    location ~* \.(js|css|png|jpg|jpeg|gif|ico)$ {
        expires max;
        log_not_found off;
    }

    location = /robots.txt {
        allow all;
        log_not_found off;
        access_log off;
    }

    location ~ \.php$ {
         include snippets/fastcgi-php.conf;
         fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
         fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
         include fastcgi_params;
    }
}
```
Make sure that you enter the correct path to your WordPress document at the beginning of the file. After that you can check the source code.
```
sudo nginx -t
```
You should get an indication that the syntax is ok and the text was successful. Finally, restart the server to make sure that all changes can take effect.
```
sudo systemctl restart nginx
```
## Step 7: Log into the WordPress dashboard
Now you have everything installed and you can start designing your WordPress website. To do this, launch a browser and access your domain. In this tutorial, we have set WordPress as a subdomain under “wordpress.example.com”. So you would need to visit the appropriate subdomain, which is where you will be greeted with the first page of the setup wizard.


















