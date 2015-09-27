<?php
function connect($host = "localhost", $user = "root", $password = "area5432")
{
    $db = mysql_connect($host, $user, $password);
    if (!$db)
    {
        echo "connect error"; 
        
    }
    //else echo "polaczenie zostalo nawiazane poprawnie<br />";
    mysql_set_charset("utf8");
}

function disconnect($host = "localhost", $user = "root", $password = "area5432")
{
    $db = mysql_connect($host, $user, $password);
    if (!$db)
    {
        echo "disconnect error";
       
    }
    mysql_close($db);
}
?>
