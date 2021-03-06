<?php
include_once 'include/session.start.inc.php';
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include 'include/meta.inc.php';

?>

<title>PHP Library</title>

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
		include "include/middle.menu.inc.php";
                /*if (!(isset($_SESSION['searchname'])))
                $_SESSION['searchname'] = ""; */   
		?>
		<!-- koniec div srodkowe menu-->

			<div id="zawartosc">
				<div id="gorna_czesc_zawartosci"></div>
				<div id="srodkowa_czesc_zawartosci">
					<div id="tekst">
                                            <div style="margin: 0 auto; text-align: center; ">

                                                Type author or book's name: <br />
                                                <form name="searchbar" method="post" action="searchbooks.php">
                                                    <input name="searchname" type="text" size="30" maxlength="40" value="<?php //if (isset($_SESSION['searchname'])) echo $_SESSION['searchname']; ?>">
                                                    <input type="submit" value="search">
                                                </form>
                                                <br>        

<?php
$db_h = connect();



if (isset($_SESSION['logged']))
$_SESSION['logged'] = filter_var($_SESSION['logged'], FILTER_SANITIZE_STRING);

if (isset($_GET['sortby1']))
{
$_GET['sortby1'] = filter_var($_GET['sortby1'], FILTER_SANITIZE_STRING);
$_SESSION['sortby1'] = $_GET['sortby1'];
$sortby = $_SESSION['sortby1'];
$sortby = mysqli_real_escape_string($db_h, $sortby);
}


if (isset($_GET['dir']))
{
$_GET['dir'] = filter_var($_GET['dir'], FILTER_SANITIZE_STRING);
$_SESSION['dir'] = $_GET['dir'];
$dir = $_SESSION['dir'];
$dir = mysqli_real_escape_string($db_h, $dir);
}


if (isset($_GET['page']))
{
$_GET['page'] = filter_var($_GET['page'], FILTER_SANITIZE_STRING);
$_SESSION['page'] = $_GET['page'];
$page = $_SESSION['page'];
}


if (isset($_POST['searchname']))
{
$_POST['searchname'] = filter_var($_POST['searchname'], FILTER_SANITIZE_STRING);
$_SESSION['searchname'] = $_POST['searchname'];
$searchname = $_SESSION['searchname'];
$searchname = mysqli_real_escape_string($db_h, $searchname);
}

if (isset($_SESSION['user_id']))
{
    $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_STRING);
    $user_id = mysqli_real_escape_string($db_h, $user_id);
}
        

if (isset($_SESSION['searchname']))
{
    if (!empty($_SESSION['searchname']))
    {
    $searchname = $_SESSION['searchname'];    
    $query = "
            SELECT book_id from table_books
            WHERE author LIKE '%$searchname%' OR book_name LIKE '%$searchname%'

            ";
        $result = mysqli_query($db_h, $query) or die(mysqli_error($db_h));
    
    
    
        $counter = mysqli_num_rows($result);
        $num_of_pages = ceil($counter/10);    
    
    
        if (isset($_GET['page']))
        {
            if (!empty($_GET['page']) )
            {

                $_GET['page'] = filter_var($_GET['page'], FILTER_SANITIZE_STRING);



                if (($_GET['page'] > $num_of_pages) )
                {
                    die ("Site not exist!");
                }


                if ($_GET['page']!=NULL)
                {
                    if (!is_numeric($_GET['page']))
                    {
                        die ("Site not exist!");
                    }
                }
            }

        }
        function sort_first_table()
        {
            echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'><tr>
            <th>LP</th>
            <th><a href='searchbooks.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
            <th><a href='searchbooks.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
            <th><a href='searchbooks.php?sortby1=author&dir=ASC'>Author &or;</a></th>
            <th><a href='searchbooks.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
            <th><a href='searchbooks.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
            <th><a href='searchbooks.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
            <th><a href='searchbooks.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
            </tr>";
        }
    if ((!empty($_SESSION['sortby1'])) && (!empty($_SESSION['dir'])))
    {

        if ($_SESSION['sortby1'] == "book_id")
        {
            if ($_SESSION['dir'] == "ASC")
            {
                echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'><tr>
                <th>LP</th>
                <th><a href='searchbooks.php?sortby1=book_id&dir=DESC'>ID &and;</a></th>
                <th><a href='searchbooks.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                <th><a href='searchbooks.php?sortby1=author&dir=ASC'>Author &or;</a></th>
                <th><a href='searchbooks.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                <th><a href='searchbooks.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                <th><a href='searchbooks.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                <th><a href='searchbooks.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                </tr>";
            }

            else if (($_SESSION['dir'] == "DESC") || empty($_SESSION['dir']))
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
                    <th><a href='searchbooks.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=book_name&dir=DESC'>Book Name &and;</a></th>
                    <th><a href='searchbooks.php?sortby1=author&dir=ASC'>Author &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                    </tr>";
                }

                else if (($_SESSION['dir'] == "DESC") || empty($_SESSION['dir']))
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
                    <th><a href='searchbooks.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=author&dir=DESC'>Author &and;</a></th>
                    <th><a href='searchbooks.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                    </tr>";
                }

                else if (($_SESSION['dir'] == "DESC") || empty($_SESSION['dir']))
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
                    <th><a href='searchbooks.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=author&dir=ASC'>Author &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=publishing_house&dir=DESC'>Publishing house &and;</a></th>
                    <th><a href='searchbooks.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                    </tr>";
                }

                else if (($_SESSION['dir'] == "DESC") || empty($_SESSION['dir']))
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
                    <th><a href='searchbooks.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=author&dir=ASC'>Author &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=year_of_publication&dir=DESC'>Year of publication &and;</a></th>
                    <th><a href='searchbooks.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                    </tr>";
                    }

                else if (($_SESSION['dir'] == "DESC") || empty($_SESSION['dir']))
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
                    <th><a href='searchbooks.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=author&dir=ASC'>Author &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=binding&dir=DESC'>Binding &and;</a></th>
                    <th><a href='searchbooks.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                    </tr>";
                    }

                else if (($_SESSION['dir'] == "DESC") || empty($_SESSION['dir']))
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
                    <th><a href='searchbooks.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=author&dir=ASC'>Author &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                    <th><a href='searchbooks.php?sortby1=availability&dir=DESC'>Availability &and;</a></th>
                    </tr>";
                 }

                else if (($_SESSION['dir'] == "DESC") || empty($_SESSION['dir']))
                {
                    sort_first_table();
                }
            }
        }
    else {
    echo
    "<table bgcolor=#EEEEEE border=1 align=center  width='920'><tr>
    <th>LP</th>
    <th><a href='searchbooks.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
    <th><a href='searchbooks.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
    <th><a href='searchbooks.php?sortby1=author&dir=ASC'>Author &or;</a></th>
    <th><a href='searchbooks.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
    <th><a href='searchbooks.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
    <th><a href='searchbooks.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
    <th><a href='searchbooks.php?sortby1=availability&dir=ASC'>Availability &or;</a></th></tr>";
    }



