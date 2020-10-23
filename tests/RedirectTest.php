<?php

declare(strict_types=1);

/**
 * @author    : Jagepard <jagepard@yandex.ru">
 * @license   https://mit-license.org/ MIT
 *
 *  phpunit src/tests/ContainerTest --coverage-html src/tests/coverage-html
 */

namespace Rudra\Redirect\Tests;

use Rudra\Container\Interfaces\RudraInterface;
use Rudra\Container\Facades\{Request, Rudra};
use Rudra\Redirect\RedirectFacade as Redirect;
use PHPUnit\Framework\TestCase as PHPUnit_Framework_TestCase;

class RedirectTest extends PHPUnit_Framework_TestCase
{
    protected function setUp(): void
    {
        Rudra::config([
            "siteUrl" => "http://example.com",
            "environment" => "test"
        ]);
        Rudra::binding([RudraInterface::class => Rudra::run()]);
        Request::get()->set(["r" => "test"]);
        Request::server()->set(["REQUEST_URI" => "test"]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testRun()
    {
        Redirect::run();
        $this->assertEquals("Location:" . Rudra::config()->get("siteUrl") . '/', xdebug_get_headers()[0]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testRunSecure()
    {
        Redirect::run("example.com", "secure");
        $this->assertEquals("Location: https://example.com", xdebug_get_headers()[0]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testRunFull()
    {
        Redirect::run("https://example.com", "full");
        $this->assertEquals("Location:https://example.com", xdebug_get_headers()[0]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testRunBasic()
    {
        Redirect::run("example.com", "basic");
        $this->assertEquals("Location: http://example.com", xdebug_get_headers()[0]);
    }

    /**
     * @runInSeparateProcess
     */
    public function testResponseCode200()
    {
        Redirect::responseCode("200");
        $this->assertEquals(200, http_response_code());
    }

    /**
     * @runInSeparateProcess
     */
    public function testResponseCode301()
    {
        Redirect::responseCode("301");
        $this->assertEquals(301, http_response_code());
    }

    /**
     * @runInSeparateProcess
     */
    public function testResponseCode403()
    {
        Redirect::responseCode("403");
        $this->assertEquals(403, http_response_code());
    }

    /**
     * @runInSeparateProcess
     */
    public function testResponseCode404()
    {
        Redirect::responseCode("404");
        $this->assertEquals(404, http_response_code());
    }
}
