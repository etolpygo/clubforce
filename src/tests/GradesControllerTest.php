<?php 
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class GradesControllerTest extends TestCase
{   
    private $http_client;

    protected function setUp(): void
    {
        // setup Http Client for testing requests within the container
        $this->http_client = new GuzzleHttp\Client(['base_uri' => '127.0.0.1/']);
    }

    protected function tearDown(): void
    {
        $this->http_client = null;
    }

    public function testBadRequests(): void
    {
        try {
            $response = $this->http_client->request('GET', 'grades');   
        }
        catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            $this->assertEquals("Only POST method is allowed", $responseBodyAsString);
        }
    }

    public function testPOSTRequest(): void
    {  
        $request_body = [
            [ 'name' => 'John', 'grade' => 53 ],
            [ 'name' => 'Jane', 'grade' => 68 ],
            [ 'name' => 'Emma', 'grade' => 32 ],
            [ 'name' => 'Sophia', 'grade' => 39 ]
        ];

        $response = $this->http_client->request(
            'POST', 
            'grades', 
            ['json' => $request_body]);

        echo($response->getStatusCode());

        $this->assertEquals(200, $response->getStatusCode());
        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json; charset=UTF-8", $contentType);

    }

}