<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Zerotoprod\CurlHelper\CurlHelper;

class ParseHeadersTest extends TestCase
{
    /** @test */
    public function parseSingleHeader(): void
    {
        $response = "Content-Type: application/json\r\n\r\nbody";
        $headerSize = strlen("Content-Type: application/json\r\n\r\n");

        $headers = CurlHelper::parseHeaders($response, $headerSize);

        $this->assertCount(1, $headers);
        $this->assertEquals('application/json', $headers['Content-Type']);
    }

    /** @test */
    public function parseMultipleHeaders(): void
    {
        $response = "Content-Type: application/json\r\nContent-Length: 100\r\n\r\nbody";
        $headerSize = strlen("Content-Type: application/json\r\nContent-Length: 100\r\n\r\n");

        $headers = CurlHelper::parseHeaders($response, $headerSize);

        $this->assertCount(2, $headers);
        $this->assertEquals('application/json', $headers['Content-Type']);
        $this->assertEquals('100', $headers['Content-Length']);
    }

    /** @test */
    public function parseHeadersWithWhitespace(): void
    {
        $response = "Content-Type:    application/json   \r\nAccept:   */*  \r\n\r\nbody";
        $headerSize = strlen("Content-Type:    application/json   \r\nAccept:   */*  \r\n\r\n");

        $headers = CurlHelper::parseHeaders($response, $headerSize);

        $this->assertEquals('application/json', $headers['Content-Type']);
        $this->assertEquals('*/*', $headers['Accept']);
    }

    /** @test */
    public function parseEmptyResponse(): void
    {
        $response = "";
        $headerSize = 0;

        $headers = CurlHelper::parseHeaders($response, $headerSize);

        $this->assertEmpty($headers);
    }

    /** @test */
    public function parseNoValidHeaders(): void
    {
        $response = "Invalid Line\r\nAnother Invalid Line\r\n\r\nbody";
        $headerSize = strlen("Invalid Line\r\nAnother Invalid Line\r\n\r\n");

        $headers = CurlHelper::parseHeaders($response, $headerSize);

        $this->assertEmpty($headers);
    }

    /** @test */
    public function parseHeadersWithColonsInValues(): void
    {
        $response = "Link: <https://api.example.com>; rel=\"next\": version 2\r\n\r\nbody";
        $headerSize = strlen("Link: <https://api.example.com>; rel=\"next\": version 2\r\n\r\n");

        $headers = CurlHelper::parseHeaders($response, $headerSize);

        $this->assertEquals('<https://api.example.com>; rel="next": version 2', $headers['Link']);
    }

    /** @test */
    public function headersCaseSensitivity(): void
    {
        $response = "content-type: application/json\r\nContent-Type: text/html\r\n\r\nbody";
        $headerSize = strlen("content-type: application/json\r\nContent-Type: text/html\r\n\r\n");

        $headers = CurlHelper::parseHeaders($response, $headerSize);

        // Headers should maintain their exact case and the last one should win
        $this->assertCount(1, $headers);
        $this->assertEquals('text/html', $headers['Content-Type']);
        $this->assertArrayNotHasKey('content-type', $headers);
    }
}