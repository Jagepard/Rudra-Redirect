<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 */

namespace Rudra\Redirect;

interface RedirectInterface
{
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
