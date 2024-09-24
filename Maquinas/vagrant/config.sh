#!/bin/ash

apk update
apk add nano

apk add php82-common php82 php82-phar php82-curl php82-iconv php82-mbstring 
apk add php82-openssl php82-zip php82-pdo_mysql php82-xml php82-tokenizer
apk add php82-phar
apk add php82-dom php82-fileinfo php82-pdo_sqlite php82-sqlite3
apk add php82-apache2

apk add phpmyadmin
apk add mariadb mariadb-client
/etc/init.d/mariadb setup
rc-update add mariadb
rc-service mariadb start
# mariadb -u root -e "CREATE USER 'programador'@'%' IDENTIFIED BY 'programador';"
# mariadb -u root -e "CREATE USER 'programador'@'localhost' IDENTIFIED BY 'programador';"
# mariadb -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'programador'@'%';"
# mariadb -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'programador'@'localhost';"
mariadb -u root -e "ALTER USER 'root'@'localhost' IDENTIFIED BY 'toor';"
mariadb -u root -ptoor -e "FLUSH PRIVILEGES;"

chown -R apache:apache /etc/phpmyadmin
echo "ServerName apacheserver" >> /etc/apache2/httpd.conf
rc-update add apache2
rc-service apache2 start

apk add samba
mkdir -p /home/vagrant/laravel
chown -R vagrant.vagrant /home/vagrant/laravel  
(echo vagrant; echo vagrant) | smbpasswd -s -a vagrant
sudo tee -a /etc/samba/smb.conf << END

[LARAVEL]
   comment = Share para Laravel
   path = /home/vagrant/laravel
   guest ok = no
   browseable = yes
   create mask = 0775
   directory mask = 0775
   write list = vagrant
   valid users = vagrant
END

apk add icu-data-full
rc-update add samba
rc-service samba start

apk add nodejs
apk add npm


apk add docker
adduser vagrant docker
rc-update add docker
rc-service docker start

# Ver /etc/apache2/conf.d/phpmyadmin.conf

ln /usr/bin/php82 /usr/bin/php
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer 

curl -LO https://phar.phpunit.de/phpunit-9.6.phar
chmod +x phpunit-9.6.phar
mv phpunit-9.6.phar phpunit
mv phpunit /usr/bin
