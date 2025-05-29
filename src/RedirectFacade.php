<?php

declare(strict_types=1);

/**
 * @author  : Jagepard <jagepard@yandex.ru">
 * @license https://mit-license.org/ MIT
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
