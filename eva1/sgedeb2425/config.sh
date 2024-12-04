#!/bin/bash
PHPVER=8.2

echo ###########################
echo  Actualizando el servidor
echo ############################

apt-get update > /dev/null 2>&1
# apt-get dist-upgrade -y > /dev/null 2>&1

# Install essentials
apt-get -y install build-essential > /dev/null 2>&1
apt-get -y install binutils-doc > /dev/null 2>&1
apt-get -y install git > /dev/null 2>&1 
apt-get -y install vim > /dev/null 2>&1
apt-get -y install curl > /dev/null 2>&1
apt-get -y install software-properties-common > /dev/null 2>&1
apt-get -y install vagrant-sshfs > /dev/null 2>&1
apt-get -y install dos2unix > /dev/null 2>&1

echo ##################################
echo  Instalando apache
echo ####################################
apt-get -y install apache2  > /dev/null 2>&1
apt-get -y install php-curl php-gd php-xml phpunit  > /dev/null 2>&1
apt-get -y install php-zip  > /dev/null 2>&1
apt-get -y install php libapache2-mod-php php-cli php-mysql > /dev/null 2>&1
a2enmod rewrite   > /dev/null 2>&1
systemctl restart apache2  > /dev/null 2>&1

echo ##############################################
echo # Install Composer
echo ##############################################

apt-get -y install composer  > /dev/null 2>&1
echo "=============================================================="
echo "Configurando  xDebug (idekey = PHP_STORM) --"
echo "Opciones para trabajar con Laravel"
echo "Cambiar estas opciones de = no a = yes para que funcione el xdebug con PHPStorm"
echo "=============================================================="

echo "No es necesario"
# sudo tee -a /etc/php/$PHPVER/mods-available/xdebug.ini << END
# 
# xdebug.idekey=PHP_STORM
# xdebug.mode=develop,debug,trace
# xdebug.client_host=10.0.2.2
# xdebug.client_port=9003
# xdebug.scream = yes
# xdebug.show_error_trace = yes
# xdebug.show_exception_trace = yes
# xdebug.show_local_vars = yes
# xdebug.start_with_request = yes
# END

sed -i "s/AllowOverride None/AllowOverride All/g" /etc/apache2/apache2.conf

# ln -fs /vagrant/public /var/www/html

sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php/$PHPVER/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php/$PHPVER/apache2/php.ini

sed -i "s/post_max_size = .*/post_max_size = 250M/" /etc/php/$PHPVER/apache2/php.ini
sed -i "s/upload_max_filesize = .*/upload_max_filesize = 250M/" /etc/php/$PHPVER/apache2/php.ini
sed -i "s/max_execution_time = .*/max_execution_time = 60/" /etc/php/$PHPVER/apache2/php.ini

# Restart Apache service
echo "Reiniciamos Apache2"
systemctl restart apache2  > /dev/null 2>&1


echo ####################################################
echo "Instalando SAMBA ...."
echo ####################################################

apt-get install -y samba  > /dev/null 2>&1
mkdir /home/vagrant/laravel > /dev/null 2>&1
chown -R vagrant.vagrant /home/vagrant/laravel  > /dev/null 2>&1
(echo vagrant; echo vagrant) | smbpasswd -s -a vagrant  > /dev/null 2>&1

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

systemctl restart nmbd smbd  > /dev/null 2>&1


 echo ==================================
 echo INSTALAndo nodejs
 echo ==================================

 ## Instalar nodejs y npm para instalaciones de elementos auxiliares de Laravel
# curl -fsSL https://deb.nodesource.com/setup_current.x | sudo -E bash -  > /dev/null 2>&1
 curl -fsSL https://deb.nodesource.com/setup_20.x | sudo bash - > /dev/null 2>&1
 apt-get update  > /dev/null 2>&1
 apt-get -y install nodejs gcc g++ make  > /dev/null 2>&1


echo =========================
echo  Instalacion de Docker
echo =========================
apt-get -y install docker.io docker-compose   > /dev/null 2>&1
adduser vagrant docker   > /dev/null 2>&1

echo Creamos la red Docker para MySQL
docker network create --subnet=172.29.0.0/16 --gateway=172.29.0.1 netlamp  > /dev/null 2>&1

echo Creamos los contenedores
echo "Instalando MySQL"
docker run -dit \
	--network netlamp \
	-p 3306:3306 \
	--hostname mysqlserver \
	--name mysqlserver \
	-e MYSQL_ROOT_PASSWORD=toor \
	-v mysql:/var/lib/mysql \
	--restart unless-stopped \
mysql:5 > /dev/null 2>&1

echo "Instalando PHPMyAdmin"
docker run -dit \
	--network netlamp \
	--name phpmyadmin \
	--hostname phpmyadmin \
	-e PMA_HOST=mysqlserver \
	-p 18080:80 \
	--restart unless-stopped \
phpmyadmin > /dev/null 2>&1

echo "Instalando mailhog"
docker container run -dit \
--network netlamp \
-e "MH_STORAGE=maildir" \
-v mailhog:/maildir \
--hostname mailhog \
--name mailhog \
--restart=unless-stopped \
-p 1025:1025 -p 8025:8025 \
mailhog/mailhog 2>&1

echo "Instalando soketi"
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
quay.io/soketi/soketi:1.4-16-debian 2>&1


 echo ==================================
 echo
 echo
 echo FIN DE LA INSTALACIoN
 echo Recuerda que ....
 echo USUARIO = vagrant
 echo PASS = vagrant
 echo ==================================
