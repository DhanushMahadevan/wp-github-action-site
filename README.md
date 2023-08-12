# Deploying a WordPress Site using LEMP (Linux, Nginx, MySQL, PHP) stack by GitHub Actions
 
 ## Description
 I'd happily guide you through the general steps to provision a Virtual Private Server (VPS) on a primary cloud provider like AWS, Azure, Google Cloud, or DigitalOcean to host a WordPress website with continuous integration with Github Action. Please note that specific steps might vary depending on the cloud provider you choose.

 Click Here to view Live project: https://dhanushcloudever.online

## Pre-Requisites
 * Once you have any of the above infrastructure you can start the installation. For this, you need four different software components:
  * NGINX: The actual web server.
  * MySQL: A database that stores the content of your WordPress site, among other things.
  * PHP: The scripting language that enables dynamic elements on your website.
  * WordPress: The content management system helps you define the look of your website and manage the content.
All the software components you need for your WordPress installation are available for free. I explain how to install and properly configure each component.

## Update the System:
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
 ### 1. Enable Gzip Compression:
   Gzip compression reduces the size of files sent from your server, improving load times for your website:
Edit your Nginx configuration file (usually located at /etc/nginx/nginx.conf or /etc/nginx/sites-available/yourdomain.com) and add or update these lines within the http block:
```
gzip on;
gzip_types text/plain text/css application/json application/javascript text/xml application/xml application/xml+rss text/javascript;
gzip_vary on;
gzip_proxied any;
gzip_comp_level 6; # Adjust compression level based on your server's resources
gzip_min_length 1000;
```
### 2. Implement Browser Caching:
   By configuring browser caching, you can instruct browsers to store certain assets locally, reducing the need to fetch them repeatedly:
   ```
   location ~* \.(jpg|jpeg|png|gif|ico|css|js)$ {
    expires 1y;
    add_header Cache-Control "public, max-age=31536000";
    add_header Vary Accept-Encoding;
    access_log off;
}

   ```
Exit the status display by pressing “Q” (like Quit) on your keyboard.
## step2: Install ufw for Allowing and Denying traffic
```
sudo apt install ufw -y
```
Allow HTTP,HTTPS,NGINX HTTPS traffic
```
sudo ufw allow OpenSSH
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw allow NGINX HTTPS
```
```
sudo ufw status
sudo ufw enable
sudo ufw reload
```
## Step 3: Install MySQL

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
And here is where you also create a new user including the password for this database and assign the required rights. You’re free to choose the username and password:

```
CREATE USER 'user'@'localhost' IDENTIFIED BY 'password'
GRANT ALL PRIVILEGES ON WordPress.* TO 'user'@'localhost'
```
Now leave MySQL again:
```
EXIT;
```
## Step 4: Install PHP

The last step before you install WordPress is to install the PHP scripting language. For this, you need only one command, which then automatically installs the latest PHP version:
```
sudo apt install php-fpm -y
```
During the installation process, you will also see which version is installed on your system. With this information, you can then verify that PHP is working correctly. In our case, version 8.2 was installed. If you already have a newer version, you must adjust the command accordingly:
```
sudo systemctl status php8.1-fpm
```
In order for PHP to work with the MySQL database, install the following extension:
```
sudo apt-get install php-mysql -y
```
## Step 5: Install WordPress

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
## Step 6: Customize the WordPress configuration file

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
We set the required information for this in step 2. In our case the database is called “WordPress”, the username is simply “user” and the password we have simply set as “password”.
Hit this link: https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service for security enhancement to paste in the wp-config file.
When you have entered your data, you can save the document and close it again.

## Step 7: Set NGINX 
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
## Step 8: Log into the WordPress dashboard
Now you have everything installed and you can start designing your WordPress website. To do this, launch a browser and access your domain. In this tutorial, we have set WordPress as a subdomain under “wordpress.example.com”. So you would need to visit the appropriate subdomain, which is where you will be greeted with the first page of the setup wizard.

## Step 9: To implement SSL/TLS certificates
### 1. Prerequisites:
Make sure your server is accessible via a domain name (e.g., yourdomain.com) and that you have SSH access to your server.

### 2. Install Certbot:
Certbot is the official Let's Encrypt client that helps you obtain and manage SSL certificates. Install Certbot on your server:

```
sudo apt update
sudo apt install certbot python3-certbot-nginx
```
### 3. Obtain SSL Certificate:
Run Certbot to obtain and install an SSL certificate for your domain:
```
sudo certbot --nginx -d example.com -d www.example.com

```
After Certbot successfully obtains the SSL certificate, you should test your Nginx configuration:
```
sudo nginx -t
sudo systemctl reload nginx
```
## Step 10: Github Workflow

# Deployment GitHub Action

This GitHub Actions workflow automates the deployment process for a web application, specifically targeted at deploying a WordPress theme to a remote server. The workflow is triggered whenever changes are pushed to the master branch.

# Workflow Overview

The workflow consists of the following steps:

1. Checkout Repository: This step checks out the code from the repository, allowing subsequent steps to work with the codebase.


2. Sync to Remote Server: The main step of the workflow, this section performs the synchronization of the local code to a remote server. It uses the rsync command to ensure that the remote server's files match those in the local repository. This step uses SSH key-based authentication for secure communication with the remote server.
   The synchronization process excludes certain files and directories:
3. Restart the nginx server.
   
* /deploy_key: The SSH key used for authentication is excluded from the synchronization.
* /.git/: The local Git repository directory is excluded to avoid copying unnecessary version control files.
* /.github/: The GitHub Actions workflow files are excluded from the synchronization.
* /README.md/: README.md file is excluded to avoid copying to the remote server.

  # Configuration
To set up this GitHub Actions workflow for your project, follow these steps:

Remote Server: Ensure you have access to a remote server where you want to deploy your code. Update the following secrets in your GitHub repository settings:

* SERVER_USERNAME: The username to connect to the remote server.
* SERVER_HOST: The hostname or IP address of the remote server.
* SERVER_SSH_KEY: The private SSH key to use for authentication. Generate an SSH key pair and add the private key as a secret.

* GitHub Actions Workflow: Create a .github/workflows directory in your repository if it doesn't exist. Inside this directory, create a .yml file (e.g., deploy.yml) and copy the provided workflow code into this file.


# Conclusion
* This GitHub Actions workflow simplifies the deployment of your WordPress theme by automating the synchronization process using Rsync. By configuring a few secrets and adjusting the deployment destination, you can ensure that your latest changes are efficiently pushed to your remote server upon every push to the master branch.
 
### Happy coding and deploying!
















