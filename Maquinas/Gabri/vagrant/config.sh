#!/bin/ash

apk update
apk add nano curl

apk add php82-common php82 php82-phar php82-curl php82-iconv php82-mbstring 
apk add php82-openssl php82-zip php82-pdo_mysql php82-xml php82-tokenizer
apk add php82-xmlwriter php82-session
apk add php82-dom php82-fileinfo php82-pdo_sqlite php82-sqlite3
apk add php82-apache2

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


docker network create netlamp

echo Creamos los contenedores

docker run -dit \
        --network netlamp \
        -p 3306:3306 \
        --hostname mysqlserver \
        --name mysqlserver \
        -e MYSQL_ROOT_PASSWORD=toor \
        -v mysqldata:/var/lib/mysql \
        --restart unless-stopped \
        mysql:8

docker run -d \
        --network netlamp \
        --hostname phpmyadmin \
        --name phpmyadmin \
        -e PMA_HOST=mysqlserver \
        -p 8080:80 \
        --restart unless-stopped \
phpmyadmin

docker container run -dit \
--network netlamp \
-e "MH_STORAGE=maildir" \
-v mailhog:/maildir \
--hostname mailhog \
--name mailhog \
--restart=unless-stopped \
-p 1025:1025 -p 8025:8025 \
mailhog/mailhog

docker container run -dit \
-e SOKETI_DEBUG=1 \
-e SOKETI_METRICS_SERVER_PORT='9601' \
-e SOKETI_DEFAULT_APP_ID='app-id' \
-e SOKETI_DEFAULT_APP_KEY='app-key' \
-e SOKETI_DEFAULT_APP_SECRET='app-secret' \
-p 6001:6001 \
-p 9601:9601 \
--network netlamp \
--name=soketi \
--hostname soketi \
--restart unless-stopped \
quay.io/soketi/soketi:1.4-16-debian
