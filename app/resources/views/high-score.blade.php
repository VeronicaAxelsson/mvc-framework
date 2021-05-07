<?php

/**
 * View for Dice.
 */

declare(strict_types=1);

$highScores = $highScores ?? [];
// var_dump($highScores);
?>

@include('includes.header')

<h1>Top fem spel i Yatzy</h1>
<table>
    <tr>
        <th>Spel</th>
        <th>Poäng</th>
    </tr>
    <?php foreach ($highScores as $score) { ?>
        <tr>
            <td><?= $score['id'] ?></td>
            <td><?= $score['score'] ?></td>
        </tr>
    <?php } ?>
</table>

@include('includes.footer')
