<?php

/**
 * View for Dice.
 */

declare(strict_types=1);

$classes = $classes ?? [];
 ?>


@include('includes.header')
<h1>Kasta tärningen</h1>

<p>Välj hur många tärnigar du vill kasta</p>

<form method="post" action="dice/roll">
    @csrf
    <label>
    <input type="number" name="dice" value="1">
    </label>
    <input type="submit" name="submit" value="Kasta">
</form>

<div class="dice">
<?php
foreach ($classes as $class) {
    ?>
    <i class="dice-sprite <?= $class ?>"></i>
    <?php
}
?>
</div>
@include('includes.footer')
