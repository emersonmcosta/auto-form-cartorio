docker-compose up -d --build --force-recreate
docker exec -i app_pactual cp -r .env.example .env
docker exec -i app_pactual chmod 777 -R storage
docker exec -i app_pactual composer install
docker exec -i app_pactual php artisan make:session-table
docker exec -i app_pactual php artisan migrate
docker exec -i app_pactual php artisan key:generate
docker exec -i app_pactual_mysql mysql -u root -proot pactual < bkp.sql