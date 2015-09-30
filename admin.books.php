<?php
include_once 'include/session.start.inc.php';
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include "include/meta.inc.php";
?>

<title>Admin Books</title>

</head>
<body>
	<div align="center">
		<div id="kontener">
                    <header>
                    <h1>Library</h1>
                    <aside>
                    <div id="panel">
                            <section>
                            <div id="formularz"><?php include_once 'include/login.user.php'; ?>




                            </div>
                            </section>
                            <section>
                            <div id="zegar">

                            <script type="text/javascript" src="script.js"></script>
                            </section>
                    </div>
                    </aside>    
                        
                    
                    
                    </header>
                <section>        
                <div id="gorna_czesc_kontenera">
               </div>
                </section>    


	    	
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
if (isset($_SESSION['logged']))
$_SESSION['logged'] = filter_var($_SESSION['logged'], FILTER_SANITIZE_STRING);

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



if (isset($_SESSION["logged"]))
{
    if ($_SESSION["logged"] == 3 )
    {
        connect();
        $choosedb = mysql_select_db("matys_baza");
        clean('sortby1', $sortby);
        clean('dir', $dir);
        clean('page', $page);
        
        /*
        if (isset($_GET['sortby1']))
        {
            $_GET['sortby1'] = filter_var($_GET['sortby1'], FILTER_SANITIZE_STRING);
            $_SESSION['sortby1'] = $_GET['sortby1'];
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
        }
        */
        $query = "SELECT book_id from table_books
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
                    {
                        if (!is_numeric($_GET['page']))
                        {
                            echo "Site not exist!";
                            exit;
                        }
                    }
                }

            }
            function sort_first_table()
            {

                echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                    <tr>
                        <th>LP</th>
                        <th><a href='admin.books.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                        <th><a href='admin.books.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                        <th><a href='admin.books.php?sortby1=author&dir=ASC'>Author &or;</a></th>
                        <th><a href='admin.books.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                        <th><a href='admin.books.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                        <th><a href='admin.books.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                        <th><a href='admin.books.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                        <th>OPTIONS</th>
                    </tr>
                ";
            }
            if (!empty($_SESSION['sortby1']) && !empty($_SESSION['dir']))
            {





                if ($_SESSION['sortby1'] == "book_id")
                {
                    if ($_SESSION['dir'] == "ASC")
                    {

                        echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                            <tr>
                                <th>LP</th>
                                <th><a href='admin.books.php?sortby1=book_id&dir=DESC'>ID &and;</a></th>
                                <th><a href='admin.books.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                                <th><a href='admin.books.php?sortby1=author&dir=ASC'>Author &or;</a></th>
                                <th><a href='admin.books.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                                <th><a href='admin.books.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                                <th><a href='admin.books.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                                <th><a href='admin.books.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                                <th>OPTIONS</th>
                            </tr>
                        ";
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

                            echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                                <tr>
                                    <th>LP</th>
                                    <th><a href='admin.books.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                                    <th><a href='admin.books.php?sortby1=book_name&dir=DESC'>Book Name &and;</a></th>
                                    <th><a href='admin.books.php?sortby1=author&dir=ASC'>Author &or;</a></th>
                                    <th><a href='admin.books.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                                    <th><a href='admin.books.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                                    <th><a href='admin.books.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                                    <th><a href='admin.books.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                                    <th>OPTIONS</th>
                                </tr>
                            ";
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


                        echo
                                "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                                        <tr>
                                            <th>LP</th>
                                            <th><a href='admin.books.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=author&dir=DESC'>Author &and;</a></th>
                                            <th><a href='admin.books.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                                            <th>OPTIONS</th>
                                        </tr>
                                    ";
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

                            echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                                        <tr>
                                            <th>LP</th>
                                            <th><a href='admin.books.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=author&dir=ASC'>Author &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=publishing_house&dir=DESC'>Publishing house &and;</a></th>
                                            <th><a href='admin.books.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                                            <th>OPTIONS</th>
                                        </tr>
                                    ";
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
                             
                        echo   "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                                    <tr>
                                        <th>LP</th>
                                        <th><a href='admin.books.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                                        <th><a href='admin.books.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                                        <th><a href='admin.books.php?sortby1=author&dir=ASC'>Author &or;</a></th>
                                        <th><a href='admin.books.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                                        <th><a href='admin.books.php?sortby1=year_of_publication&dir=DESC'>Year of publication &and;</a></th>
                                        <th><a href='admin.books.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                                        <th><a href='admin.books.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                                        <th>OPTIONS</th>
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
                            
                            echo   
                                "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                                        <tr>
                                            <th>LP</th>
                                            <th><a href='admin.books.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=author&dir=ASSC'>Author &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                                            <th><a href='admin.books.php?sortby1=binding&dir=DESC'>Binding &and;</a></th>
                                            <th><a href='admin.books.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                                            <th>OPTIONS</th>
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
                           
                            echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                                            <tr>
                                                <th>LP</th>
                                                <th><a href='admin.books.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                                                <th><a href='admin.books.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                                                <th><a href='admin.books.php?sortby1=author&dir=ASSC'>Author &or;</a></th>
                                                <th><a href='admin.books.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                                                <th><a href='admin.books.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                                                <th><a href='admin.books.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                                                <th><a href='admin.books.php?sortby1=availability&dir=DESC'>Availability &and;</a></th>
                                                <th>OPTIONS</th>
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
                    echo "<table bgcolor=#EEEEEE border=1 align=center  width='920'>
                        <tr>

                                <th>LP</th>
                                <th><a href='admin.books.php?sortby1=book_id&dir=ASC'>ID &or;</a></th>
                                <th><a href='admin.books.php?sortby1=book_name&dir=ASC'>Book Name &or;</a></th>
                                <th><a href='admin.books.php?sortby1=author&dir=ASC'>Author &or;</a></th>
                                <th><a href='admin.books.php?sortby1=publishing_house&dir=ASC'>Publishing house &or;</a></th>
                                <th><a href='admin.books.php?sortby1=year_of_publication&dir=ASC'>Year of publication &or;</a></th>
                                <th><a href='admin.books.php?sortby1=binding&dir=ASC'>Binding &or;</a></th>
                                <th><a href='admin.books.php?sortby1=availability&dir=ASC'>Availability &or;</a></th>
                                <th>OPTIONS</th>
                        </tr>";
                }




        //echo $num_of_pages;



             if ((empty($_GET['page'])) || ($_GET['page']) == 1 )
             {
                $how_much_loops = 0;
                $i = 0;
                while($row = mysql_fetch_assoc($result))
                {
                    $i =  mysql_real_escape_string($i);
                    if (isset($_SESSION['sortby1']) && (isset($_SESSION['dir'])))
                    {
                        $sortby = $_SESSION['sortby1'];
                        $dir = $_SESSION['dir'];
                        $query = "SELECT * from table_books ORDER BY $sortby $dir, book_id ASC LIMIT 10 OFFSET $i";
                    }
                    else $query = "SELECT * from table_books LIMIT 10 OFFSET $i";
                     //$query = "SELECT * from table_books ORDER BY book_name DESC LIMIT 10 OFFSET $i";

                    if ($how_much_loops >= 10) break;


                    $result = mysql_query($query) or die(mysql_error());
                    $row = mysql_fetch_assoc($result);
                    if ($row['binding'] == 1)
                    $row['binding'] = "hard";
                    else $row['binding'] = "soft";

                    if ($row['availability'] == 1)
                    $row['availability'] = "ordered";
                    else if  ($row['availability'] == 0)
                       $row['availability'] = "not available";
                    else if ($row['availability'] ==2)
                    $row['availability'] = "available";
                    $book_id = $row['book_id'];

                    
                    echo "<tr>";
                    echo "<td>".($i+1)."</td>";
                    echo "<td>".$row['book_id']."</td>";
                    echo "<td>".chunk_split($row['book_name'], 20, "<br>")."</td>";
                    echo "<td>".chunk_split($row['author'], 20, "<br>")."</td>";
                    echo "<td>".chunk_split($row['publishing_house'], 20, "<br>")."</td>";
                    echo "<td>".$row['year_of_publication']."</td>";
                    echo "<td>".$row['binding']."</td>";
                    echo "<td>".$row['availability']."</td>" ;
         
                    
             ////       orders////
                    if (isset($_SESSION['logged']))
                    {
                        if ($_SESSION["logged"] == 3)
                        {
                            echo "<td> <a href='admin.edit.book.php?book_id=$book_id'>edit</a> | <a href='admin.deletebook.php?book_id=$book_id' onclick='return confirm(\"Are you sure to delete?\")'>delete</a></td></tr>";
                            
                        }
                    }
                    $how_much_loops++;
                    $i++;
                }
            echo "</table>";
            }
            echo "<div style='text-align: left;'>";



            if (isset($_GET['page']))
            {
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

                        if ($i>=$counter) break;

                        $result = mysql_query($query) or die(mysql_error());
                        $row = mysql_fetch_assoc($result);

                        if ($how_much_loops >= 10) break;




                        if ($row['binding'] == 1)
                        $row['binding'] = "hard";
                        else $row['binding'] = "soft";

                        if ($row['availability'] == 1)
                        $row['availability'] = "ordered";
                        else if  ($row['availability'] == 0)
                        $row['availability'] = "not available";
                        else if ($row['availability'] ==2)
                        $row['availability'] = "available";
                        $book_id = $row['book_id'];
                        echo "<tr>";
                        echo "<td>".($i+1)."</td>";
                        echo "<td>".$row['book_id']."</td>";
                        echo "<td>".chunk_split($row['book_name'], 20, "<br>")."</td>";
                        echo "<td>".chunk_split($row['author'], 20, "<br>")."</td>";
                        echo "<td>".chunk_split($row['publishing_house'], 20, "<br>")."</td>";
                        echo "<td>".$row['year_of_publication']."</td>";
                        echo "<td>".$row['binding']."</td>";
                        echo "<td>".$row['availability']."</td>";
                        
                        echo "<td><a href='admin.edit.book.php?book_id=$book_id'>edit</a> | <a href='admin.deletebook.php?book_id=$book_id' onclick='return confirm(\"Are you sure?\")'>delete</a></td></tr>";
                        $how_much_loops++;
                    }
                    echo "</table>";
               } 
               echo "<div style='text-align: left;'>";
            }

               /*  page numbering  */

            if (isset($_GET['page']))
            {
                $page = filter_var($_GET['page'], FILTER_SANITIZE_NUMBER_INT);
                $a = 1;
                $two = 2;
                $next_page = $page+1;
                $previous_page = $page-1;
                if (($page)<=$num_of_pages)
                {
                    echo "</tr></table>";
                     if ($_GET['page'] >= 2)
                     {
                         echo "<a href='admin.books.php?page=$previous_page'> < </a> ";
                     }
                 }


                for ($i=1; $i<=$num_of_pages; $i++)
                {
                    if ($_GET['page'] == $i)
                    echo "<a href='admin.books.php?page=$i'> <b>$i</b> </a> ";
                    else
                       echo "<a href='admin.books.php?page=$i'> $i </a> "; 
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
                        echo "<a href='admin.books.php?page=$next_page'> > </a> ";
                    }
                }

                 if (($_GET['page']) == NULL)
                    {
                        if ($num_of_pages > 1)
                        echo "<a href='admin.books.php?page=$two'> > </a> ";
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
                    echo "<a href='admin.books.php?page=$i'> <b>$i</b> </a> ";   
                    else echo "<a href='admin.books.php?page=$i'> $i </a> ";
                    if ($i==50*$a)
                    {
                        echo "br/>";
                        $a++;
                    }
                }

                if ($num_of_pages > 1)
                {
                    echo "<a href='admin.books.php?page=$next_page'> > </a> ";
                }
            } 
             echo "</div>";
              /* End of page numbering  */
        }
        echo "<div style='text-align: center;'><br /><input type='button' style='padding:20px;' value=' Refresh ' onClick='parent.location.href=\"admin.books.php?sortby1=book_id&dir=ASC\"' />
        <form name='form' action='admin.add.book.php' method=post><br />
        <input type='submit' style='padding:20px;' value='Add book' method='post'></form>
        <br><br></div>";
         
        
    }
}
else echo "You don't have permissions";
disconnect();
error_reporting();
 ?>





                                        </div>
                                    </div>


				</div>
				<!--koniec div srodkowa czesc zawartosci-->
				<div id="dolna_czesc_zawartosci"></div>

			</div>
                <footer>        
		<div id="stopka">
			&copy; 2015  created by Matys

		</div>
                </footer>

	  </div>
	  <!-- koniec div kontener-->
	</div>




	</body>
</html>
