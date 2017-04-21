<?php

declare(strict_types = 1);

/**
 * Date: 19.01.16
 * Time: 15:10
 *
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2016, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 */

namespace Rudra;

/**
 * class Redirect
 *
 * @package Rudra
 *          Класс перенаправления url
 */
class Redirect implements RedirectInterface
{

    use SetContainerTrait;

    /**
     * @var
     * Строка запроса, значение разберается из данных url
     */
    protected $request;

    /**
     * @var
     */
    protected $config;

    /**
     * Redirect constructor.
     *
     * @param ContainerInterface $container
     * @param string     $config
     */
    public function __construct(ContainerInterface $container, string $config)
    {
        $this->container = $container;
        $this->config    = $config;
    }

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
    public function run(string $url = '', string $external = '', string $header = '')
    {
        if ('self' == $url) {
            /*
             * Присваивает $this->request данные
             * $_SERVER['REQUEST_URI'] или $_GET['r']
             * в зависимости от параметра Config::URI
             */
            $this->setRequest();

            /*
             * Присваевает значение $this->request
             * в зависимости от наличия get запроса
             */
            if (strpos($this->request(), '?') !== false) {
                preg_match('~[/[:word:]-]+(?=\?)~', $this->request(), $matches);
            } else {
                $matches[0] = $this->request();
            }

            // Перенаправление по полученным данным
            $this->run(ltrim($matches[0], '/'));
        } else {
            $this->responseCode($header);
            $this->redirectTo($url, $external);
        }
    }

    /**
     * @param string $code
     */
    public function responseCode($code): void
    {
        switch ($code) {
            case '301':
                header("HTTP/1.1 301 Moved Permanently");
                break;
            case '404':
                header("HTTP/1.1 404 Not Found");
                break;
            case '403':
                header('HTTP/1.0 403 Forbidden');
                break;
            case '200':
                header('HTTP/1.1 200');
                break;
        }
    }

    /**
     * @param $url
     * @param $external
     *
     * @return bool
     */
    protected function redirectTo($url, $external): bool
    {
        switch ($external) {
            case 'basic':
                header('Location: http://' . $url);
                return false;
            case 'secure':
                header('Location: https://' . $url);
                return false;
            case 'full':
                header('Location:' . $url);
                return false;
            default:
                $url = str_replace('.', '/', $url);
                header('Location:' . APP_URL . '/' . $url);
                return false;
        }
    }

    /**
     * @return mixed
     */
    public function setRequest(): void
    {
        if ('REQUEST' == $this->config()) {
            $this->request = trim($this->container()->getServer('REQUEST_URI'), '/');
        } elseif ('GET' == $this->config()) {
            $this->request = trim($this->container()->getGet('r'), '/');
        }
    }

    /**
     * @return mixed
     */
    public function config()
    {
        return $this->config;
    }

    /**
     * @return mixed
     */
    public function request()
    {
        return $this->request;
    }
}
