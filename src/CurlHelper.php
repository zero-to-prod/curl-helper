<?php

namespace Zerotoprod\CurlHelper;

/**
 * A helper for curl responses.
 *
 * @link https://github.com/zero-to-prod/curl-helper
 */
class CurlHelper
{
    /**
     * Returns the headers of a request as an array.
     *
     * @link https://github.com/zero-to-prod/curl-helper
     */
    public static function parseHeaders(string $response, int $header_size): array
    {
        $headers = [];
        foreach (explode("\r\n", substr($response, 0, $header_size)) as $line) {
            if ($line && strpos($line, ':') !== false) {
                [$key, $value] = explode(':', $line, 2);
                $headers[ucwords(strtolower($key), "-")] = trim($value);
            }
        }

        return $headers;
    }
}