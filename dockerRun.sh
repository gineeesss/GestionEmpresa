#!/bin/bash
echo Borramos contenedores ya preexistentes
docker container stop apachephp phpmyadmin mysqlserver
docker container rm apachephp phpmyadmin mysqlserver

echo Recreamos la red
docker network rm netlamp

docker network create --subnet=172.22.0.0/16 --gateway=172.22.0.1 netlamp

echo Creamos los contenedores

docker container run -dit \
        --network netlamp \
        -p 3306:3306 \
        --hostname mysqlserver \        
        --name mysqlserver \
        -e MYSQL_ROOT_PASSWORD=toor \
        -v /home/vagrant/docker/mysql:/var/lib/mysql \
        --restart unless-stopped \
        mysql:5

docker container run -d \
        --network netlamp \
        --hostname phpmyadmin \
        --name phpmyadmin \
        -e PMA_HOST=mysqlserver \
        -p 8080:80 \
        --restart unless-stopped \
        phpmyadmin

#docker container run -d \
#        --network netlamp \
#        -p 9080:80 \
#        --name apachephp \
#        --hostname apachephp \
#        -v $HOME/web:/var/www/html \
#        --restart unless-stopped \
#        php:7.4-apache
#
#echo Reconfiguramos apachepxe
#docker exec -it apachepxe /usr/local/bin/docker-php-ext-install pdo_mysql
#docker exec -it apachepxe /usr/local/bin/docker-php-ext-install sockets
#
#echo Reiniciamos apachepxe
#docker container restart apachepxe