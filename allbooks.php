<?php
include_once 'include/session.start.inc.php';
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include "include/meta.inc.php";
?>

<title>PHP Library1</title>

</head>
<body onload="zegar();">
	<div align="center">
		<div id="kontener">
			<div id="panel">
				<div id="formularz"><?php include_once 'include/login.user.php';	?>




				</div>
				<div id="zegar">

				<script type="text/javascript" src="script.js"></script>

				</div>
			</div>
			<div id="gorna_czesc_kontenera">



	    	</div>
		<!-- koniec div gorna czesc kontenera -->

		<!--środkowe menu-->
		<?php
		include 'include/middle.menu.inc.php';
		?>
		<!-- koniec div srodkowe menu-->

			<div id="zawartosc">
				<div id="gorna_czesc_zawartosci"></div>
				<div id="srodkowa_czesc_zawartosci">
					<div id="tekst">
                                            <div style="text-align: center;">
<?php
function clean($var, $name)
{
    if (isset($_GET[$var]))
    {
        $_GET[$var] = filter_var($_GET[$var], FILTER_SANITIZE_STRING);
        $_SESSION[$var] = $_GET[$var];
        $name = $_SESSION[$var];
        $name = mysql_real_escape_string($name);
    }
}

if (isset($_SESSION['logged']))
$_SESSION['logged'] = filter_var($_SESSION['logged'], FILTER_SANITIZE_STRING);

connect();
$wyborbazy = mysql_select_db("matys_baza");

clean('sortby1', $sortby);
clean('dir', $dir);
clean('page', $page);

/*
if (isset($_GET['sortby']))
{
$_GET['sortby'] = filter_var($_GET['sortby'], FILTER_SANITIZE_STRING);
$_SESSION['sortby1'] = $_GET['sortby'];
$sortby = $_SESSION['sortby1'];
$sortby = mysql_real_escape_string($sortby);
}


if (isset($_GET['dir']))
{
$_GET['dir'] = filter_var($_GET['dir'], FILTER_SANITIZE_STRING);
$_SESSION['dir'] = $_GET['dir'];
$dir = $_SESSION['dir'];
$dir = mysql_real_escape_string($dir);
}


if (isset($_GET['page']))
{
$_GET['page'] = filter_var($_GET['page'], FILTER_SANITIZE_STRING);
$_SESSION['page'] = $_GET['page'];
$page = $_SESSION['page'];
}*/

if (isset($_SESSION['user_id']))
{
    $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_STRING);
}




$query = "SELECT * from table_books
          ";

$result = mysql_query($query) or die(mysql_error());

