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

use Rudra\Container\Traits\FacadeTrait;

/**
 * @method static void run(string $url = "", string $type = "", string $code = "302")
 * @method static void responseCode(string $code)
 *
 * @see Redirect
 */
final class RedirectFacade
{
    use FacadeTrait;
}
