// создаем файл конфига в ларавеле в контейнере: composer install key:generate migrate db:seed

// sudo docker ps -все запущенные контейнеры 
// sudo docker stop $(sudo docker ps -a -q) -остановить все контейнеры 
// sudo docker rm $(sudo docker ps -a -q) -удалить все контейнеры 
// sudo docker images -список images 
// sudo docker rmi $(sudo docker images -q) -удалить все images 
// sudo docker-compose build -собрать docker образ 
// sudo docker exec -it <container_id> bash - войти в контейнер 
// sudo docker-compose up запустить контейнеры 
// sudo systemctl stop apache2

// php artisan migrate:refresh php artisan db:seed php artisan db:seed