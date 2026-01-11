#Build container
docker-compose up -d --build --force-recreate
#Config project
docker exec -i totem_app cp -r .env.example .env
docker exec -i totem_app chmod 777 -R storage
docker exec -i totem_app composer install
docker exec -i totem_app php artisan make:session-table
docker exec -i totem_app php artisan migrate
docker exec -i totem_app php artisan key:generate
docker exec -i totem_app php artisan optimize
docker exec -i totem_app php artisan queue:work 
