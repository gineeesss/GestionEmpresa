#!/bin/ash

apk update
apk add nano
apk add bash

apk add php82-common php82 php82-phar php82-curl php82-iconv php82-mbstring 
apk add php82-openssl php82-zip php82-pdo_mysql php82-xml php82-tokenizer
apk add php82-phar
apk add php82-dom php82-fileinfo php82-pdo_sqlite php82-sqlite3
apk add php82-apache2

# apk add phpmyadmin
# apk add mariadb mariadb-client
# /etc/init.d/mariadb setup
# rc-update add mariadb
# rc-service mariadb start
# mariadb -u root -e "CREATE USER 'programador'@'%' IDENTIFIED BY 'programador';"
# mariadb -u root -e "CREATE USER 'programador'@'localhost' IDENTIFIED BY 'programador';"
# mariadb -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'programador'@'%';"
# mariadb -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'programador'@'localhost';"
# mariadb -u root -e "ALTER USER 'root'@'localhost' IDENTIFIED BY 'toor';"
# mariadb -u root -ptoor -e "FLUSH PRIVILEGES;"

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

# docker network create --subnet=172.26.0.0/16 --gateway=172.26.0.1 netodoo

# echo Creando contenedor PostGreSQL
# docker container run -dit \
# --network netodoo \
# --restart=unless-stopped \
# -e POSTGRES_USER=odoo \
# -e POSTGRES_PASSWORD=odoo \
# -e POSTGRES_DB=postgres \
# --name odoodb \
# postgres

# echo Creando contenedor Odoo
# docker container run -dit \
# --network netodoo \
# --restart=unless-stopped \
# -p 8069:8069 \
# --name odoo \
# -e HOST=odoodb \
# odoo


echo Recreamos la red
docker network rm netlamp

docker network create --subnet=172.22.0.0/16 --gateway=172.22.0.1 netlamp

echo Creamos los contenedores

# Creacion contenedor mysql

docker run -dit \
        --network netlamp \
        -p 3306:3306 \
        --hostname mysqlserver \
        --name mysqlserver \
        -e MYSQL_ROOT_PASSWORD=toor \
        -v /home/vagrant/docker/mysql:/var/lib/mysql \
        --restart unless-stopped \
        mysql:5

# Creacion contenedor phpmyadmin

docker run -d \
        --network netlamp \
        --hostname phpmyadmin \
        --name phpmyadmin \
        -e PMA_HOST=mysqlserver \
        -p 8080:80 \
        --restart unless-stopped \
        phpmyadmin

# docker run -d \
#         --network netlamp \
#         -p 9080:80 \
#         --name apachephp \
#         --hostname apachephp \
#         -v $HOME/web:/var/www/html \
#         --restart unless-stopped \
#         php:7.4-apache

# echo Reconfiguramos apachepxe
# docker exec -it apachepxe /usr/local/bin/docker-php-ext-install pdo_mysql
# docker exec -it apachepxe /usr/local/bin/docker-php-ext-install sockets

# echo Reiniciamos apachepxe
# docker container restart apachepxe


# Configuracion de php para mostrar errores
# Entrar en etc/php82/php.ini
# Linea 508
# display errors = On
# reiniciar servicio php.ini

apk add php82-session