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
    public array $codeMessage = [
        100 => "Continue",
        101 => "Switching Protocols",
        102 => "Processing",            // RFC2518
        103 => "Early Hints",
        200 => "OK",
        201 => "Created",
        202 => "Accepted",
        203 => "Non-Authoritative Information",
        204 => "No Content",
        205 => "Reset Content",
        206 => "Partial Content",
        207 => "Multi-Status",          // RFC4918
        208 => "Already Reported",      // RFC5842
        226 => "IM Used",               // RFC3229
        300 => "Multiple Choices",
        301 => "Moved Permanently",
        302 => "Found",
        303 => "See Other",
        304 => "Not Modified",
        305 => "Use Proxy",
        307 => "Temporary Redirect",
        308 => "Permanent Redirect",    // RFC7238
        400 => "Bad Request",
        401 => "Unauthorized",
        402 => "Payment Required",
        403 => "Forbidden",
        404 => "Not Found",
        405 => "Method Not Allowed",
        406 => "Not Acceptable",
        407 => "Proxy Authentication Required",
        408 => "Request Timeout",
        409 => "Conflict",
        410 => "Gone",
        411 => "Length Required",
        412 => "Precondition Failed",
        413 => "Payload Too Large",
        414 => "URI Too Long",
        415 => "Unsupported Media Type",
        416 => "Range Not Satisfiable",
        417 => "Expectation Failed",
        418 => "I\"m a teapot",                                               // RFC2324
        421 => "Misdirected Request",                                         // RFC7540
        422 => "Unprocessable Entity",                                        // RFC4918
        423 => "Locked",                                                      // RFC4918
        424 => "Failed Dependency",                                           // RFC4918
        425 => "Too Early",                                                   // RFC-ietf-httpbis-replay-04
        426 => "Upgrade Required",                                            // RFC2817
        428 => "Precondition Required",                                       // RFC6585
        429 => "Too Many Requests",                                           // RFC6585
        431 => "Request Header Fields Too Large",                             // RFC6585
        451 => "Unavailable For Legal Reasons",                               // RFC7725
        500 => "Internal Server Error",
        501 => "Not Implemented",
        502 => "Bad Gateway",
        503 => "Service Unavailable",
        504 => "Gateway Timeout",
        505 => "HTTP Version Not Supported",
        506 => "Variant Also Negotiates",                                     // RFC2295
        507 => "Insufficient Storage",                                        // RFC4918
        508 => "Loop Detected",                                               // RFC5842
        510 => "Not Extended",                                                // RFC2774
        511 => "Network Authentication Required",                             // RFC6585
    ];

    private array $redirectType = [
        "full"   => "Location:",
        "basic"  => "Location: http://",
        "secure" => "Location: https://"
    ];

    /**
     * Executes a redirection with the specified URL, type, and HTTP status code.
     * The method sets the response code and performs the redirection.
     * If the environment is not "test", the script execution is terminated.
     * -------------------------
     * Выполняет перенаправление с указанным URL, типом и HTTP-кодом состояния.
     * Метод устанавливает код ответа и выполняет перенаправление.
     * Если окружение не является "test", выполнение скрипта завершается.
     *
     * @param  string $url
     * @param  string $type
     * @param  string $code
     * @return void
     */
    public function run(string $url = "", string $type = "", string $code = "302"): void
    {
        $this->responseCode($code);
        $this->redirectTo($url, $type);

        ("test" === Rudra::config()->get("environment")) ?: exit; // @codeCoverageIgnore
    }

    /**
     * Sets the HTTP response code with the specified status code.
     * The method constructs the header using the server protocol and the provided code.
     * -------------------------
     * Устанавливает HTTP-код ответа с указанным кодом состояния.
     * Метод формирует заголовок, используя протокол сервера и предоставленный код.
     *
     * @param  string $code
     * @return void
     */
    public function responseCode(string $code): void
    {
        $protocol = Request::server()->has("SERVER_PROTOCOL")
            ? Request::server()->get("SERVER_PROTOCOL")
            : "HTTP/1.0";
        header($protocol . ' ' . $code . ' ' . $this->getCodeMessage($code));
    }

    /**
     * Performs the redirection to the specified URL with the given type.
     * The method sets the appropriate header for redirection.
     * -------------------------
     * Выполняет перенаправление на указанный URL с заданным типом.
     * Метод устанавливает соответствующий заголовок для перенаправления.
     *
     * @param  string $url
     * @param  string $type
     * @return void
     */
    private function redirectTo(string $url, string $type): void
    {
        header($this->getRedirectType($type) . $url);
    }

    /**
     * Retrieves the message associated with the given HTTP status code.
     * If the code is not found, the script terminates with an error message.
     * -------------------------
     * Извлекает сообщение, связанное с указанным HTTP-кодом состояния.
     * Если код не найден, выполнение скрипта завершается с сообщением об ошибке.
     *
     * @param  string $code
     * @return string
     */
    private function getCodeMessage(string $code): string
    {
        if (array_key_exists($code, $this->codeMessage)) {
            return $this->codeMessage[$code];
        }

        exit("Unknown http status code " . htmlentities($code)); // @codeCoverageIgnore
    }

    /**
     * Retrieves the redirection type header based on the specified type.
     * If the type is not found, a default redirection to the base URL is returned.
     * -------------------------
     * Извлекает заголовок типа перенаправления на основе указанного типа.
     * Если тип не найден, возвращается перенаправление по умолчанию на базовый URL.
     *
     * @param  string $type
     * @return string
     */
    private function getRedirectType(string $type): string
    {
        if (array_key_exists($type, $this->redirectType)) {
            return $this->redirectType[$type];
        }

        return "Location:" . Rudra::config()->get("url") . "/";
    }
}
