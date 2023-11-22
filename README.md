# Mading Digital

"Mading Digital" adalah sebuah inovasi teknologi yang dirancang untuk memodernisasi konsep tradisional dari mading sekolah. Menggabungkan teknologi web terkini, proyek ini memanfaatkan HTML, CSS, JavaScript, PHP, CodeIgniter 4, Composer, dan MySQL untuk menciptakan platform yang dinamis dan responsif.

| Konten |
| ------ |
| [Teknologi yang Digunakan](#teknologi-yang-digunakan) |
| [Fitur Utama](#fitur-utama) |
| [Persyaratan Yang Dibutuhkan](#persyaratan-yang-dibutuhkan) |
| [Cara Setup Di Raspberry Pi](#cara-setup-di-raspberry-pi) |
| [Pembuat beserta perannya](#pembuat-beserta-perannya) |

## Teknologi yang Digunakan
1. **HTML, CSS, dan JavaScript:** Mewujudkan antarmuka pengguna yang menarik dan responsif, memastikan pengalaman pengguna yang optimal.
  
2. **PHP dan CodeIgniter 4:** Digunakan sebagai kerangka kerja pengembangan web untuk menyederhanakan pengembangan dan menjaga keamanan proyek. CodeIgniter 4 memberikan struktur yang terorganisir dan memudahkan manajemen sumber daya.

3. **Composer:** Dengan menggunakan Composer, manajer dependensi PHP, proyek ini dapat dengan mudah mengelola dan memperbarui pustaka pihak ketiga yang diperlukan.

4. **MySQL:** Sebagai sistem manajemen basis data, MySQL digunakan untuk menyimpan dan mengelola data terkait video, QR code, teks marquee berita, dan jadwal kegiatan sekolah.

## Fitur Utama
1. **Tampilan Video:** Mading Digital ini memungkinkan untuk menampilkan video secara langsung, memberikan dimensi multimedia pada informasi yang disampaikan.

2. **QR Code:** Memberikan kemudahan akses dengan menyematkan QR code, memungkinkan pengguna untuk mengakses informasi lebih lanjut dengan mudah.

3. **Marquee Text Berita:** Menghadirkan teks berita yang bergerak, memastikan bahwa informasi terkini dan penting mendapatkan perhatian maksimal.

4. **Jadwal Kegiatan Sekolah:** Secara otomatis menampilkan jadwal kegiatan sekolah sesuai dengan hari yang berlaku, memberikan panduan waktu yang mudah diakses.

5. **Control Panel:** Sebuah antarmuka pengguna yang dapat diakses dengan mudah untuk mengelola konten. Control panel ini memungkinkan pengguna untuk memperbarui data dalam database, mengganti tampilan, dan membuat perubahan lainnya.

6. **Otomatisasi Perubahan:** Setiap perubahan yang dilakukan melalui control panel akan langsung tercermin pada tampilan Mading Digital. Proses otomatisasi ini memastikan keakuratan dan konsistensi informasi.

Proyek "Mading Digital" tidak hanya memberikan sentuhan modern pada tradisi mading sekolah, tetapi juga meningkatkan efisiensi dalam menyampaikan informasi. Dengan kombinasi teknologi terkini dan manajemen yang efektif melalui control panel, proyek ini membawa pendekatan yang inovatif dan responsif dalam mengelola informasi sekolah.

## Persyaratan Yang Dibutuhkan
- Mysql 5.1+
- PHP v8.2+
- PHP v8.2+ Extension
  - php-intl
  - php-mbstring
  - php-json
  - php-mysql
  - php-curl
  - php-gd
  - php-dom
- Apache 2.4.56+
- Composer v2.6.3+

## Cara Setup Di Raspberry Pi

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

3. **Install Mysql Dan Ganti Password User Root Mysql**
```sh
# Install mysql
sudo apt install mariadb-server -y

# For view mysql status
sudo service mysql status

# Start mysql
sudo service mysql start

# Stop mysql
sudo service mysql stop

# Change mysql root user password
sudo mysql -u root -p
ALTER USER 'root'@'localhost' IDENTIFIED BY 'newpassword';
exit;
```

4. **Install Apache**
```sh
# Install apache
sudo apt install apache2 -y

# For view apache status
sudo service apache2 status

# Start apache
sudo service apache2 start

# Stop apache
sudo service apache2 stop
```

5. **Install PHP 8.2 & All PHP 8.2 Extension**

Menambahkan Repository PHP 8.2 on Raspberry Pi

Source : https://pimylifeup.com/raspberry-pi-latest-php/
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


Source : https://getcomposer.org/download/
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

7. **Clone & Setup project**

Clone and install semua depedency yang dibutuhkan project
```sh
cd /var/www

sudo git clone https://github.com/AerellSmk/Mading-Digital.git

sudo mv Mading-Digital mading_digital

cd mading_digital

sudo composer install
```

Copy file ``env`` dan edit file ``.env``

```
sudo cp env .env
sudo nano .env
```

Uncomment CI_ENVIRONMENT

```
# CI_ENVIRONMENT = production
to
CI_ENVIRONMENT = production
```

Uncomment app.baseURL dan set url sesuaikan dengan ip address
```
# app.baseURL = ''
to
app.baseURL = 'http://ip-address'
```

Uncomment database config dan set config database
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

Buat database
```sh
sudo php spark db:create mading_digital

./reset_database.sh
```

Aktifkan mod_rewrite apache2
```sh
sudo a2enmod rewrite
```

Atur DocumentRoot in 000-default.conf
```sh
cd /etc/apache2/sites-available

sudo nano 000-default.conf
```

```
DocumentRoot /var/www/html
to
DocumentRoot /var/www/mading_digital
```

Menambahkan Directory mading_digital in apache2.conf
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

Ganti folder owner, group and izin file
```sh
cd /var/www

sudo chown -R www-data:www-data mading_digital

sudo chmod -R 755 mading_digital
```

Ganti value upload_max_filesize dan post_max_size yang ada di php.ini
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
Restart apache2
```
sudo service apache2 restart
```
8. **Fix video autoplay**

Di pengaturan browser di sites setting pada sound tambahkan url situs yang diizinkan masukkan http://localhost, agar video autoplay yang ada di mading digital berfungsi.

9. **Cara agar mading digital langsung terbuka saat startup**

Edit file autostart
```sh
sudo nano /etc/xdg/lxsession/LXDE-pi/autostart
```

Tambahkan
```
@/usr/bin/chromium http://ip-address/ --start-fullscreen
```

## Pembuat beserta perannya
- Aerell (Desain, Frontend, Backend)
- Reza (Desain, Frontend)
- Nico (Desain, Frontend)
- Justin (Desain, Frontend)