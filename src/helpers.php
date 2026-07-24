<?php declare(strict_types=1);

/**
 * This Source Code Form is subject to the terms of the Mozilla Public
 * License, v. 2.0. If a copy of the MPL was not distributed with this
 * file, You can obtain one at https://mozilla.org/MPL/2.0/.
 *
 * @author  Korotkov Danila (Jagepard) <jagepard@yandex.ru>
 * @license https://mozilla.org/MPL/2.0/  MPL-2.0
 */

use Rudra\Redirect\RedirectFacade;

if (!function_exists('redirect')) {
    function redirect(string $url = '', int $code = 302): void
    {
        RedirectFacade::run($url, $code);
    }
}

if (!function_exists('back')) {
    function back(string $fallback = '/', int $code = 302): void
    {
        RedirectFacade::back($fallback, $code);
    }
}
