# Digital Bulletin Board (PHP)

"Digital Bulletin Board" is a technological innovation designed to modernize the traditional concept of school bulletin boards. By integrating the latest web technologies, this project uses HTML, CSS, JavaScript, PHP, CodeIgniter 4, Composer, and MySQL to create a dynamic and responsive platform.

| Contents |
| -------- |
| [Technologies Used](#technologies-used) |
| [Key Features](#key-features) |
| [Requirements](#requirements) |
| [Setup on Raspberry Pi](#setup-on-raspberry-pi) |
| [Creators and Roles](#creators-and-roles) |

## Technologies Used
1. **HTML, CSS, and JavaScript:** These technologies bring the user interface to life, ensuring an engaging and responsive user experience.

2. **PHP and CodeIgniter 4:** Used as the web development framework to streamline development and ensure project security. CodeIgniter 4 provides a structured environment that simplifies resource management.

3. **Composer:** With Composer, the PHP dependency manager, this project can easily manage and update the required third-party libraries.

4. **MySQL:** As the database management system, MySQL is used to store and manage data related to videos, QR codes, marquee news texts, and school schedules.

## Key Features
1. **Video Display:** The Digital Bulletin Board allows live video streaming, adding a multimedia dimension to the information being displayed.

2. **QR Code:** It provides easy access by embedding QR codes, allowing users to easily access further information.

3. **Marquee News Text:** It features scrolling news text, ensuring that the most current and important information gets maximum attention.

4. **School Activity Schedule:** Automatically displays the school schedule according to the current day, providing easy access to time-related guidance.

5. **Control Panel:** An easily accessible user interface for managing content. The control panel allows users to update database data, change the layout, and make other modifications.

6. **Automated Updates:** Any changes made through the control panel are automatically reflected in the Digital Bulletin Board display, ensuring accuracy and consistency of information.

The "Digital Bulletin Board" project not only brings a modern touch to the traditional school bulletin board but also enhances efficiency in delivering information. By combining the latest technologies and effective management through the control panel, this project introduces an innovative and responsive approach to managing school information.

## Requirements
- MySQL 5.1+
- PHP v8.2+
- PHP v8.2+ Extensions:
  - php-intl
  - php-mbstring
  - php-json
  - php-mysql
  - php-curl
  - php-gd
  - php-dom
- Apache 2.4.56+
- Composer v2.6.3+

## Setup on Raspberry Pi

1. **Update Linux**
```sh
sudo apt update -y
sudo apt upgrade -y
sudo apt-get update -y 
sudo apt-get upgrade -y
```

2. **Install Git**
```sh
sudo apt install git -y
```

3. **Install MySQL and Change Root User Password**
```sh
# Install MySQL
sudo apt install mariadb-server -y

# For viewing MySQL status
sudo service mysql status

# Start MySQL
sudo service mysql start

# Stop MySQL
sudo service mysql stop

# Change MySQL root user password
sudo mysql -u root -p
ALTER USER 'root'@'localhost' IDENTIFIED BY 'newpassword';
exit;
```

4. **Install Apache**
```sh
# Install Apache
sudo apt install apache2 -y

# For viewing Apache status
sudo service apache2 status

# Start Apache
sudo service apache2 start

# Stop Apache
sudo service apache2 stop
```

5. **Install PHP 8.2 & All PHP 8.2 Extensions**

Add PHP 8.2 repository on Raspberry Pi

Source: https://pimylifeup.com/raspberry-pi-latest-php/
```sh
sudo apt install lsb-release

curl https://packages.sury.org/php/apt.gpg | sudo tee /usr/share/keyrings/suryphp-archive-keyring.gpg >/dev/null

echo "deb [signed-by=/usr/share/keyrings/suryphp-archive-keyring.gpg] https://packages.sury.org/php/ $(lsb_release -cs) main" | sudo tee /etc/apt/sources.list.d/sury-php.list

sudo apt update
```

Install PHP 8.2
```sh
sudo apt install php8.2 php8.2-intl php8.2-mbstring php8.2-mysql php8.2-curl php8.2-gd php8.2-dom -y
```

6. **Install Composer (Command-line installation)**

Source: https://getcomposer.org/download/
```sh
# Download the installer to the current directory
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"

# Verify the installer SHA-384
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

# Run the installer
php composer-setup.php

# Remove the installer
php -r "unlink('composer-setup.php');"

# Global install
sudo mv composer.phar /usr/local/bin/composer
```

7. **Clone & Setup Project**

Clone and install all required dependencies
```sh
cd /var/www

sudo git clone https://github.com/AerellSmk/Mading-Digital.git

sudo mv Mading-Digital mading_digital

cd mading_digital

sudo composer install
```

Copy the `env` file and edit the `.env` file

```
sudo cp env .env
sudo nano .env
```

Uncomment `CI_ENVIRONMENT`

```
# CI_ENVIRONMENT = production
to
CI_ENVIRONMENT = production
```

Uncomment `app.baseURL` and set the URL to match the IP address
```
# app.baseURL = ''
to
app.baseURL = 'http://ip-address'
```

Uncomment the database config and set the database configuration
```
# database.default.hostname = localhost
# database.default.database = ci4
# database.default.username = root
# database.default.password = root
# database.default.DBDriver = MySQLi
# database.default.port = 3306
to
database.default.hostname = localhost
database.default.database = mading_digital
database.default.username = root
database.default.password = user_root_password
database.default.DBDriver = MySQLi
database.default.port = 3306
```

Create the database
```sh
sudo php spark db:create mading_digital

./reset_database.sh
```

Enable Apache's `mod_rewrite`
```sh
sudo a2enmod rewrite
```

Set the `DocumentRoot` in `000-default.conf`
```sh
cd /etc/apache2/sites-available

sudo nano 000-default.conf
```

```
DocumentRoot /var/www/html
to
DocumentRoot /var/www/mading_digital
```

Add the `mading_digital` directory in `apache2.conf`
```sh
cd /etc/apache2

sudo nano apache2.conf
```

```
<Directory /var/www/mading_digital/>
    Options Indexes FollowSymLinks
    AllowOverride All
    Require all granted
</Directory>
```

Change folder owner, group, and file permissions
```sh
cd /var/www

sudo chown -R www-data:www-data mading_digital

sudo chmod -R 755 mading_digital
```

Change values for `upload_max_filesize` and `post_max_size` in `php.ini`
```
sudo nano /etc/php/8.2/apache2/php.ini
```

```
upload_max_filesize = 2M
post_max_size = 8M
to
upload_max_filesize = 1G
post_max_size = 1G
```

Restart Apache
```
sudo service apache2 restart
```

8. **Fix Video Autoplay**

In the browser's site settings, under sound, add the URL `http://localhost` to allow autoplay videos on the Digital Bulletin Board.

9. **Make Digital Bulletin Board Auto-Start on Boot**

Edit the autostart file
```sh
sudo nano /etc/xdg/lxsession/LXDE-pi/autostart
```

Add the following
```
@/usr/bin/chromium http://ip-address/ --start-fullscreen
```

## Creators and Roles
- Aerell (Design, Frontend, Backend)
- Reza (Design, Frontend)
- Nico (Design, Frontend)
- Justin (Design, Frontend)
