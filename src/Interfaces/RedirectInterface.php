<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @copyright Copyright (c) 2019, Jagepard
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Interfaces;

interface RedirectInterface
{
    /**
     * RedirectInterface constructor.
     * @param ContainerInterface $container
     * @param string             $appUrl
     * @param string             $env
     */
    public function __construct(ContainerInterface $container, string $appUrl, string $env);

    /**
     * @param string $url
     * @param string $type
     * @param string $code
     * @return mixed
     */
    public function run(string $url = '', string $type = '', string $code = ''): void;

    /**
     * @param string $code
     */
    public function responseCode(string $code): void;
}
