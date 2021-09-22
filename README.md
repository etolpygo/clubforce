`docker-compose up` builds and starts the container - takes a while to build, mostly because of phpunit

all HTTP requests are directed through index.php
API has the following endpoint: 
    - http://localhost:8000/grades - accepts a POST request of grades json and outputs processed grades as json (rounded and with pass/not pass info)
any other request results in 404 error, or 400 if not a POST request

`docker exec -t -i php-apache /bin/bash` starts bash inside the running container

`vendor/bin/phpunit tests/ -vvv` in the container, run phpunit tests, verbose output
