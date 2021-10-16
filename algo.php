<?php
    
class algo {
    private $nbrLine;
    private $nbrDisk;
    private $letters;
    
    // initialize all default value
    public function __construct($nbrLine, $nbrDisk) {
        $this->nbrLine = $nbrLine;
        $this->nbrDisk = $nbrDisk;
        $this->letters = range('A', 'Z');
        $this->TableTop();
        $this->TableContent();
    }
    
    // function to show the top of table
    public function TableTop(): void
    {
        echo "<table class='table table-striped table-hover'>";
        echo "<thead>";
        echo "<tr class='table-dark'>";
        
        // loop to write the top table with disk name
        for ($i = 0; $i < $this->nbrDisk; $i++) {
            echo "<th>Disk " . $i . "</th>";
        }
        
        echo "</tr>";
        echo "</thead>";
    }
    
    // function to show content table with algo for RAID 5
    public function TableContent(): void
    {
        $end = $this->nbrDisk - 1;
        $data = 0;
        $parity = 0;
        
        echo "<tbody>";
        // loop to show all the line horizontaly
        for ($i = 0; $i < $this->nbrLine; $i++) {
            echo "<tr>";
            // loop on all disk
            for ($j = 0; $j < $this->nbrDisk; $j++) {
                echo "<td>Block ";
                if ($j === $end)// check if the loop is at the end of the line
                {
                  // loop at disk but whitout the last
                  for ($k = 0; $k < $this->nbrDisk - 1; $k++) {
                      echo $this->letters[$parity++];
                      if ($parity >= 26) {$parity = 0;}// condition to restart alphabet after "Z"
                      if ($k < $this->nbrDisk - 2) {echo " + ";}// condition to add "+" between value
                  }
                }
                else
                {
                    echo $this->letters[$data];
                    $data++;
                    if ($data >= 26) {$data = 0;}// condition to restart alphabet after "Z"
                }
                echo "</td>";
            }
            $end++;
            if ($end >= $this->nbrDisk){$end = 0;}// condition to check last disk
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    }
    
    
}

// check if the url is correctly written
if (($_GET["row"] && $_GET["col"]) && $_GET["col"] >= 3)
{
    $algo = new algo($_GET["row"], $_GET["col"]);
}