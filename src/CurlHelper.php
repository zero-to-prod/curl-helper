<?php

namespace Zerotoprod\CurlHelper;

use function str_replace;
use function strtolower;
use function trim;
use function ucwords;

class CurlHelper
{
    /**
     * Returns the headers of a request as an array.
     */
    public static function parseHeaders(string $response, int $header_size): array
    {
        $parsed_headers = [];
        // Split headers into lines and filter out empty lines
        foreach (array_filter(explode("\r\n", substr($response, 0, $header_size))) as $line) {
            $colon_pos = strpos($line, ':');
            if ($colon_pos !== false) {
                // Get the key (before first colon) and value (everything after first colon)
                // Convert to Title-Case for consistency
                $key = str_replace(' ', '-', ucwords(strtolower(trim(substr($line, 0, $colon_pos))), '-'));
                $value = trim(substr($line, $colon_pos + 1));
                $parsed_headers[$key] = $value;
            }
        }

        return $parsed_headers;
    }
}