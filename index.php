<?php
// Get a random puzzle
function getRandPuzzle()
{
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
    $puzzles[]=array(
        0,0,0,  0,0,0,  0,0,0,
        0,8,9,  4,1,0,  0,0,0,
        0,0,6,  7,0,0,  1,9,3,
        
        2,0,0,  0,0,0,  7,0,0,
        3,4,0,  6,0,0,  0,1,0,
        0,0,0,  9,0,0,  0,0,5,
        
        0,0,0,  0,2,0,  0,5,0,
        6,5,0,  0,4,0,  0,2,0,
        7,3,0,  1,0,0,  0,0,0
    );
    $puzzles[]=array(
        0,0,0,  0,4,0,  0,0,0,
        5,0,0,  0,0,3,  0,8,0,
        0,6,0,  0,0,0,  5,2,7,
        
        0,0,0,  0,0,0,  0,0,0,
        0,0,0,  0,3,6,  0,0,0,
        0,0,7,  0,2,8,  0,6,9,
        
        0,2,0,  9,8,0,  0,0,0,
        3,0,0,  0,1,5,  0,4,0,
        0,0,0,  0,0,4,  0,7,8
    );
    // $puzzles[]=array(
    //     0,0,0,  0,0,0,  0,0,0,
    //     0,0,0,  0,0,0,  0,0,0,
    //     0,0,0,  0,0,0,  0,0,0,
        
    //     0,0,0,  0,0,0,  0,0,0,
    //     0,0,0,  0,0,0,  0,0,0,
    //     0,0,0,  0,0,0,  0,0,0,
        
    //     0,0,0,  0,0,0,  0,0,0,
    //     0,0,0,  0,0,0,  0,0,0,
    //     0,0,0,  0,0,0,  0,0,0
    // );
    return $puzzles[rand(0, count($puzzles) - 1)];
}


// Display the puzzle on the form
function displayPuzzle($puzzle)
{
    echo '<table align="center" class="puzzle">';
    for($yb = 0; $yb < 3; $yb++)
    {
        echo '<tr class="puzzle_block_row">';
        for($xb = 0; $xb < 3; $xb++)
        {
            echo '<td class="puzzle_block"><table>';
            for($y = 0; $y < 3; $y++)
            {
                echo '<tr class="puzzle_row">';
                for($x = 0; $x < 3; $x++)
                {
                    $i = indexOfBlock($xb, $yb, $x, $y);
                    echo '<td class="puzzle_cell">';
                    //echo ($puzzle[$i] == 0?' ':$puzzle[$i]);
                    echo ($puzzle[$i]);
                    echo '</td>';
                }
                echo '</tr>';
            }
            echo '</table></td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

// Display the puzzle on the form
function displayPuzzleForm($puzzle)
{
    echo '<form class="puzzle_form" action="index.php" method="post">';
    echo '<table align="center" class="puzzle">';
    $i = 0;
    for($yb = 0; $yb < 3; $yb++)
    {
        echo '<tr class="puzzle_block_row">';
        for($xb = 0; $xb < 3; $xb++)
        {
            echo '<td class="puzzle_block"><table>';
            for($y = 0; $y < 3; $y++)
            {
                echo '<tr class="puzzle_row">';
                for($x = 0; $x < 3; $x++)
                {
                    $i = indexOfBlock($xb, $yb, $x, $y);
                    $v = $puzzle[$i];
                    echo '<td class="puzzle_cell">';
                    echo '<input class="puzzle_input_cell" type="text" size="1" name="';
                    echo $i;
                    if($v != 0)
                    {
                        echo '" value="';
                        echo $v;
                    }
                    echo '"/>';
                    echo '</td>';
                }
                echo '</tr>';
            }
            echo '</table></td>';
        }
        echo '</tr>';
    }
    echo '</table>';
    echo '<button class="button" type="submit">Solve</button>';
    echo '<button class="button" onclick="clearInputs(); return false;">Clear</button>';
    echo '</form>';
}

// Get the index of these x, y coords
function indexOf($x, $y)
{
    return (9 * $y) + $x;
}
// Get the index of these x, y, xb, yb coords
function indexOfBlock($xb, $yb, $x, $y)
{
    return indexOf((3*$xb)+$x,(3*$yb)+$y);
}

// Gets the block # that this cartesian index(x or y) is in
function block($xy)
{
    return (int) ($xy / 3);
}

// Solve this puzzle array
function solvePuzzle($puzzle)
{
    // Find the first empty cell
    
    $i = 0;
    while($puzzle[$i] != 0)
    {
        $i++;
        if($i == 81)
        {
            return $puzzle; //found a solution
        }
    }
    
    // Get the positions on the grid for easy use
    $x = $i % 9;
    $y = (int)($i / 9);
    
    //Grab the blocks
    $xb = block($x);
    $yb = block($y);
    
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
        <title>Sudoku Solver</title>
        <style>
            @import url("css/style.css");
        </style>
        <script>
            function clearInputs()
            {
                var inputs = document.getElementsByTagName('input');
                for (var i = 0; i<inputs.length; i++)
                {
                    if(inputs[i].type === 'text')
                    {
                        inputs[i].value = '';
                    }
                }
            }
        </script>
    </head>
    <body>
        <div id="main">
        <h1>Sudoku Solver</h1>
        <?php
            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $puzzle = array();
                for($j = 0; $j < 9; $j++)
                {
                    for($k = 0; $k < 9; $k++)
                    {
                        $i = indexOf($k, $j);
                        $puzzle[]=$_POST[(string)$i];
                    }
                }
                echo '<div class="spacer"></div>';
                echo '<div id="submitted">';
                echo '<h2>You submitted:</h2>';
                displayPuzzle($puzzle);
                echo '</div>';
                
                echo '<div class="spacer">';
                echo '<a class="button" href="index.php">Restart</a>';
                echo '</div>';
                
                
                echo '<div id="solved">';
                echo '<h2>Solved:</h2>';
                displayPuzzle(solvePuzzle($puzzle));
                echo '</div>';
                
                echo '<div class="spacer"></div>';
                echo '<img id="checkmark" src="img/checkmark.png"/>';
                
            }
            elseif($_SERVER['REQUEST_METHOD'] === 'GET')
            {
                $puzzle = getRandPuzzle();
                echo '<div align="center">';
                displayPuzzleForm($puzzle);
                echo '</div>';
                    
            }
            
        ?>
        </div>
        <hr>
        <table align="center"><tfoot>
            <tr>
                <th>
                    2017 &copy; Carsen Yates.
                </th>
            </tr>
            <tr>
                <td>
                    Disclaimer: All material above is used for teaching purposes.  Information might be inaccurate.
                </td>
            </tr>
            <tr>
                <td>
                    <img src="../../img/csumb-logo.png" alt="CSUMB Logo"/>
                </td>
            </tr>
        </tfoot></table>
    </body>
</html>