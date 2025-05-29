<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

namespace Rudra\Redirect;

interface RedirectInterface
{
    public function run(string $url = "", string $type = "", string $code = ""): void;
    public function responseCode(string $code): void;
}
