<?php

require 'controllers/GradesController.php';

header("Access-Control-Allow-Origin: http://localhost:8000/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$requestMethod = $_SERVER["REQUEST_METHOD"]; 
if ($requestMethod !== 'POST') {
    http_response_code(400);
    echo "Only POST method is allowed";
    exit();
} 

if ($uri[1] == 'grades') {
    
    $controller = new GradesController();

    $response = $controller->index();

}
else {
    header("HTTP/1.1 404 Not Found");
    exit();
}

header($response['status_code_header']);
echo($response['body'] ?? '');
