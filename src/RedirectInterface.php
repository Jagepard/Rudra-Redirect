<?php

declare(strict_types=1);

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
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container);

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
