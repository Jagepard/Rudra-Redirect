<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Redirect;

interface RedirectInterface
{
    /**
     * Executes a redirection with the specified URL, type, and HTTP status code.
     * The method sets the response code and performs the redirection.
     * -------------------------
     * Выполняет перенаправление с указанным URL, типом и HTTP-кодом состояния.
     * Метод устанавливает код ответа и выполняет перенаправление.
     *
     * @param  string $url
     * @param  string $type
     * @param  string $code
     * @return void
     */
    public function run(string $url = "", string $type = "", string $code = ""): void;

    /**
     * Sets the HTTP response code with the specified status code.
     * -------------------------
     * Устанавливает HTTP-код ответа с указанным кодом состояния.
     *
     * @param  string $code
     * @return void
     */
    public function responseCode(string $code): void;
}
