<?php
include_once 'include/session.start.inc.php';
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include_once  'include/meta.inc.php';
?>

<title>PHP Library</title>

</head>
<body onload="zegar();">
	<div align="center">		
		<div id="kontener">
			<div id="panel">
				<div id="formularz"><?php include_once 'include/login.user.php'; ?>
		
				
				
				
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
		include_once 'include/middle.menu.inc.php';
		?>
		<!-- koniec div srodkowe menu-->
		
			<div id="zawartosc">
				<div id="gorna_czesc_zawartosci"></div>
				<div id="srodkowa_czesc_zawartosci">
					<div id="tekst">
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
        clean('sortby', $sortby);
        clean('dir', $dir);
        clean('page', $page);
        
        
        $query = "SELECT returned_id FROM returned_books
                  ";




        $result = mysql_query($query) or die(mysql_error());
        if (empty ($result))
        {
            die ("Empty database");
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
            function sort_first_table()
            {

                echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                    <tr>
                        <th>LP</th>
                        <th><a href='admin.history.php?sortby=returned_id&dir=ASC'>Returned ID &or;</a></th>
                        <th><a href='admin.history.php?sortby=borrowed_id&dir=ASC'>Borrowed ID &and;</a></th>
                        <th><a href='admin.history.php?sortby=returned_id&dir=ASC'>Book ID &or;</a></th>
                        <th><a href='admin.history.php?sortby=user_id&dir=ASC'>User ID &or;</a></th>
                        <th><a href='admin.history.php?sortby=date_borrowed_book&dir=ASC'>Date borrowed book &or;</a></th>
                        <th><a href='admin.history.php?sortby=date_of_return&dir=ASC'>Date of return book &or;</a></th>
                    </tr>
                ";
            }
            if (!empty($_SESSION['sortby']) && !empty($_SESSION['dir']))
            {





                if ($_SESSION['sortby'] == "returned_id")
                {
                    if ($_SESSION['dir'] == "ASC")
                    {

                        echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                            <tr>
                                <th>LP</th>
                                <th><a href='admin.history.php?sortby=returned_id&dir=DESC'>Returned ID &and;</a></th>
                                <th><a href='admin.history.php?sortby=borrowed_id&dir=ASC'>Borrowed ID &and;</a></th>
                                <th><a href='admin.history.php?sortby=returned_id&dir=ASC'>Book ID &or;</a></th>
                                <th><a href='admin.history.php?sortby=user_id&dir=ASC'>User ID &or;</a></th>
                                <th><a href='admin.history.php?sortby=date_borrowed_book&dir=ASC'>Date borrowed book &or;</a></th>
                                <th><a href='admin.history.php?sortby=date_of_return&dir=ASC'>Date of return book &or;</a></th>
                            </tr>
                        ";
                    }

                    else if ($_SESSION['dir'] == "DESC")
                    {
                        sort_first_table();
                    }
                }
                if ($_SESSION['sortby'] == "borrowed_id")
                {
                    if ($_SESSION['dir'] == "ASC")
                    {

                            echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                                <tr>
                                    <th>LP</th>
                                    <th><a href='admin.history.php?sortby=returned_id&dir=ASC'>Returned ID &or;</a></th>
                                    <th><a href='admin.history.php?sortby=borrowed_id&dir=DESC'>Borrowed ID &and;</a></th>
                                    <th><a href='admin.history.php?sortby=returned_id&dir=ASC'>Book ID &or;</a></th>
                                    <th><a href='admin.history.php?sortby=user_id&dir=ASC'>User ID &or;</a></th>
                                    <th><a href='admin.history.php?sortby=date_borrowed_book&dir=ASC'>Date borrowed book &or;</a></th>
                                    <th><a href='admin.history.php?sortby=date_of_return&dir=ASC'>Date of return book &or;</a></th>
                                </tr>
                            ";
                    }

                    else if ($_SESSION['dir'] == "DESC")
                    {
                        sort_first_table();
                    }
                }

                if ($_SESSION['sortby'] == "book_id")
                {
                    if ($_SESSION['dir'] == "ASC")
                    {


                        echo
                            "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                                <tr>
                                    <th>LP</th>
                                    <th><a href='admin.history.php?sortby=returned_id&dir=ASC'>Returned ID &or;</a></th>
                                    <th><a href='admin.history.php?sortby=borrowed_id&dir=ASC'>Borrowed ID &and;</a></th>
                                    <th><a href='admin.history.php?sortby=returned_id&dir=DESC'>Book ID &and;</a></th>
                                    <th><a href='admin.history.php?sortby=user_id&dir=ASC'>User ID &or;</a></th>
                                    <th><a href='admin.history.php?sortby=date_borrowed_book&dir=ASC'>Date borrowed book &or;</a></th>
                                    <th><a href='admin.history.php?sortby=date_of_return&dir=ASC'>Date of return book &or;</a></th>
                                </tr>
                                ";
                    }

                    else if ($_SESSION['dir'] == "DESC")
                    {
                        sort_first_table();
                    }
                }


                if ($_SESSION['sortby'] == "user_id")
                {
                    if ($_SESSION['dir'] == "ASC")
                    {

                            echo  "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                                <tr>
                                    <th>LP</th>
                                    <th><a href='admin.history.php?sortby=returned_id&dir=ASC'>Returned ID &or;</a></th>
                                    <th><a href='admin.history.php?sortby=borrowed_id&dir=ASC'>Borrowed ID &and;</a></th>
                                    <th><a href='admin.history.php?sortby=returned_id&dir=ASC'>Book ID &or;</a></th>
                                    <th><a href='admin.history.php?sortby=user_id&dir=DESC'>User ID &and;</a></th>
                                    <th><a href='admin.history.php?sortby=date_borrowed_book&dir=ASC'>Date borrowed book &or;</a></th>
                                    <th><a href='admin.history.php?sortby=date_of_return&dir=ASC'>Date of return book &or;</a></th>
                                </tr>
                                    ";
                    }

                    else if ($_SESSION['dir'] == "DESC")
                    {
                        sort_first_table();
                    }
                }

                if ($_SESSION['sortby'] == "date_borrowed_book")
                {
                    if ($_SESSION['dir'] == "ASC")
                    {
                             
                        echo   "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                            <tr>
                                <th>LP</th>
                                <th><a href='admin.history.php?sortby=returned_id&dir=ASC'>Returned ID &or;</a></th>
                                <th><a href='admin.history.php?sortby=borrowed_id&dir=ASC'>Borrowed ID &and;</a></th>
                                <th><a href='admin.history.php?sortby=returned_id&dir=ASC'>Book ID &or;</a></th>
                                <th><a href='admin.history.php?sortby=user_id&dir=ASC'>User ID &or;</a></th>
                                <th><a href='admin.history.php?sortby=date_borrowed_book&dir=DESC'>Date borrowed book &and;</a></th>
                                <th><a href='admin.history.php?sortby=date_of_return&dir=ASC'>Date of return book &or;</a></th>
                            </tr>";
                        }

                    else if ($_SESSION['dir'] == "DESC")
                    {
                        sort_first_table();
                    }
                }


                    if ($_SESSION['sortby'] == "date_of_return")
                    {
                        if ($_SESSION['dir'] == "ASC")
                        {
                            
                            echo   
                                "<table bgcolor=#EEEEEE border=1 align=center width='920'>

                                    <tr>
                                        <th>LP</th>
                                        <th><a href='admin.history.php?sortby=returned_id&dir=ASC'>Returned ID &or;</a></th>
                                        <th><a href='admin.history.php?sortby=borrowed_id&dir=ASC'>Borrowed ID &and;</a></th>
                                        <th><a href='admin.history.php?sortby=returned_id&dir=ASSC'>Book ID &or;</a></th>
                                        <th><a href='admin.history.php?sortby=user_id&dir=ASC'>User ID &or;</a></th>
                                        <th><a href='admin.history.php?sortby=date_borrowed_book&dir=ASC'>Date borrowed book &or;</a></th>
                                        <th><a href='admin.history.php?sortby=date_of_return&dir=DESC'>Date of return book &and;</a></th>
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
                            <th><a href='admin.history.php?sortby=returned_id&dir=ASC'>Returned ID &or;</a></th>
                            <th><a href='admin.history.php?sortby=borrowed_id&dir=ASC'>Borrowed ID &and;</a></th>
                            <th><a href='admin.history.php?sortby=returned_id&dir=ASC'>Book ID &or;</a></th>
                            <th><a href='admin.history.php?sortby=user_id&dir=ASC'>User ID &or;</a></th>
                            <th><a href='admin.history.php?sortby=date_borrowed_book&dir=ASC'>Date borrowed book &or;</a></th>
                            <th><a href='admin.history.php?sortby=date_of_return&dir=ASC'>Date of return book &or;</a></th>
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
                    if (isset($_SESSION['sortby']) && (isset($_SESSION['dir'])))
                    {
                        $sortby = $_SESSION['sortby'];
                        $dir = $_SESSION['dir'];
                        $query = "SELECT * FROM returned_books ORDER BY $sortby $dir, returned_id ASC LIMIT 10 OFFSET $i";
                    }
                    else $query = "SELECT * FROM returned_books LIMIT 10 OFFSET $i";
                    //$query = "SELECT * from table_books ORDER BY borrowed_id DESC LIMIT 10 OFFSET $i";

                    if ($how_much_loops >= 10) break;


                    $result = mysql_query($query) or die(mysql_error());
                    $row = mysql_fetch_assoc($result);
                    
                    echo "<tr>";
                    echo "<td>".($i+1)."</td>";
                    echo "<td>".$row['returned_id']."</td>";
                    echo "<td>".$row['borrowed_id']."</td>";
                    echo "<td>".$row['book_id']."</td>";
                    echo "<td>".$row['user_id']."</td>";
                    echo "<td>".$row['date_borrowed_book']."</td>";
                    echo "<td>".$row['date_of_return']."</td></tr>";
                    
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
                        if (isset($_SESSION['sortby']) && isset($_SESSION['dir']))
                        {
                            $sortby = $_SESSION['sortby'];
                            $dir = $_SESSION['dir'];
                            $query = "SELECT * from returned_books ORDER BY $sortby $dir, returned_id ASC LIMIT 10 OFFSET $i";
                        }
                        else $query = "SELECT * from returned_books LIMIT 10 OFFSET $i";

                        if ($i>=$counter) break;

                        $result = mysql_query($query) or die(mysql_error());
                        $row = mysql_fetch_assoc($result);

                        if ($how_much_loops >= 10) break;

                        $returned_id = $row['returned_id'];
                        echo "<tr>";
                        echo "<td>".($i+1)."</td>";
                        echo "<td>".$row['returned_id']."</td>";
                        echo "<td>".$row['borrowed_id']."</td>";
                        echo "<td>".$row['book_id']."</td>";
                        echo "<td>".$row['user_id']."</td>";
                        echo "<td>".$row['date_borrowed_book']."</td>";
                        echo "<td>".$row['date_of_return']."</td></tr>";
                        
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
                   $next_page = ($page+1);
                   $previous_page = ($page-1);
                   if (($page)<=$num_of_pages)
                   {
                       echo "</tr></table>";
                        if ($_GET['page'] >= 2)
                        {
                            echo "<a href='admin.history.php?page=$previous_page'> < </a> ";
                        }
                    }


                    for ($i=1; $i<=$num_of_pages; $i++)
                    {
                        if ($_GET['page'] == $i)
                        echo "<a href='admin.history.php?page=$i'> <b>$i</b> </a> ";
                        else
                           echo "<a href='admin.history.php?page=$i'> $i </a> "; 
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
                            echo "<a href='admin.history.php?page=$next_page'> > </a> ";
                        }
                    }

                     if (($_GET['page']) == NULL)
                        {
                            if ($num_of_pages > 1)
                            echo "<a href='admin.history.php?page=$two'> > </a> ";
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
                        echo "<a href='admin.history.php?page=$i'> <b>$i</b> </a> ";   
                        else echo "<a href='admin.history.php?page=$i'> $i </a> ";
                        if ($i==50*$a)
                        {
                            echo "br/>";
                            $a++;
                        }
                    }

                    if ($num_of_pages > 1)
                    {
                        echo "<a href='admin.history.php?page=$next_page'> > </a> ";
                    }
                } 
                echo "</div>";
                 /* End of page numbering  */
            }
            echo "<div style='text-align: center;'><br /><input type='button' style='padding:20px;' value=' Refresh ' onClick='parent.location.href=\"admin.history.php?sortby=returned_id&dir=ASC\"' />
            <form name='form' action='admin.add.book.php' method=post><br />
            <input type='submit' style='padding:20px;' value='Add book' method='post'></form>
            <br><br></div>";
        }
    }
}
else echo "You don't have permissions";
disconnect();
error_reporting();						
?>                                           
                                            
                                            
                                            
                                            
                                            
                                            
                                            
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
