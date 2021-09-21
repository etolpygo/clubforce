<?php

require 'controllers/GradesController.php';

header("Access-Control-Allow-Origin: http://localhost:8000/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

if ($uri[1] == 'grades') {
    
    $controller = new GradesController();

    $name = isset($uri[2]) ? preg_replace( '/[\W]/', '', $uri[2]) : '';

    $response = (strlen($name) > 0) ? $controller->get($name) : $controller->index();

}
else {
    header("HTTP/1.1 404 Not Found");
    exit();
}

header($response['status_code_header']);
echo($response['body'] ?? '');
