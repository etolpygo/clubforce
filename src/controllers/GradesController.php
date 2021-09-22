<?php
require 'models/Grade.php';

class GradesController {

    #[Route("/grades/", methods: ["POST"])]
    public function index(): array
    { 
        $grades = array();

        $data = json_decode(file_get_contents('php://input'), true);
        foreach($data as $record) {
            $grade = new Grade($record['name'], (int)$record['grade']);
            $grades[] = $grade;
        }

        $result = array();
        foreach($grades as $grade) {
            $result[] = $grade->to_array();
        }

        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

}