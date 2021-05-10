<?php

namespace Tests\Unit;

use Tests\TestCase;
use ReflectionClass;
use App\Classes\Game21\Game;

/**
 * Test cases for class Game for Game21
 */
class Game21Test extends TestCase
{
    private $game21;

    protected function setUp(): void
    {
        parent::setUp();
        $this->game21 = new Game();
        $this->assertInstanceOf("\App\Classes\Game21\Game", $this->game21);
    }

    /**
     * Check that playGame sets values in data and SESSION
     */
    public function testGameSetUpWithPlayGame()
    {

        $this->withSession(['sumPlayer' => 0]);
        $this->withSession(['sumComputer' => 0]);

        $this->game21->playGame();
        $res = $this->game21->getData();

        $this->assertArrayHasKey("header", $res);
        $this->assertArrayHasKey("message", $res);
        $this->assertArrayHasKey("pointsComputer", $res);
        $this->assertArrayHasKey("pointsPlayer", $res);
        $this->assertArrayHasKey("classes", $res);
        $this->assertEquals($res["sumPlayer"], session("sumPlayer"));
        $this->assertEquals($res["sumComputer"], session("sumComputer"));
        // $this->assertSessionHas('sumPlayer', $res['sumPlayer']);
        // $this->assertSessionHas('sumComputer', $res['sumComputer']);
    }

    /**
     * Check that rollDice adds sum of rolls to $_SESSION["sumPLayer"]
     */
    public function testRollDice()
    {
        $_POST = ["die" => 2];
        session()->forget('sumPlayer');
        $this->game21->rollDice();

        $this->assertArrayHasKey("sumPlayer", session()->all());
    }

    /**
     * Check that round ends when sumPlayer is over 21
     */
    public function testRollDicePlayerOver21()
    {
        $reflector = new ReflectionClass($this->game21);
        $reflectorProperty = $reflector->getProperty("message");
        $reflectorProperty->setAccessible(true);

        $_POST = ["die" => 2];
        session()->put('sumPlayer', 21);
        $this->game21->rollDice();
        $res = $reflectorProperty->getValue($this->game21);

        $this->assertNotEquals("Välj antal tärningar att kasta eller stanna", $res);
        $this->assertLessThanOrEqual(26, session("sumComputer"));
        $this->assertGreaterThanOrEqual(21, session("sumComputer"));
    }

    /**
     * Check that game resets
     */
    public function testResetGame()
    {
        $this->game21->resetGame();
        $this->assertEquals(0, session("sumComputer"));
        $this->assertEquals(0, session("sumPlayer"));
    }

    /**
     * Check that sumComputer ends within interval 21-26
     */
    public function testPlayComputer()
    {
        session()->forget('sumComputer');
        $this->game21->playComputer();
        $this->assertLessThanOrEqual(26, session("sumComputer"));
        $this->assertGreaterThanOrEqual(21, session("sumComputer"));
    }

    /**
     * Check that right messege is displayed when both loose
     */
    public function testCheckWinnerBothLose()
    {
        $reflector = new ReflectionClass($this->game21);
        $reflectorProperty = $reflector->getProperty("message");
        $reflectorProperty->setAccessible(true);

        $this->withSession(['sumPlayer' => 22]);
        $this->withSession(['sumComputer' => 22]);

        $this->game21->checkWinner();
        $res = $reflectorProperty->getValue($this->game21);
        $this->assertEquals("Båda förlorade", $res);
    }

    /**
     * Check that right messege is displayed when its a tie
     */
    public function testCheckWinnerTie()
    {
        $reflector = new ReflectionClass($this->game21);
        $reflectorProperty = $reflector->getProperty("message");
        $reflectorProperty->setAccessible(true);

        $this->withSession(['sumPlayer' => 21]);
        $this->withSession(['sumComputer' => 21]);

        $this->game21->checkWinner();
        $res = $reflectorProperty->getValue($this->game21);
        $this->assertEquals("Datorn vinner", $res);
    }

    /**
     * Check that right messege is displayed when both under 21 and
     * computer loose
     */
    public function testCheckWinnerBothUnder21ComputerClosest()
    {
        $reflector = new ReflectionClass($this->game21);
        $reflectorProperty = $reflector->getProperty("message");
        $reflectorProperty->setAccessible(true);

        $this->withSession(['sumPlayer' => 19]);
        $this->withSession(['sumComputer' => 20]);

        $this->game21->checkWinner();
        $res = $reflectorProperty->getValue($this->game21);
        $this->assertEquals("Datorn vinner", $res);
    }

    /**
     * Check that right messege is displayed when both under 21 and
     * player loose
     */
    public function testCheckWinnerBothUnder21PlayerClosest()
    {
        $reflector = new ReflectionClass($this->game21);
        $reflectorProperty = $reflector->getProperty("message");
        $reflectorProperty->setAccessible(true);

        $this->withSession(['sumPlayer' => 20]);
        $this->withSession(['sumComputer' => 19]);

        $this->game21->checkWinner();
        $res = $reflectorProperty->getValue($this->game21);
        $this->assertEquals("Du vann!!", $res);
    }

    /**
     * Check that right messege is displayed when player under 21
     * and computer over
     */
    public function testCheckWinnerPlayerUnder21ComputerOver()
    {
        $reflector = new ReflectionClass($this->game21);
        $reflectorProperty = $reflector->getProperty("message");
        $reflectorProperty->setAccessible(true);

        $this->withSession(['sumPlayer' => 20]);
        $this->withSession(['sumComputer' => 22]);

        $this->game21->checkWinner();
        $res = $reflectorProperty->getValue($this->game21);
        $this->assertEquals("Du vann!!", $res);
    }

    /**
     * Check that right messege is displayed when computer under 21
     * and player over
     */
    public function testCheckWinnerComputerUnder21PlayerOver()
    {
        $reflector = new ReflectionClass($this->game21);
        $reflectorProperty = $reflector->getProperty("message");
        $reflectorProperty->setAccessible(true);

        $this->withSession(['sumPlayer' => 22]);
        $this->withSession(['sumComputer' => 20]);

        $this->game21->checkWinner();
        $res = $reflectorProperty->getValue($this->game21);
        $this->assertEquals("Datorn vinner", $res);
    }
}
