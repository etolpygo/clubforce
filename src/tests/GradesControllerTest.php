<?php 
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

/**
 * @covers GradesController
 */
final class GradesControllerTest extends TestCase
{   
    private $http_client;
    private $request_body;


    protected function setUp(): void
    {
        // setup Http Client for testing requests within the container
        $this->http_client = new GuzzleHttp\Client(['base_uri' => '127.0.0.1/']);

        // a sample good request body
        $this->request_body = [
            [ 'name' => 'John', 'grade' => 53 ],
            [ 'name' => 'Jane', 'grade' => 68 ],
            [ 'name' => 'Emma', 'grade' => 32 ],
            [ 'name' => 'Sophia', 'grade' => 39 ]
        ];
    }

    protected function tearDown(): void
    {
        $this->http_client = null;
    }

    public function testBadRequests(): void
    {
        // test wrong request type (GET)
        try {
            $response = $this->http_client->request('GET', 'grades');   
        }
        catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $this->assertEquals(400, $response->getStatusCode());

            $responseBodyAsString = $response->getBody()->getContents();
            $this->assertEquals("Only POST method is allowed", $responseBodyAsString);
        }

        // test wrong request type (PUT)
        try {
            $response = $this->http_client->request(
                'PUT', 
                'grades', 
                ['json' => $this->request_body]
            );   
        }
        catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $this->assertEquals(400, $response->getStatusCode());

            $responseBodyAsString = $response->getBody()->getContents();
            $this->assertEquals("Only POST method is allowed", $responseBodyAsString);
        }

        // test posting to wrong URL
        try {
            $response = $this->http_client->request('POST', 'error');   
        }
        catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $this->assertEquals(404, $response->getStatusCode());
        }

        // test invalid json
        try {
            $response = $this->http_client->request(
                'POST', 
                'grades', 
                ['json' => "invalid json string"]
            );   
        }
        catch (GuzzleHttp\Exception\ClientException $e) {
            $response = $e->getResponse();
            $this->assertEquals(400, $response->getStatusCode());
        }
    }

    // test a valid request
    public function testPOSTRequest(): void
    {  
        $response = $this->http_client->request(
            'POST', 
            'grades', 
            ['json' => $this->request_body]
        );

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json; charset=UTF-8", $contentType);

        $responseBodyAsString = $response->getBody()->getContents();

        $this->assertTrue(str_contains($responseBodyAsString, '{"name":"John","grade":55,"pass":true}'));
        $this->assertTrue(str_contains($responseBodyAsString, '{"name":"Jane","grade":70,"pass":true}'));
        $this->assertTrue(str_contains($responseBodyAsString, '{"name":"Emma","grade":30,"pass":false}'));
        $this->assertTrue(str_contains($responseBodyAsString, '{"name":"Sophia","grade":40,"pass":true}'));

    }

}