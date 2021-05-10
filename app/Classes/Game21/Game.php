<?php

namespace App\Classes\Game21;

use App\Classes\Dice\DiceHand;

/**
 * Dice class
 */
class Game
{
    /**
    * @var int $pointsPlayer     Number of won games for player.
    * @var int $pointsComputer   Number of won games for computer
    * @var array $classes            Classes for graphic dice.
    * @var string $message           Message for player.
    */
    private $pointsPlayer = 0;
    private $pointsComputer = 0;
    private $classes = [];
    private $message = "Välj antal tärningar att kasta eller stanna";
    private $data = [];

    /**
    * Start a game.
    *
    * @return void
    */
    public function playGame(): void
    {
        $this->data["header"] = "Game21";
        $this->data["message"] = $this->message;
        $this->data["pointsComputer"] = $this->pointsComputer;
        $this->data["pointsPlayer"] = $this->pointsPlayer;
        $this->data["classes"] = $this->classes;

        if (session()->exists('sumPlayer')) {
            $this->data["sumPlayer"] = session("sumPlayer");
        }
        if (session()->exists('sumComputer')) {
            $this->data["sumComputer"] = session("sumComputer");
        }
    }


    /**
    * Return data array
    *
    * @return array
    */
    public function getData(): array
    {
        return $this->data;
    }

    /**
    * Roll dies.
    *
    * @return void
    */
    public function rollDice(): void
    {
        if (session()->missing('sumPlayer')) {
            session()->put('sumPlayer', 0);
        }

        $diceHand = new DiceHand((int)$_POST["die"]);
        $rolls = $diceHand->roll();
        foreach ($rolls as $roll) {
            // $_SESSION["sumPlayer"] += $roll;
            session()->put('sumPlayer', session('sumPlayer') + $roll);
        }
        /* Om diceHand finns hämtas grafisk representation och läggs i $classes */
        $this->classes = [];
        foreach ($diceHand->graphic() as $roll) {
            $this->classes[] = $roll;
        }

        if (session("sumPlayer") >= 21) {
            self::playComputer();
            self::checkWinner();
        }
    }

    /**
    * A game of 21 is played automatically.
    *
    * @return void
    */
    public function playComputer(): void
    {
        if (session()->missing('sumComputer')) {
            session()->put('sumComputer', 0);
        }
        while (session("sumComputer") < 21) {
            $diceHand = new DiceHand(1);
            $rolls = $diceHand->roll();
            foreach ($rolls as $roll) {
                session()->put('sumComputer', session('sumComputer') + $roll);
            }
        }
    }

    /**
    * Reset game
    *
    * @return void
    */
    public function resetGame(): void
    {
        session()->put('sumPlayer', 0);
        session()->put('sumComputer', 0);
        $this->message = "Välj antal tärningar att kasta eller stanna";
    }

    /**
    * Check who the winner is.
    *
    * @return void
    */
    public function checkWinner(): void
    {
        if (session("sumComputer") > 21 && session("sumPlayer") > 21) {
            $this->message = "Båda förlorade";
        } elseif (session("sumComputer") === session("sumPlayer")) {
            $this->message = "Datorn vinner";
            $this->pointsComputer += 1;
        } elseif (session("sumComputer") <= 21 && session("sumPlayer") <= 21) {
            if (session("sumComputer") > session("sumPlayer")) {
                $this->message = "Datorn vinner";
                $this->pointsComputer += 1;
            } else {
                $this->message = "Du vann!!";
                $this->pointsPlayer += 1;
            }
        } elseif (session("sumPlayer") <= 21) {
            $this->message = "Du vann!!";
            $this->pointsPlayer += 1;
        } else {
            $this->message = "Datorn vinner";
            $this->pointsComputer += 1;
        }
    }
}
