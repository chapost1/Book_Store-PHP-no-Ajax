<?php


//////// Check How Many books - Pages Preparation
$offset = ceil(($resultNum->num_rows) / 10);
///////////////////////////////////////////// Pages Maker
for ($x = 0; $x < $offset; $x++) {
    $y = $x + 1;
    echo'<form class="inline-form" method="GET" action="' . $_SERVER['PHP_SELF'] . '">';
    echo "<input type='hidden' value='$x' name='pageNum'/>";
    if (isset($_GET['pageNum'])) {
        //////////////////////////////////// Gets VIA GET API - PAGE NUMBERS TO CREATE, TRUE IS +1
        if ($_GET['pageNum'] == $y - 1) {
            echo "<input class='page-button chosen-page' type='submit' value='$y'/>";
        } else {
            echo "<input class='page-button' type='submit' value='$y'/>";
        }
    } else {
        if ($y == 1) {
            echo "<input class='page-button chosen-page' type='submit' value='$y'/>";
        } else {
            echo "<input class='page-button' type='submit' value='$y'/>";
        }
    }
    echo '</form>';
}