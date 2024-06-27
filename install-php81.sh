#!/bin/sh

## ATUALIZACAO DO REPOSITORIO, DISTRO E APPS PRESENTES
sudo add-apt-repository -y ppa:ondrej/php
sudo apt update && sudo apt upgrade -y
sudo apt -y dist-upgrade
sudo apt full-upgrade -y
sudo apt update
sudo apt  -y install -f
sudo apt autoclean

# 7.1
sudo apt-get install php7.1 php7.1-cli php7.1-common 
sudo apt search php7.1 
sudo apt-get install php7.1-curl php7.1-gd php7.1-json php7.1-mbstring php7.1-intl php7.1-mysql php7.1-xml php7.1-zip php7.1-soap 
sudo apt-get install php7.1-dev

# 7.2
sudo apt-get install -y php7.2-cli php7.2-common php7.2-mysql php7.2-zip php7.2-gd php7.2-mbstring php7.2-curl php7.2-xml php7.2-bcmath php7.2-fpm
sudo apt install php7.2-common php7.2-mysql php7.2-xml php7.2-xmlrpc php7.2-curl php7.2-gd php7.2-imagick php7.2-cli php7.2-dev php7.2-imap php7.2-mbstring php7.2-opcache php7.2-soap php7.2-zip php7.2-redis php7.2-intl -y

# 8.1
sudo apt-get install -y php8.1-cli php8.1-common php8.1-mysql php8.1-zip php8.1-gd php8.1-mbstring php8.1-curl php8.1-xml php8.1-bcmath php8.1-fpm
sudo apt install php8.1-common php8.1-mysql php8.1-xml php8.1-xmlrpc php8.1-curl php8.1-gd php8.1-imagick php8.1-cli php8.1-dev php8.1-imap php8.1-mbstring php8.1-opcache php8.1-soap php8.1-zip php8.1-redis php8.1-intl -y

## 8.2
sudo apt-get install -y php8.2-cli php8.2-common php8.2-mysql php8.2-zip php8.2-gd php8.2-mbstring php8.2-curl php8.2-xml php8.2-bcmath php8.2-fpm
sudo apt install php8.2-common php8.2-mysql php8.2-xml php8.2-xmlrpc php8.2-curl php8.2-gd php8.2-imagick php8.2-cli php8.2-dev php8.2-imap php8.2-mbstring php8.2-opcache php8.2-soap php8.2-zip php8.2-redis php8.2-intl -y

php -v

