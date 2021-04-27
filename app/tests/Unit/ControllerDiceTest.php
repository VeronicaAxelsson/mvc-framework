<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use ReflectionClass;
use Psr\Http\Message\ResponseInterface;
use App\Http\Controllers\DiceController;

/**
 * Test cases for the controller Game21.
 */
class ControllerDiceTest extends TestCase
{
    /**
     * Test up with creating controller class assert.
     */
    private $controller;
    public function setUp(): void
    {
        parent::setUp();
        $this->controller = new DiceController();
        $this->assertInstanceOf("App\Http\Controllers\DiceController", $this->controller);
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
        // $this->withSession(['game21' => new Game()]);
        $exp = "\Illuminate\Http\RedirectResponse";
        $res = $this->controller->roll($request);
        $this->assertArrayHasKey("dice", session()->all());

        /* Test status code*/
        $this->assertEquals(302, $res->getStatusCode());
        /* Test response*/
        $this->assertInstanceOf($exp, $res);
    }
}
