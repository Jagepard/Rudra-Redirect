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
     * Redirects to the specified destination
     * --------------------------------------
     * Перенаправляет по указанному адресату
     *
     * @param  string $url
     * @param  string $type
     * @param  string $code
     * @return void
     */
    public function run(string $url = "", string $type = "", string $code = ""): void;

    /**
     * Sets HTTP response status code
     * ------------------------------
     * Устанавливает код состояния ответа HTTP
     *
     * @param  string $code
     * @return void
     */
    public function responseCode(string $code): void;
}
