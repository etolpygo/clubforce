<?php
use models\Grade;

class GradesController {

    private $grades;

    // public function __construct()
    // {
    //     $response = file_get_contents('request.json');
    //     $response = json_decode($response);
    //     // populate grades
    // }

    #[Route("/grades/", methods: ["GET"])]
    public function index() { 

        $response = file_get_contents('request.json');
        $response = json_decode($response);

        var_dump($response );

        // $response['status_code_header'] = 'HTTP/1.1 200 OK';
        // $response['body'] = json_encode($result);
        // return $response;
    }


    #[Route("/grades/{name}", methods: ["GET"])]
    public function get($name) { 
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
     }



}