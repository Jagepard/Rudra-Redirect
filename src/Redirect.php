<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

namespace Rudra\Redirect;

use Rudra\Container\Facades\Rudra;
use Rudra\Container\Facades\Request;

class Redirect implements RedirectInterface
{
    public const array CODE_MESSAGES = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing', // RFC2518
        103 => 'Early Hints',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',     // RFC4918
        208 => 'Already Reported', // RFC5842
        226 => 'IM Used',          // RFC3229
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect', // RFC7238
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => "I'm a teapot",          // RFC2324
        421 => 'Misdirected Request',   // RFC7540
        422 => 'Unprocessable Entity',  // RFC4918
        423 => 'Locked',                // RFC4918
        424 => 'Failed Dependency',     // RFC4918
        425 => 'Too Early',             // RFC-ietf-httpbis-replay-04
        426 => 'Upgrade Required',      // RFC2817
        428 => 'Precondition Required', // RFC6585
        429 => 'Too Many Requests',     // RFC6585
        431 => 'Request Header Fields Too Large', // RFC6585
        451 => 'Unavailable For Legal Reasons',   // RFC7725
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates', // RFC2295
        507 => 'Insufficient Storage',    // RFC4918
        508 => 'Loop Detected',           // RFC5842
        510 => 'Not Extended',            // RFC2774
        511 => 'Network Authentication Required', // RFC6585
    ];

    /**
     * Executes a redirection with the specified URL, type, and HTTP status code.
     * The method sets the response code and performs the redirection.
     * If the environment is not "test", the script execution is terminated.
     */
    #[\Override]
    public function run(string $url = '', int $code = 302): void
    {
        $this->responseCode($code);

        if (!str_starts_with($url, 'http://') && !str_starts_with($url, 'https://')) {
            $url = rtrim(Rudra::config()->get('url'), '/') . '/' . ltrim($url, '/');
        }

        header("Location: {$url}", true, $code);

        if (Rudra::config()->get('environment') !== 'test') {
            exit; // @codeCoverageIgnore
        }
    }

    /**
     * Sets the HTTP response code with the specified status code.
     * The method constructs the header using the server protocol and the provided code.
     */
    #[\Override]
    public function responseCode(int $code): void
    {
        $protocol = Request::server()->has('SERVER_PROTOCOL')
            ? Request::server()->get('SERVER_PROTOCOL')
            : 'HTTP/1.0';
            
        header("{$protocol} {$code} " . $this->getCodeMessage($code));
    }

    /**
     * Redirect to the previous page.
     */
    public function back(string $fallback = '/', int $code = 302): void
    {
        $referer = Request::server()->has('HTTP_REFERER') 
            ? Request::server()->get('HTTP_REFERER') 
            : null;

        $this->run($referer ?: $fallback, $code);
    }

    /**
     * Retrieves the message associated with the given HTTP status code.
     * If the code is not found, the script terminates with an error message.
     * 
     * @throws \InvalidArgumentException
     */
    private function getCodeMessage(int $code): string
    {
        if (array_key_exists($code, self::CODE_MESSAGES)) {
            return self::CODE_MESSAGES[$code];
        }

        throw new \InvalidArgumentException("Unknown HTTP status code: {$code}");
    }
}
