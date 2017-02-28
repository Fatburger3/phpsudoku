<?php
$blank_puzzle=array(
    0,0,0,  0,0,0,  0,0,0,
    0,0,0,  0,0,0,  0,0,0,
    0,0,0,  0,0,0,  0,0,0,
    
    0,0,0,  0,0,0,  0,0,0,
    0,0,0,  0,0,0,  0,0,0,
    0,0,0,  0,0,0,  0,0,0,
    
    0,0,0,  0,0,0,  0,0,0,
    0,0,0,  0,0,0,  0,0,0,
    0,0,0,  0,0,0,  0,0,0
);
// The array of puzzles to choose from
$puzzles = array();
$puzzles[]=array(
    8,0,0,  0,0,0,  0,0,0,
    0,0,3,  6,0,0,  0,0,0,
    0,7,0,  0,9,0,  2,0,0,
    
    0,5,0,  0,0,7,  0,0,0,
    0,0,0,  0,4,5,  7,0,0,
    0,0,0,  1,0,0,  0,3,0,
                
    0,0,1,  0,0,0,  0,6,8,
    0,0,8,  5,0,0,  0,1,0,
    0,9,0,  0,0,0,  4,0,0
);
$puzzles[]=array(
    0,9,5,  7,4,3,  8,6,1,
    4,3,1,  8,6,5,  9,2,7,
    8,7,6,  1,9,2,  5,4,3,
    
    3,8,7,  4,5,9,  2,1,6,
    6,1,2,  3,8,7,  4,9,5,
    5,4,9,  2,1,6,  7,3,8,
    
    7,6,3,  5,3,4,  1,8,9,
    9,2,8,  6,7,1,  3,5,4,
    1,5,4,  9,3,8,  6,7,2
);

// Set the main puzzle to a random puzzle
$puzzle = $puzzles[rand(0, count($puzzles) - 1)];

// Display the puzzle on the form
function displayPuzzle($puzzle)
{
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
            $i++;
            echo '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

// Get the index of these x, y coords
function indexOf($x, $y)
{
    return (9 * $y) + $x;
}

// Gets the block # that this cartesian index(x or y) is in
function block($xy)
{
    return (int) ($xy / 3);
}

// Solve this puzzle array
function solvePuzzle($puzzle)
{
    //$puzzle_copy = $puzzle;
    $i = 0;
    
    // Find the first empty cell
    while($puzzle[$i] != 0)
    {
        $i++;
        if($i == 81)
        {
            echo 'solved';
            return $puzzle; //found a solution
        }
    }
    
    // Get the positions on the grid for easy use
    $x = $i % 9;
    $y = (int)($i / 9);
    
    //Grab the blocks
    $xb = block($x);
    $yb = block($y);
    
    // echo 'selected index: ';
    // echo $i;
    // echo '</br>';
    // echo 'X, Y Cell: ';
    // echo $x;
    // echo ', ';
    // echo $y;
    // echo '</br>';
    // echo 'X, Y Block: ';
    // echo $xb;
    // echo ', ';
    // echo $yb;
    // echo '</br>';
    
    // Now try to fill the cell with a value
    // Accept values 1 thru 9
    for($v = 1; $v < 10; $v++)
    {
        
        // Check row and column conflicts (both at same time)
        $conflict = 0;
        for($j = 0; $j < 9; $j++)
        {
            // X conflicts
            if($puzzle[indexOf($j, $y)] == $v)
            {
                $conflict = 1;
                break;
            }
            // Y conflicts
            if($puzzle[indexOf($x, $j)] == $v)
            {
                $conflict = 1;
                break;
            }
        }
        
        
        //Check the local block for conflicts
        for($j = 0; $j < 3; $j++)
        {
            for($k = 0; $k < 3; $k++)
            {
                if($puzzle[indexOf((3 * $xb) + $j,(3 * $yb) + $k)] == $v)
                {
                    $conflict = 1;
                    break;
                }
            }
        }
        if($conflict == 1) continue;
        
        // There are no conflicts, so we test-fill this cell with this value, then move on to the next cell
        $puzzle[indexOf($x, $y)] = $v;
        $rec = solvePuzzle($puzzle);
        if($rec != null) return $rec;
        else 
        {
            $puzzle[$i]=0;
            continue;
        }
    }
    // return null to let the previous function in the stack know that we could not solve
    return null;
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
        <?php displayPuzzle($puzzle); ?>
        <?php $puzzle=solvePuzzle($puzzle);displayPuzzle($puzzle); ?>
    </body>
</html>