<?php

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
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