if (empty ($result))
{
    echo "Empty database";
    exit;
}
else
{


    $counter = mysql_num_rows($result);
    $num_of_pages = ceil($counter/10);
    if (isset($_GET['page']))
    {
        if (!empty($_GET['page']) )
        {

            $_GET['page'] = filter_var($_GET['page'], FILTER_SANITIZE_STRING);



            if (($_GET['page'] > $num_of_pages) )
            {
                echo "Site not exist!";
                exit;
            }


            if ($_GET['page']!=NULL)
            if (!is_numeric($_GET['page']))
            {
                echo "Site not exist!";
                exit;
            }
        }

    }
    function sort_first_table()
        {
            echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'><tr>
            <th>LP</th>
            <th><a href='allbooks.php?sortby=book_id&dir=ASC'>ID &or;</a></th>
            <th><a href='allbooks.php?sortby=book_name&dir=ASC'>Book Name &or;</a></th>
            <th><a href='allbooks.php?sortby=author&dir=ASC'>Author &or;</a></th>
            <th><a href='allbooks.php?sortby=publishing_house&dir=ASC'>Publishing house &or;</a></th>
            <th><a href='allbooks.php?sortby=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
            <th><a href='allbooks.php?sortby=binding&dir=ASC'>Binding &or;</a></th>
            <th><a href='allbooks.php?sortby=availability&dir=ASC'>Availability &or;</a></th>
            </tr>";
        }
    if (!empty($_SESSION['sortby1']) && !empty($_SESSION['dir']))
    {





        if ($_SESSION['sortby1'] == "book_id")
        {
            if ($_SESSION['dir'] == "ASC")
            {
                echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'><tr>
                <th>LP</th>
                <th><a href='allbooks.php?sortby=book_id&dir=DESC'>ID &and;</a></th>
                <th><a href='allbooks.php?sortby=book_name&dir=ASC'>Book Name &or;</a></th>
                <th><a href='allbooks.php?sortby=author&dir=ASC'>Author &or;</a></th>
                <th><a href='allbooks.php?sortby=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                <th><a href='allbooks.php?sortby=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                <th><a href='allbooks.php?sortby=binding&dir=ASC'>Binding &or;</a></th>
                <th><a href='allbooks.php?sortby=availability&dir=ASC'>Availability &or;</a></th>
                </tr>";
            }

            else if ($_SESSION['dir'] == "DESC")
            {
                sort_first_table();
            }
        }
            if ($_SESSION['sortby1'] == "book_name")
            {
                if ($_SESSION['dir'] == "ASC")
                {
                    echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'><tr>
                    <th>LP</th>
                    <th><a href='allbooks.php?sortby=book_id&dir=ASC'>ID &or;</a></th>
                    <th><a href='allbooks.php?sortby=book_name&dir=DESC'>Book Name &and;</a></th>
                    <th><a href='allbooks.php?sortby=author&dir=ASC'>Author &or;</a></th>
                    <th><a href='allbooks.php?sortby=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                    <th><a href='allbooks.php?sortby=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                    <th><a href='allbooks.php?sortby=binding&dir=ASC'>Binding &or;</a></th>
                    <th><a href='allbooks.php?sortby=availability&dir=ASC'>Availability &or;</a></th>
                    </tr>";
                }

                else if ($_SESSION['dir'] == "DESC")
                {
                    sort_first_table();
                }
            }

            if ($_SESSION['sortby1'] == "author")
            {
                if ($_SESSION['dir'] == "ASC")
                {

                    echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'><tr>
                    <th>LP</th>
                    <th><a href='allbooks.php?sortby=book_id&dir=ASC'>ID &or;</a></th>
                    <th><a href='allbooks.php?sortby=book_name&dir=ASC'>Book Name &or;</a></th>
                    <th><a href='allbooks.php?sortby=author&dir=DESC'>Author &and;</a></th>
                    <th><a href='allbooks.php?sortby=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                    <th><a href='allbooks.php?sortby=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                    <th><a href='allbooks.php?sortby=binding&dir=ASC'>Binding &or;</a></th>
                    <th><a href='allbooks.php?sortby=availability&dir=ASC'>Availability &or;</a></th>
                    </tr>";
                }

                else if ($_SESSION['dir'] == "DESC")
                {
                    sort_first_table();
                }
        }


            if ($_SESSION['sortby1'] == "publishing_house")
            {
                if ($_SESSION['dir'] == "ASC")
                {
                    echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'><tr>
                    <th>LP</th>
                    <th><a href='allbooks.php?sortby=book_id&dir=ASC'>ID &or;</a></th>
                    <th><a href='allbooks.php?sortby=book_name&dir=ASC'>Book Name &or;</a></th>
                    <th><a href='allbooks.php?sortby=author&dir=ASC'>Author &or;</a></th>
                    <th><a href='allbooks.php?sortby=publishing_house&dir=DESC'>Publishing house &and;</a></th>
                    <th><a href='allbooks.php?sortby=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                    <th><a href='allbooks.php?sortby=binding&dir=ASC'>Binding &or;</a></th>
                    <th><a href='allbooks.php?sortby=availability&dir=ASC'>Availability &or;</a></th>
                    </tr>";
                }

                else if ($_SESSION['dir'] == "DESC")
                {
                    sort_first_table();
                }
           }

            if ($_SESSION['sortby1'] == "year_of_publication")
            {
                if ($_SESSION['dir'] == "ASC")
                {

                    echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'><tr>
                    <th>LP</th>
                    <th><a href='allbooks.php?sortby=book_id&dir=ASC'>ID &or;</a></th>
                    <th><a href='allbooks.php?sortby=book_name&dir=ASC'>Book Name &or;</a></th>
                    <th><a href='allbooks.php?sortby=author&dir=ASC'>Author &or;</a></th>
                    <th><a href='allbooks.php?sortby=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                    <th><a href='allbooks.php?sortby=year_of_publication&dir=DESC'>Year of publication &and;</a></th>
                    <th><a href='allbooks.php?sortby=binding&dir=ASC'>Binding &or;</a></th>
                    <th><a href='allbooks.php?sortby=availability&dir=ASC'>Availability &or;</a></th>
                    </tr>";
                    }

                else if ($_SESSION['dir'] == "DESC")
                {
                    sort_first_table();
                }
            }


            if ($_SESSION['sortby1'] == "binding")
            {
                if ($_SESSION['dir'] == "ASC")
                {

                    echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'><tr>
                    <th>LP</th>
                    <th><a href='allbooks.php?sortby=book_id&dir=ASC'>ID &or;</a></th>
                    <th><a href='allbooks.php?sortby=book_name&dir=ASC'>Book Name &or;</a></th>
                    <th><a href='allbooks.php?sortby=author&dir=ASC'>Author &or;</a></th>
                    <th><a href='allbooks.php?sortby=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                    <th><a href='allbooks.php?sortby=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                    <th><a href='allbooks.php?sortby=binding&dir=DESC'>Binding &and;</a></th>
                    <th><a href='allbooks.php?sortby=availability&dir=ASC'>Availability &or;</a></th>
                    </tr>";
                    }

                else if ($_SESSION['dir'] == "DESC")
                {
                    sort_first_table();
                }
            }

            if ($_SESSION['sortby1'] == "availability")
            {
                if ($_SESSION['dir'] == "ASC")
                {

                    echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'><tr>
                    <th>LP</th>
                    <th><a href='allbooks.php?sortby=book_id&dir=ASC'>ID &or;</a></th>
                    <th><a href='allbooks.php?sortby=book_name&dir=ASC'>Book Name &or;</a></th>
                    <th><a href='allbooks.php?sortby=author&dir=ASC'>Author &or;</a></th>
                    <th><a href='allbooks.php?sortby=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                    <th><a href='allbooks.php?sortby=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                    <th><a href='allbooks.php?sortby=binding&dir=ASC'>Binding &or;</a></th>
                    <th><a href='allbooks.php?sortby=availability&dir=DESC'>Availability &and;</a></th>
                    </tr>";
                 }

                else if ($_SESSION['dir'] == "DESC")
                {
                    sort_first_table();
                }
            }
    }


    else 
        {
        echo
        "<table bgcolor=#EEEEEE border=1 align=center  width='920'><tr>
        <th>LP</th>
        <th><a href='allbooks.php?sortby=book_id&dir=ASC'>ID &or;</a></th>
        <th><a href='allbooks.php?sortby=book_name&dir=ASC'>Book Name &or;</a></th>
        <th><a href='allbooks.php?sortby=author&dir=ASC'>Author &or;</a></th>
        <th><a href='allbooks.php?sortby=publishing_house&dir=ASC'>Publishing house &or;</a></th>
        <th><a href='allbooks.php?sortby=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
        <th><a href='allbooks.php?sortby=binding&dir=ASC'>Binding &or;</a></th>
        <th><a href='allbooks.php?sortby=availability&dir=ASC'>Availability &or;</a></th>";
        }




//echo $num_of_pages;



    if ((empty($_GET['page'])) || ($_GET['page']) == 1 )
    {
        $how_much_loops = 0;

        for ($i = 0; $i <= mysql_num_rows($result); $i++)
        {
            $i =  mysql_real_escape_string($i);
            if (isset($_SESSION['sortby1']) && isset($_SESSION['dir']))
            {
                $sortby = $_SESSION['sortby1'];
                $dir = $_SESSION['dir'];
                $sortby = mysql_real_escape_string($sortby);
                $dir = mysql_real_escape_string($dir);
                $query = "SELECT * from table_books ORDER BY $sortby $dir, book_id ASC LIMIT 10 OFFSET $i";
            }
            
            else $query = "SELECT * from table_books LIMIT 10 OFFSET $i";
             //$query = "SELECT * from table_books ORDER BY book_name DESC LIMIT 10 OFFSET $i";

            if ($how_much_loops >= 10) break;
            echo "<tr>";
            
            $result = mysql_query($query) or die(mysql_error());
            $row = mysql_fetch_array($result, MYSQL_BOTH);
            
            if ($row['binding'] == 1)
            $row['binding'] = "hard";
            else $row['binding'] = "soft";

            if ($row['availability'] == 2)
                $row['availability'] = "available";
            else if ($row['availability'] == 0)
                    $row['availability'] = "not available";
            else if ($row['availability'] == 1)
                $row['availability'] = "ordered";    
            $book_id = $row['book_id'];
            echo "<td>".($i+1)."</td>";
            echo "<td>".$row['book_id']."</td>";
            echo "<td>".$row['book_name']."</td>";
            echo "<td>".$row['author']."</td>";
            echo "<td>".$row['publishing_house']."</td>";
            echo "<td>".$row['year_of_publication']."</td>";
            echo "<td>".$row['binding']."</td>";
            echo "<td>".$row['availability'] ;
  
             
            if ($row['availability'] == "available")
            {
                if (isset($_SESSION['logged']))
                {
                    if (($_SESSION["logged"] == 2))
                    {
                        echo "<a href='order_book.php?book_id=$book_id'> | Order</a>";
                        
                    }
                    echo "</td>";
                }
            }
            echo "</td>";
            

            $how_much_loops++;
         }
    echo "</tr></table>";
    }



//  Wyświetlenie książek dla page 2 i więcej
    if (isset($_GET['page']))
        if (($_GET['page'])>=2)
        {
            $num_of_pages = ceil($counter/10);
            $from_which = ((($_GET['page'])*10)-10);
            $to_which = $from_which+9;
            $how_much_loops = 0;


            for ($i = $from_which; $i <=$to_which; $i++)
            {
                $i =  mysql_real_escape_string($i);
                if (isset($_SESSION['sortby1']) && isset($_SESSION['dir']))
                {
                $sortby = $_SESSION['sortby1'];
                $dir = $_SESSION['dir'];    
                $query = "SELECT * from table_books ORDER BY $sortby $dir, book_id ASC LIMIT 10 OFFSET $i";
                }
                else $query = "SELECT * from table_books LIMIT 10 OFFSET $i";
                
                $result = mysql_query($query) or die(mysql_error());
                $row = mysql_fetch_array($result, MYSQL_BOTH);
                
                                
                if ($i>=$counter) break;

                if ($how_much_loops >= 10) break;
                echo "<tr>";



                if ($row['binding'] == 1)
                $row['binding'] = "hard";
                else $row['binding'] = "soft";

                if ($row['availability'] == 1)
                $row['availability'] = "ordered";
                else if  ($row['availability'] == 0)
                   $row['availability'] = "not available";
                else if ($row['availability'] ==2)
                $row['availability'] = "available";
                
                $del_id = $row['book_id'];
                $edit_id = $row['book_id'];
                $book_id = $row['book_id'];
                echo "<td>".($i+1)."</td>";
                echo "<td>".$row['book_id']."</td>";
                echo "<td>".$row['book_name']."</td>";
                echo "<td>".$row['author']."</td>";
                echo "<td>".$row['publishing_house']."</td>";
                echo "<td>".$row['year_of_publication']."</td>";
                echo "<td>".$row['binding']."</td>";
                echo "<td>".$row['availability'] ;
                if ($row['availability'] == "available")
                {
                    if (isset($_SESSION['logged']))
                    {
                        if (($_SESSION["logged"] == 2))
                        {
                            echo "<a href='order_book.php?book_id=$book_id'> | Order</a>";
                        }
                        echo "</td>";
                    }
                }
                else echo "</td>";
                
                $how_much_loops++;
                
            }
            echo "</tr></table>";
       }
       echo "<div style='text-align: left;'>";

      
       // Numeracja dolna
       if (isset($_GET['page']))
        {
            $a = 1;
            $two = 2;
            $next_page = $page+1;
            $previous_page = $page-1;
            if (($page)<=$num_of_pages)
            {
                echo "</tr></table>";
                 if ($_GET['page'] >= 2)
                 {
                     echo "<a href='allbooks.php?page=$previous_page'> < </a> ";
                 }
             }


             for ($i=1; $i<=$num_of_pages; $i++)
             {
                 if ($_GET['page'] == $i)
                 echo "<a href='allbooks.php?page=$i'> <b>$i</b> </a> ";
                 else
                    echo "<a href='allbooks.php?page=$i'> $i </a> "; 
                 if ($i==50*$a)
                 {
                     echo "br/>";
                     $a++;
                 }
             }

             if (($_GET['page'])>=1 )
             {

                 if ($num_of_pages > ($_GET['page']))
                 {
                     echo "<a href='allbooks.php?page=$next_page'> > </a> ";
                 }
             }

              if (($_GET['page']) == NULL)
                 {
                     if ($num_of_pages > 1)
                     echo "<a href='allbooks.php?page=$two'> > </a> ";
                 }
                 echo "</div>";
         }

         else
         {
                
            $next_page = 2;
            $num_of_pages = ceil($counter/10);
            $two = 2;
            $a = 1;
            for ($i=1; $i<=$num_of_pages; $i++)
            {
                if ($i == 1)
                echo "<a href='allbooks.php?page=$i'> <b>$i</b> </a> ";   
                else echo "<a href='allbooks.php?page=$i'> $i </a> ";
                if ($i==50*$a)
                {
                    echo "br/>";
                    $a++;
                }
            }

            if ($num_of_pages > 1)
            {
                echo "<a href='allbooks.php?page=$next_page'> > </a> ";
            }
        } 
         echo "</div>";
}
// Przycisk odśwież
    echo "<div style='text-align: center;'><br /><input type='button' style='padding:20px;' value=' Refresh ' onClick='parent.location.href=\"allbooks.php?sortby=book_id&dir=ASC\"' />
    <br><br></div>";

disconnect();
 ?>
                                            </div>             
					</div>


				</div>
				<!--koniec div srodkowa czesc zawartosci-->
				<div id="dolna_czesc_zawartosci"></div>

			</div>

		<div id="stopka">
			&copy; 2015  created by Matys

		</div>


	  </div>
	  <!-- koniec div kontener-->
	</div>




	</body>
</html>
