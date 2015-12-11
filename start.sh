docker-compose up -d
composer install -vvv
sudo mkdir -p web/upload/ app/data/export app/data/exportPdf app/data/session app/data/importCsv app/data/user
sudo setfacl -dR -m u:www-data:rwx -m u:`whoami`:rwx web/upload/ app/cache app/logs app/data/
sudo setfacl -R -m u:www-data:rwx -m u:`whoami`:rwx web/upload/ app/cache app/logs app/data/
