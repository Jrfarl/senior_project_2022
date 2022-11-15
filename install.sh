sudo apt-get install mysql-server -y

sudo apt install software-properties-common apt-transport-https -y

sudo add-apt-repository ppa:ondrej/php -y

sudo apt update && apt upgrade -y 

sudo apt install php8.0 php8.0-common libapache2-mod-php8.0 php8.0-cli php8.0-mysql -y

mv * /var/www/html/

cd /var/www/html 

rm -r ~/senior_project_2022/ index.html 
