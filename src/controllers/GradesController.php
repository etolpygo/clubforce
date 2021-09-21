<?php
require 'models/Grade.php';

class GradesController {

    private $grades;

    public function __construct()
    {
        $response = file_get_contents('request.json');
        $response = json_decode($response);

        foreach($response as $record) {
            $grade = new Grade($record->name, (int)$record->grade);
            $this->grades[] = $grade;
        }
    }

    #[Route("/grades/", methods: ["GET"])]
    public function index() { 

        $result = array();
        foreach($this->grades as $grade) {
            $result[] = $grade->to_array();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }


    #[Route("/grades/{name}", methods: ["GET"])]
    public function get($name) { 

        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';

        foreach($this->grades as $grade) {
            if ($grade->getName() == $name) {
                $result = $grade->to_array();
                $response['status_code_header'] = 'HTTP/1.1 200 OK';
                $response['body'] = json_encode($result);
                break;
            }
        }

        return $response;
     }



}