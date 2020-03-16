# HSE

Start By cloning the project
cd HSE
composer install
edit your ".env" file adding your mysql login and password


php bin/console doctrine:database:create

delete all migration files

php bin/console doctrine:migrations:dump-schema

php bin/console doctrine:migrations:migrate

symfony serve

you should be good to go

