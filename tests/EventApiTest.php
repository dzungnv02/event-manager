<?php
require dirname(__DIR__).'/vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class EventApiTest extends TestCase
{
    private $http;
    private $mockHandler;

    public function setUp(): void
    {
        parent::setUp();
        $this->http = new Client(['base_uri' => 'event_manager_nginx/api/']);
    }

    public function testInsertUpdateAndDeleteEvent()
    {
        $title = "Event Testing ". uniqid();
        $aryInput = [
            'title' => $title,
            'start' => date('Y-m-d 10:00:00'),
            'end' => date('Y-m-d 12:00:00'),
            'reminder' => (int)false
        ];
        
        $response = $this->http->request('POST', 'event', ['json' => $aryInput]);
        $this->assertEquals(201, $response->getStatusCode());
        $result = json_decode($response->getBody(), true);
        $insertedId = (int)$result['NEW_ID'];

        $this->assertArrayHasKey('RESULT', $result);
        $this->assertArrayHasKey('NEW_ID', $result);
        $this->assertEquals('OK', $result['RESULT']);
        $this->assertIsNumeric($result['NEW_ID']);
        $this->assertGreaterThan(0, (int)$result['NEW_ID']);


        $response = $this->http->request('GET', 'event/'.$insertedId);
        $this->assertEquals(200, $response->getStatusCode());
        $result = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('event_id', $result);
        $this->assertArrayHasKey('title', $result);
        $this->assertArrayHasKey('start', $result);
        $this->assertArrayHasKey('end', $result);
        $this->assertArrayHasKey('reminder', $result);
        
        $this->assertEquals($insertedId, $result['event_id']);
        $this->assertEquals($title, $result['title']);
        $this->assertEquals($aryInput['start'], $result['start']);
        $this->assertEquals($aryInput['end'], $result['end']);
        $this->assertEquals($aryInput['reminder'], $result['reminder']);


        $title = "Event Testing update ". uniqid();
        $aryInput = [
            'title' => $title,
            'start' => date('Y-m-d 15:00:00'),
            'end' => date('Y-m-d 17:00:00'),
            'reminder' => (int)true
        ];
        $response = $this->http->request('POST', 'event/'.$insertedId, ['json' => $aryInput]);
        $this->assertEquals(200, $response->getStatusCode());

        $response = $this->http->request('GET', 'event/'.$insertedId);
        $this->assertEquals(200, $response->getStatusCode());
        $result = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('event_id', $result);
        $this->assertArrayHasKey('title', $result);
        $this->assertArrayHasKey('start', $result);
        $this->assertArrayHasKey('end', $result);
        $this->assertArrayHasKey('reminder', $result);
        
        $this->assertEquals($insertedId, $result['event_id']);
        $this->assertEquals($title, $result['title']);
        $this->assertEquals($aryInput['start'], $result['start']);
        $this->assertEquals($aryInput['end'], $result['end']);
        $this->assertEquals($aryInput['reminder'], $result['reminder']);


        $response = $this->http->request('DELETE', 'event/'.$insertedId);
        $this->assertEquals(200, $response->getStatusCode());
        $result = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('RESULT', $result);
        $this->assertArrayHasKey('AFFECTED', $result);
        $this->assertEquals('OK', $result['RESULT']);
        $this->assertEquals(1, $result['AFFECTED']);

    }

    public function testGetAllEvent()
    {
        $response = $this->http->request('GET', 'events');

        $this->assertEquals(200, $response->getStatusCode());

        $contentType = $response->getHeaders()["Content-Type"][0];
        $this->assertEquals("application/json", $contentType);

        $result = json_decode($response->getBody(), true);
        $this->assertGreaterThanOrEqual(1, count($result));
    }


    public function tearDown(): void 
    {
        parent::tearDown();        
    }
}