<?php

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
 * @package Rudra
 * Класс перенаправления url
 */
class Redirect
{

    /**
     * @var IContainer
     */
    protected $di;

    /**
     * @var
     * Строка запроса, значение разберается из данных url
     */
    private $request;

    /**
     * @var
     */
    private $config;

    /**
     * Redirect constructor.
     * @param IContainer $di
     * @param $config
     */
    public function __construct(IContainer $di, $config)
    {
        $this->di     = $di;
        $this->config = $config;
    }

    /**
     * @param bool $url
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
    public function run($url = null, $external = null, $header = null)
    {
        $this->responseCode($header);

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
            if (strpos($this->getRequest(), '?') !== false) {
                preg_match('~[/[:word:]-]+(?=\?)~', $this->getRequest(), $matches);
            } else {
                $matches[0] = $this->getRequest();
            }

            if ('secure' == $external) {
                $this->run(ltrim($matches[0], '/'), 'https');
            }

            // Перенаправление по полученным данным
            $this->run(ltrim($matches[0], '/'));
        }

        $this->redirectTo($url, $external);
    }

    public function responseCode($code)
    {
        if ('301' == $code) {
            header("HTTP/1.1 301 Moved Permanently");
        } elseif ('404' == $code) {
            header("HTTP/1.1 404 Not Found");
        } elseif ('403' == $code) {
            header('HTTP/1.0 403 Forbidden');
        } elseif ('333' == $code) {
            header('HTTP/1.1 333 Du du du Fackboy');
        } elseif ('200' == $code) {
            header('HTTP/1.1 200');
        }
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * @param mixed $request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return mixed
     */
    private function setRequest()
    {
        switch ($this->getConfig()) {
            case 'REQUEST':
                $this->request = trim($this->getDi()->getServer('REQUEST_URI'), '/');
                break;
            case 'GET':
                $this->request = trim($this->getDi()->getGet('r'), '/');
                break;
        }
    }

    /**
     * @param $url
     * @param $external
     */
    private function redirectTo($url, $external)
    {
        if ('basic' == $external) {
            header('Location: http://' . $url);
            exit;
        } elseif ('secure' == $external) {
            header('Location: https://' . $url);
            exit;
        } elseif ('full' == $external) {
            header('Location:' . $url);
            exit;
        } else {
            $url = str_replace('.', '/', $url);
            header('Location:' . APP_URL . '/' . $url);
            exit;
        }
    }

    /**
     * @return IContainer
     */
    public function getDi(): IContainer
    {
        return $this->di;
    }

}
