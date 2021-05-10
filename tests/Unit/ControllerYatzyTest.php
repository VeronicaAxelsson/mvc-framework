<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;
use ReflectionClass;
use Psr\Http\Message\ResponseInterface;
use App\Http\Controllers\YatzyController;
use App\Classes\Yatzy\Game;

/**
 * Test cases for the controller Game21.
 */
class ControllerYatzyTest extends TestCase
{
    private $controller;
    /**
     * Test setUp with creating controller class and assert.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->controller = new YatzyController();
        $this->assertInstanceOf("App\Http\Controllers\YatzyController", $this->controller);
    }

    /**
     * Check that the controller returns a response.
     * @runInSeparateProcess
     */
    public function testControllerIndexAction()
    {
        $exp = "\Illuminate\View\View";
        $res = $this->controller->index();
        $this->assertInstanceOf($exp, $res);
    }

    /**
    *  @runInSeparateProcess
    * Check that the throw action returns a response and right header.
    */
    public function testControllerThrowAction()
    {
        $this->withSession(['yatzy' => new Game()]);
        $exp = "\Illuminate\Http\RedirectResponse";
        $res = $this->controller->throw();

        /* Test status code*/
        $this->assertEquals(302, $res->getStatusCode());
        /* Test response*/
        $this->assertInstanceOf($exp, $res);
    }

    // /**
    // *  @runInSeparateProcess
    // * Check that the newGame action returns a response and right header.
    // */
    // public function testControllerNewGameAction()
    // {
    //     $this->withSession(['yatzy' => new Game()]);
    //     $exp = "\Illuminate\Http\RedirectResponse";
    //     $res = $this->controller->newGame();
    //     /* Test status code*/
    //     $this->assertEquals(302, $res->getStatusCode());
    //     /* Test response*/
    //     $this->assertInstanceOf($exp, $res);
    // }

    /**
    *  @runInSeparateProcess
    * Check that the newGame action returns a response and right header.
    */
    public function testControllerNewRoundAction()
    {
        $_POST['diceValue'] = 1;

        $this->withSession(['yatzy' => new Game()]);
        $exp = "\Illuminate\Http\RedirectResponse";
        $res = $this->controller->newRound();

        /* Test status code*/
        $this->assertEquals(302, $res->getStatusCode());
        /* Test response*/
        $this->assertInstanceOf($exp, $res);
    }
}
