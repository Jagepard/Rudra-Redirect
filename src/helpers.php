<?php

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
 */

use Rudra\Redirect\RedirectFacade;

if (!function_exists('redirect')) {
    function redirect(string $url = "", string $type = "", string $code = "302"): void
    {
        RedirectFacade::run($url, $type, $code);
    }
}
