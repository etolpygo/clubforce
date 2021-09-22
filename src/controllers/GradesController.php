<?php
require 'models/Grade.php';

class GradesController {

    #[Route("/grades/", methods: ["POST"])]
    public function index(): array
    { 
        $grades = array();

        $data = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() === JSON_ERROR_NONE) {
            foreach($data as $record) {
                if (isset($record['name']) && isset($record['grade'])) {
                    $grade = new Grade((string)$record['name'], (int)$record['grade']);
                    $grades[] = $grade;
                }
                // otherwise, skip it
            }
            $result = array();
            foreach($grades as $grade) {
                $result[] = $grade->to_array();
            }
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = json_encode($result);
        }
        else { // error parsing json
            $response['status_code_header'] = 'HTTP/1.1 400 Bad Request';
        }

        return $response;
    }

}