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
            include 'sudoku.php';
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