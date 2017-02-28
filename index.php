<?php
$puzzle1 = array(8,0,0,  0,0,0,  0,0,0,
                0,0,3,  6,0,0,  0,0,0,
                0,7,0,  0,9,0,  2,0,0,
                
                0,5,0,  0,0,7,  0,0,0,
                0,0,0,  0,4,5,  7,0,0,
                0,0,0,  1,0,0,  0,3,0,
                
                0,0,1,  0,0,0,  0,6,8,
                0,0,8,  5,0,0,  0,1,0,
                0,9,0,  0,0,0,  4,0,0
    );


$puzzle = array();

function pickRandPuzzle()
{
    $puzzle = $puzzle1;
}

function displayPuzzle(){
    global $puzzle;
    echo '<table class="puzzle">';
    $i = 0;
    for($y = 0; $y < 9; $y++)
    {
        echo '<tr class="puzzle_row">';
        for($x = 0; $x < 9; $x++)
        {
            echo '<td class="puzzle_cell">';
            //echo ($puzzle[$i] == 0?' ':$puzzle[$i]);
            echo ($puzzle[$i]);
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

function solvePuzzle()
{
    
}



?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sudoku Solver?</title>
        <style>
            @import url("css/style.css");
        </style>
    </head>
    <body>
        <h1>Sudoku Solver</h1>
        <?php displayPuzzle(); ?>
    </body>
</html>