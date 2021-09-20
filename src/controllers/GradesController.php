<?php
use models\Grade;

class GradesController {

    private $grades;

    public function __construct()
    {
        $response = file_get_contents('http://example.com/path/to/api/call?param1=5');
        $response = json_decode($response);
        // populate grades
    }

    #[Route("/grades/{name}", methods: ["GET"])]
    public function get($name) { 
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
     }

    #[Route("/grades/", methods: ["GET"])]
    public function index() { 
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
    }

}