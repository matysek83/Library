<?php
function connect($host = "localhost", $user = "matys_baza", $password = "", $dbname = "matys_baza")
{
    $db_h = mysqli_connect($host, $user, $password, $dbname);
    if (!$db_h)
    {
        echo "connect error"; 
        
    }
    //else echo "polaczenie zostalo nawiazane poprawnie<br />";
    mysqli_set_charset($db_h, "utf8");
    return $db_h;
}

function db_handler($host = "localhost", $user = "matys_baza", $password = "", $dbname = "matys_baza")
{
   return $db_h = mysqli_connect($host, $user, $password, $dbname); 
}

function disconnect($host = "localhost", $user = "matys_baza", $password = "", $dbname = "matys_baza")
{
    $db_h = mysqli_connect($host, $user, $password, $dbname);
    if (!$db_h)
    {
        echo "disconnect error";
       
    }
    mysqli_close($db_h);
}
?>
