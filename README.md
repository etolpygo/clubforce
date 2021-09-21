`docker-compose up` builds and starts the container
hosted at http://localhost:8000/

`docker exec -t -i php-apache /bin/bash` starts bash inside the running container

`vendor/bin/phpunit tests/ -vvv` in the container, run phpunit tests
