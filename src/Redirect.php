<?php

namespace Rudra;

    /**
     * Date: 19.01.16
     * Time: 15:10
     * @author    : Korotkov Danila <dankorot@gmail.com>
     * @copyright Copyright (c) 2016, Korotkov Danila
     * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
     */

/**
 * Class Redirect
 * @package Core
 * Класс перенаправления url
 */
Class Redirect
{
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
     * @param $config
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @param bool   $url
     * @param string $external
     * Перенаправляет в соответствии с указанными параметрами
     * $external - для перенаправления на внешние адреса,
     * если $external == 1, то http://domain.com
     * если $external == 2, то https://domain.com
     * если параметр $external, не передан, то переадресация
     * происходит по внутренним адресам приложения, при этом
     * если значение $url == 'self', то перенаправление будет
     * произведено на текущуй метод контроллера (текущуй адрес)
     */
    public function run($url = false, $external = 'http')
    {
        if ($url == 'self') {
            /*
             * Присваивает $this->request данные
             * $_SERVER['REQUEST_URI'] или $_GET['r']
             * в зависимости от параметра Config::URI
             */
            switch ($this->config) {
                case 'REQUEST':
                    $this->request = trim($_SERVER['REQUEST_URI'], '/');
                    break;
                case 'GET':
                    $this->request = trim($_GET['r'], '/');
                    break;
            }
            /*
             * Присваевает значение $this->request
             * в зависимости от наличия get запроса
             */
            if (strpos($this->request, '?') !== false) {
                preg_match('~[/[:word:]-]+(?=\?)~', $this->request, $matches);
            } else {
                $matches[0] = $this->request;
            }

            if ($external == 'secure') {
                $this->run(ltrim($matches[0], '/'), 'https');
            }

            // Перенаправление по полученным данным
            $this->run(ltrim($matches[0], '/'));
        }

        switch ($external) {
            case 'basic':
                header('Location: http://' . $url);
                break;
            case 'secure':
                header('Location: https://' . $url);
                break;
            case 'full':
                header('Location:' . $url);
                break;
            default:
                $url = str_replace('.', '/', $url);
                header('Location:' . $external . '://' . $_SERVER['SERVER_NAME'] . '/' . $url);
                exit;
        }
    }
}