//numeracja

    if ((empty($_GET['page'])) || ($_GET['page']) == 1 )
    {
        $query = "
            SELECT * from table_books
            WHERE author LIKE '%$searchname%' OR book_name LIKE '%$searchname%'

            ";
        if (!empty($query))
        $result = mysqli_query($db_h, $query) or die(mysqli_error($db_h));
        else "empty";
        $how_much_loops = 0;
        $i = 0;
        if (empty($result))
        {
            echo "empty";
        }
        else
        {
            while($row = mysqli_fetch_assoc($result))
            {

                $i =  mysqli_real_escape_string($db_h, $i);
                if (isset($_SESSION['sortby1'])&& isset($_SESSION['dir']))
                {
                    //if (!empty($_GET['sortby1']) && !empty($_GET['dir']))  - przy włącznonym wyświetla to samo 10 razy
                    $sortby = $_SESSION['sortby1'];
                    $dir = $_SESSION['dir'];
                    $query = "SELECT * from table_books WHERE author LIKE '%$searchname%' OR book_name LIKE '%$searchname%' ORDER BY $sortby $dir, book_id ASC LIMIT 10 OFFSET $i";
                }
                else  $query = "SELECT * from table_books WHERE author LIKE '%$searchname%' OR book_name LIKE '%$searchname%' LIMIT 10 OFFSET $i";
                 //$query = "SELECT * from table_books ORDER BY book_name DESC LIMIT 10 OFFSET $i";
                $result = mysqli_query($db_h, $query) or die(mysqli_error($db_h));
                $row = mysqli_fetch_assoc($result);
                if ($how_much_loops >= 10) break;
                echo "<tr>";


                if ($row['binding'] == 1)
                $row['binding'] = "hard";
                else $row['binding'] = "soft";

                if ($row['availability'] == 2)
                    $row['availability'] = "available";
                elseif ($row['availability'] == 1)
                    $row['availability'] = "ordered";
                else $row['availability'] = "not available";
                $book_id = $row['book_id'];
                echo "<td>".($i+1)."</td>";
                echo "<td>".$row['book_id']."</td>"; 
                echo "<td>".chunk_split($row['book_name'], 20, "<br>")."</td>";
                echo "<td>".chunk_split($row['author'], 20, "<br>")."</td>";
                echo "<td>".chunk_split($row['publishing_house'], 20, "<br>")."</td>";
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
                    else echo "</td>";
                }

                $how_much_loops++;
                $i++;
            }
        echo "</tr></table>";
        }
    } 



    if (isset($_GET['page']))
    {
        if (($_GET['page'])>=2)
        {
            $num_of_pages = ceil($counter/10);
            $from_which = ((($_GET['page'])*10)-10);
            $to_which = $from_which+9;

            $how_much_loops = 0;

            //$sortby = $_SESSION['sortby1'];

            for ($i = $from_which; $i <=$to_which; $i++)
            {

                $i =  mysqli_real_escape_string($db_h, $i);
                if (isset($_SESSION['sortby1'])&& isset($_SESSION['dir']))
                {
                    $sortby = $_SESSION['sortby1'];
                    $dir = $_SESSION['dir'];
                    $query = "SELECT * from table_books WHERE author LIKE '%$searchname%' OR book_name LIKE '%$searchname%' ORDER BY $sortby $dir, book_id ASC LIMIT 10 OFFSET $i";
                }
                else  $query = "SELECT * from table_books WHERE author LIKE '%$searchname%' OR book_name LIKE '%$searchname%' LIMIT 10 OFFSET $i";

                if ($i>=$counter) break;

                $result = mysqli_query($db_h, $query) or die(mysqli_error($db_h));
                $row = mysqli_fetch_assoc($result);

                if ($how_much_loops >= 10) break;
                echo "<tr>";



                if ($row['binding'] == 1)
                $row['binding'] = "hard";
                else $row['binding'] = "soft";

                if ($row['availability'] == 2)
                    $row['availability'] = "available";
                elseif ($row['availability'] == 1)
                    $row['availability'] = "ordered";
                else $row['availability'] = "not available";

                $del_id = $row['book_id'];
                $edit_id = $row['book_id'];
                echo "<td>".($i+1)."</td>";
                echo "<td>".$row['book_id']."</td>";
                $book_id = $row['book_id'];
                echo "<td>".chunk_split($row['book_name'], 20, "<br>")."</td>";
                echo "<td>".chunk_split($row['author'], 20, "<br>")."</td>";
                echo "<td>".chunk_split($row['publishing_house'], 20, "<br>")."</td>";
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
    }
} 

}
/*else 
    {
    echo
    "<table bgcolor=#EEEEEE border=1 align=center  width='920'><tr>
    <th>LP</th>
    <th><a href='searchbooks.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
    <th><a href='searchbooks.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
    <th><a href='searchbooks.php?sortby1=author&dir=ASC'>Author &or;</a></th>
    <th><a href='searchbooks.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
    <th><a href='searchbooks.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
    <th><a href='searchbooks.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
    <th><a href='searchbooks.php?sortby1=availability&dir=ASC'>Availability &or;</a></th></tr></table>";
    }
*/
if (isset($_GET['page']))
{
    $page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);
    echo "<div style='text-align: left;'>";
    $a = 1;
    $two = 2;
    $next_page = $page+1;
    $previous_page = $page-1;
    if (($page)<=$num_of_pages)
    {
    echo "</tr></table>";
    if ($_GET['page'] >= 2)
        {
            echo "<a href='searchbooks.php?page=$previous_page'> < </a> ";
        }
    }


    for ($i=1; $i<=$num_of_pages; $i++)
    {
        if ($_GET['page'] == $i)
        echo "<a href='searchbooks.php?page=$i'> <b>$i</b> </a> ";
        else
           echo "<a href='searchbooks.php?page=$i'> $i </a> "; 
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
            echo "<a href='searchbooks.php?page=$next_page'> > </a> ";
        }
    }

    if (($_GET['page']) == NULL)
       {
           if ($num_of_pages > 1)
           echo "<a href='searchbooks.php?page=$two'> > </a> ";
       }
       echo "</div>";
}

 else
{
    echo "<div style='text-align: left;'>"; 
    $next_page = 2;
    if (isset($counter))
    $num_of_pages = ceil($counter/10);
    $two = 2;
    $a = 1;
    if (isset($num_of_pages))
        if ($num_of_pages != 1)            
    for ($i=1; $i<=$num_of_pages; $i++)
    {
       if ($i == 1)
       echo "<a href='searchbooks.php?page=$i'> <b>$i</b> </a> ";   
       else echo "<a href='searchbooks.php?page=$i'> $i </a> ";
       if ($i==50*$a)
       {
           echo "br/>";
           $a++;
       }
    }
    if (isset($num_of_pages))
    if ($num_of_pages > 1)
    {
         echo "<a href='searchbooks.php?page=$next_page'> > </a> ";
    }
} 
    
echo "</div>";
echo "<div style='text-align: center;'>";
echo "<br /><input type='button' style='padding:20px;' value=' Refresh ' onClick='parent.location.href=\"searchbooks.php?sortby1=book_id&dir=ASC\"' />
<br><br>";
echo "</div>";
disconnect();;

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
