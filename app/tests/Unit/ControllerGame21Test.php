<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use ReflectionClass;
use Psr\Http\Message\ResponseInterface;
use App\Http\Controllers\Game21Controller;
use App\Classes\Game21\Game;

/**
 * Test cases for the controller Game21.
 */
class ControllerGame21Test extends TestCase
{
    /**
     * Test up with creating controller class assert.
     */
    private $controller;
    public function setUp(): void
    {
        parent::setUp();
        $this->controller = new Game21Controller();
        $this->assertInstanceOf("App\Http\Controllers\Game21Controller", $this->controller);
    }

    /**
     * Check that the index action returns a response.
     * @runInSeparateProcess
     */
    public function testControllerIndexAction()
    {
        $exp ="\Illuminate\View\View";;
        $res = $this->controller->index();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the roll action returns a response.
     * @runInSeparateProcess
     */
    public function testControllerRollAction()
    {
        $_POST["die"] = 1;
        $request = \Request::create('/roll', 'POST');
        $this->withSession(['game21' => new Game()]);
        $exp = "\Illuminate\Http\RedirectResponse";
        $res = $this->controller->roll($request);

        /* Test status code*/
        $this->assertEquals(302, $res->getStatusCode());
        /* Test response*/
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the end action returns a response.
     * @runInSeparateProcess
     */
    public function testControllerEndAction()
    {
        $request = \Request::create('/end', 'POST');
        $this->withSession(['game21' => new Game()]);
        $exp = "\Illuminate\Http\RedirectResponse";
        $res = $this->controller->end($request);

        /* Test status code*/
        $this->assertEquals(302, $res->getStatusCode());
        /* Test response*/
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the reset action returns a response.
     * @runInSeparateProcess
     */
    public function testControllerResetAction()
    {
        $request = \Request::create('/reset', 'POST');
        $this->withSession(['game21' => new Game()]);
        $exp = "\Illuminate\Http\RedirectResponse";
        $res = $this->controller->reset($request);

        /* Test status code*/
        $this->assertEquals(302, $res->getStatusCode());
        /* Test response*/
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the newRound action returns a response.
     * @runInSeparateProcess
     */
    public function testControllerNewRoundAction()
    {
        $request = \Request::create('/newround', 'POST');
        $this->withSession(['game21' => new Game()]);
        $exp = "\Illuminate\Http\RedirectResponse";
        $res = $this->controller->newRound($request);

        /* Test status code*/
        $this->assertEquals(302, $res->getStatusCode());
        /* Test response*/
        $this->assertInstanceOf($exp, $res);
    }
}
