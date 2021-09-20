<?php

class RawGradesController {

    #[Route("/grades/", methods: ["GET"])]
    public function index() { 
        $data = array(
            array("name" => "John", "grade" => 53),
            array("name" => "Jane", "grade" => 68),
            array("name" => "Emma", "grade" => 32),
            array("name" => "Sophia", "grade" => 39)
        );
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($data);
        return $response;
    }

}