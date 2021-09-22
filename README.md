`docker-compose up` builds and starts the container - takes a while to build, mostly because of phpunit

all HTTP requests are directed through index.php
API has two endpoints: 
    - http://localhost:8000/grades - outputs all processed grades (rounded and with pass info)
    - http://localhost:8000/grades/name - processed grades for named student, if exists, or 404 error.
any other request results in 404 error.

`docker exec -t -i php-apache /bin/bash` starts bash inside the running container

`vendor/bin/phpunit tests/ -vvv` in the container, run phpunit tests

`vendor/bin/phpunit --coverage-text tests/ -vvv` output test coverage results as text
