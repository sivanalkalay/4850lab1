<!DOCTYPE html>
<html>
    <head>
        <title>Lab 1</title>
    </head>
    
    <body>
       
     <?php
        
        echo 'Tic Tac Toe Game </br></br>';
     
        if (!isset($_GET['board'])) {
            $squares = "---------";
        } else
            $squares = $_GET['board'];

        
        $game = new Game($squares);
        if ($game->winner('x'))
            echo 'You win!!';   //prompt if x wins
        else if ($game->winner('o'))
            echo 'Please try again';    //prompt if o wins
        else {
            $game->pick_move();
            echo 'No winner yet';   //prompt if no one won
        }

        $game->display();
        

        
        
        
        
        class Game {    //create Game class

            var $position;

            function __construct($squares) {
                $this->position = str_split($squares);
            }

            function winner($token) {
                $won = false;
                for ($row = 0; $row < 3; $row++)    //check for row win
                    if (($this->position[3 * $row] == $token) && ($this->position[3 * $row + 1] == $token) && ($this->position[3 * $row + 2] == $token))
                        $won = true;
                for ($col = 0; $col < 3; $col++)    //check for column win
                    if (($this->position[$col] == $token) && ($this->position[3 + $col] == $token) && ($this->position[6 + $col] == $token))
                        $won = true;
                if (($this->position[0] == $token) && ($this->position[4] == $token) && ($this->position[8] == $token)) {   //check for left diagonal win
                    $won = true;
                } else if (($this->position[2] == $token) && ($this->position[4] == $token) && ($this->position[6] == $token)) { //check for right diagonal win
                    $won = true;
                }
                return $won;
            }

            function display() {
                echo '<table cols="3" style="font-size:large; font-weight:bold">';
                echo '<tr>';    // open the first row
                for ($pos = 0; $pos < 9; $pos++) {
                    echo $this->show_cell($pos);
                    if ($pos % 3 == 2)
                        echo '</tr><tr>';   //start a new row for the next square
                }
                echo '</tr>';   //close the last row
                echo '</table>';
            }

            function show_cell($which) {
                $token = $this->position[$which];
                // deal with the easy case
                if ($token <> '-')
                    return '<td>' . $token . '</td>';
                // now the hard case
                $this->newposition = $this->position;   // copy the original
                $this->newposition[$which] = 'x';   // this would be their move
                $move = implode($this->newposition);    // make a string from the board array
                $link = '?board=' . $move;  // this is what we want the link to be
                // so return a cell containing an anchor and showing a hyphen
                return '<td><a href="' . $link . '">-</a></td>';
            }

            function pick_move() {       
                $min=0; //declare min position
                $max=8; //declare max position
                $full = false;
                do {
                    $possible = rand($min, $max);   //use random function to get value between 0 and 8
                    if ($this->position[$possible] == '-') {    //check if spot is empty
                        $this->position[$possible] = 'o';   //fill in spot with o
                        $full = true;
                    }
                } while (!$full);   //do while there are still spots empty
            }
            
        }
        ?> 
    </body>
</html>