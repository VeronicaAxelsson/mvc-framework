<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use ReflectionClass;
use App\Http\Controllers\DiceController;
use Request;

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
    public function testControllerIndexActionWithoutDiceInSession()
    {
        $exp = "\Illuminate\View\View";
        $res = $this->controller->index();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the roll action returns a response.
     * @runInSeparateProcess
     */
    public function testControllerIndexActionWithDiceInSession()
    {
        $this->withSession(['dice' => 1]);
        $exp = "\Illuminate\View\View";
        $res = $this->controller->index();
        $this->assertInstanceOf($exp, $res);
    }


    /**
     * Check that the roll action returns a response.
     * @runInSeparateProcess
     */
    public function testControllerRollAction()
    {
        $_POST["dice"] = 1;
        $exp = "\Illuminate\Http\RedirectResponse";

        $res = $this->controller->roll();

        /* Test status code*/
        $this->assertEquals(302, $res->getStatusCode());
        /* Test response*/
        $this->assertInstanceOf($exp, $res);
    }
}
