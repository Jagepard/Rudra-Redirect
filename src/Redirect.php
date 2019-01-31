<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;

use Rudra\Interfaces\ContainerInterface;
use Rudra\Interfaces\RedirectInterface;
use Rudra\ExternalTraits\SetContainerTrait;

/**
 * Class Redirect
 * @package Rudra
 */
class Redirect implements RedirectInterface
{

    use SetContainerTrait;

    /**
     * @var string
     */
    protected $env;
    /**
     * @var string
     */
    protected $url;
    /**
     * @var array
     */
    public $codeMessage = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',            // RFC2518
        103 => 'Early Hints',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',          // RFC4918
        208 => 'Already Reported',      // RFC5842
        226 => 'IM Used',               // RFC3229
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',    // RFC7238
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
        418 => 'I\'m a teapot',                                               // RFC2324
        421 => 'Misdirected Request',                                         // RFC7540
        422 => 'Unprocessable Entity',                                        // RFC4918
        423 => 'Locked',                                                      // RFC4918
        424 => 'Failed Dependency',                                           // RFC4918
        425 => 'Too Early',                                                   // RFC-ietf-httpbis-replay-04
        426 => 'Upgrade Required',                                            // RFC2817
        428 => 'Precondition Required',                                       // RFC6585
        429 => 'Too Many Requests',                                           // RFC6585
        431 => 'Request Header Fields Too Large',                             // RFC6585
        451 => 'Unavailable For Legal Reasons',                               // RFC7725
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',                                     // RFC2295
        507 => 'Insufficient Storage',                                        // RFC4918
        508 => 'Loop Detected',                                               // RFC5842
        510 => 'Not Extended',                                                // RFC2774
        511 => 'Network Authentication Required',                             // RFC6585
    ];
    /**
     * @var array
     */
    protected $redirectType = [
        'full'   => 'Location:',
        'basic'  => 'Location: http://',
        'secure' => 'Location: https://'
    ];

    /**
     * Redirect constructor.
     * @param ContainerInterface $container
     * @param string             $url
     * @param string             $env
     */
    public function __construct(ContainerInterface $container, string $url, string $env)
    {
        $this->env       = $env;
        $this->url       = $url;
        $this->container = $container;
    }

    /**
     * @param string $url
     * @param string $type
     * @param string $code
     */
    public function run(string $url = '', string $type = '', string $code = '302'): void
    {
        $this->responseCode($code);
        $this->redirectTo($url, $type);
        ('test' == $this->env()) ?: exit; // @codeCoverageIgnore
    }

    /**
     * @param string $code
     */
    public function responseCode(string $code): void
    {
        $protocol = $this->container()->getServer('SERVER_PROTOCOL') ?? 'HTTP/1.0';
        header($protocol . ' ' . $code . ' ' . $this->getCodeMessage($code));
    }

    /**
     * @param $url
     * @param $type
     */
    protected function redirectTo(string $url, string $type): void
    {
        header($this->getRedirectType($type) . $url);
    }

    /**
     * @param string $code
     * @return string
     */
    protected function getCodeMessage(string $code): string
    {
        if (array_key_exists($code, $this->codeMessage)) {
            return $this->codeMessage[$code];
        }

        exit('Unknown http status code "' . htmlentities($code) . '"'); // @codeCoverageIgnore
    }

    /**
     * @param string $type
     * @return string
     */
    protected function getRedirectType(string $type): string
    {
        if (array_key_exists($type, $this->redirectType)) {
            return $this->redirectType[$type];
        }

        return 'Location:' . $this->url() . '/';
    }

    /**
     * @return string
     */
    public function url(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function env(): string
    {
        return $this->env;
    }
}
