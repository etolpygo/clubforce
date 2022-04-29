# Clubforce Takehome Test
A simple test API that accepts POST requests containing a list of students' names and grades in json format, and outputs processed grades in json format.

Built using a base PHP8/Apache Docker image with a few additions/modifications. PHPUnit tests can be run inside the container.

## Build
From the repo's root directory, `docker-compose up` builds and starts the container. Initial build takes a while, mostly because of the PHPUnit installation.

## API
Once the container is up and running, requests can be sent via Postman, for example.

The API has the following **one** endpoint: 

    - http://localhost:8000/grades 

It accepts (only) POST requests of grades in json format and outputs processed grades as json (rounded and with pass/not pass info). Invalid json results in a 400 error. Any records not containing `name` and `grade` properties are skipped.

Requests to any other URLs result in a 404 error, or 400 error if any request other than POST is sent.

All HTTP requests are directed through index.php - this is set in Apache configuration.

## Running Tests
`docker exec -t -i php-apache /bin/bash` starts bash inside the running container.

`vendor/bin/phpunit tests/ -vvv` runs PHPUnit tests in the container with verbose output.
