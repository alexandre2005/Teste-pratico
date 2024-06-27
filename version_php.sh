#!/bin/bash

# Função para imprimir o quadro
print_frame() {
    local width=$(( ${#1} + 4 ))
    local line=$(printf "%-${width}s" "-")
    echo "+$line+"
    echo "| $1 |"
    echo "+$line+"
}

# Imprimir o quadro com o título
print_frame "Escolha a versão do PHP para utilizar:"

# Imprimir as opções
echo "1 - php5.6"
echo "2 - php7.2"
echo "3 - php7.4"
echo "4 - php8.1"
echo "5 - php8.2"
echo "6 - php8.3"

# Ler a opção do usuário
read -p "Selecione uma opção: " opcao

# Verificar se a opção é válida
case $opcao in
    1|2|3|4|5|6)
        # Verificar se o usuário tem permissões de sudo
        if sudo -n true 2>/dev/null; then
            case $opcao in
                1)
                    sudo update-alternatives --set php /usr/bin/php5.6
                    ;;
                2)
                    sudo update-alternatives --set php /usr/bin/php7.2
                    sudo service php7.2-fpm restart
                    ;;
                3)
                    sudo update-alternatives --set php /usr/bin/php7.4
                    sudo service php7.4-fpm restart
                    ;;
                4)
                    sudo update-alternatives --set php /usr/bin/php8.1
                    ;;
                5)
                    sudo update-alternatives --set php /usr/bin/php8.2
                    sudo service php8.2-fpm restart
                    ;;
				6)
                    sudo update-alternatives --set php /usr/bin/php8.3
                    sudo service php8.3-fpm restart
                    ;;
            esac
        else
            echo "Você não tem permissão para executar comandos sudo."
            exit 1
        fi
        ;;
    *)
        echo "Opção inválida."
        exit 1
        ;;
esac

# Imprimir mensagem final
echo -e "Viva o \033[01;32mLinux\033[01;37m!"
php -v
php -i | grep "Loaded Configuration File"
