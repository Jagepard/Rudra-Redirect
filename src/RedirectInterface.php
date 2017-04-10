<?php

declare(strict_types = 1);

/**
 * Date: 07.04.17
 * Time: 12:11
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;


/**
 * Interface RedirectInterface
 *
 * @package Rudra
 */
interface RedirectInterface
{

    /**
     * RedirectInterface constructor.
     *
     * @param ContainerInterface $container
     * @param string     $config
     */
    public function __construct(ContainerInterface $container, string $config);

    /**
     * @param string $url
     * @param string $external
     * @param string $header
     *
     * Перенаправляет в соответствии с указанными параметрами
     * $external - для перенаправления на внешние адреса,
     * если $external == 1, то http://domain.com
     * если $external == 2, то https://domain.com
     * если параметр $external, не передан, то переадресация
     * происходит по внутренним адресам приложения, при этом
     * если значение $url == 'self', то перенаправление будет
     * произведено на текущуй метод контроллера (текущуй адрес)
     */
    public function run(string $url = '', string $external = '', string $header = '');

    /**
     * @param string $code
     */
    public function responseCode($code): void;
}
