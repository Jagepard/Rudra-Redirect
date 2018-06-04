<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra\Interfaces;

/**
 * Interface RedirectInterface
 * @package Rudra\Interfaces
 */
interface RedirectInterface
{

    /**
     * RedirectInterface constructor.
     * @param ContainerInterface $container
     * @param string             $appUrl
     * @param string             $env
     */
    public function __construct(ContainerInterface $container, string $appUrl, string $env);

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
