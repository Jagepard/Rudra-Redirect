<?php

declare(strict_types=1);

/**
 * @author    : Korotkov Danila <dankorot@gmail.com>
 * @copyright Copyright (c) 2018, Korotkov Danila
 * @license   http://www.gnu.org/licenses/gpl.html GNU GPLv3.0
 *
 *  phpunit src/tests/ContainerTest --coverage-html src/tests/coverage-html
 */

namespace Rudra\Tests;

use Rudra\Redirect;
use Rudra\Container;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

/**
 * Class RedirectTest
 */
class RedirectTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var Redirect
     */
    protected $redirect;

    protected function setUp(): void
    {
        $_SERVER['REQUEST_URI'] = 'test';
        $_GET['r']              = 'test';
        $this->redirect         = new Redirect(Container::app(), 'http://example.com', 'test');
    }

    /**
     * @runInSeparateProcess
     */
    public function testRun()
    {
        $this->redirect()->run();
        $this->assertEquals('Location:' . $this->redirect()->url() . '/', xdebug_get_headers()[0]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testRunSecure()
    {
        $this->redirect()->run('example.com', 'secure');
        $this->assertEquals('Location: https://example.com', xdebug_get_headers()[0]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testRunFull()
    {
        $this->redirect()->run('https://example.com', 'full');
        $this->assertEquals('Location:https://example.com', xdebug_get_headers()[0]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testRunBasic()
    {
        $this->redirect()->run('example.com', 'basic');
        $this->assertEquals('Location: http://example.com', xdebug_get_headers()[0]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testResponseCode200()
    {
        $this->redirect()->responseCode('200');
        $this->assertEquals(200, http_response_code());
    }

    /**
     * @runInSeparateProcess
     */
    public function testResponseCode301()
    {
        $this->redirect()->responseCode('301');
        $this->assertEquals(301, http_response_code());
    }

    /**
     * @runInSeparateProcess
     */
    public function testResponseCode403()
    {
        $this->redirect()->responseCode('403');
        $this->assertEquals(403, http_response_code());
    }

    /**
     * @runInSeparateProcess
     */
    public function testResponseCode404()
    {
        $this->redirect()->responseCode('404');
        $this->assertEquals(404, http_response_code());
    }

    /**
     * @return mixed
     */
    protected function redirect(): Redirect
    {
        return $this->redirect;
    }
}
