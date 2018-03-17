Optime Test
========================

Desarrollado como prueba de conocimientos técnicos

Instalación
--------------
+ git clone https://github.com/jorgadan/optimeTest
+ cd optimeTest
+ composer install
+ php app/console doctrine:database:create
+ php app/console doctrine:schema:create
+ sudo chmod -R 777 app/logs app/cache
+ php app/console cache:clear
+ sudo chmod -R 777 app/logs app/cache