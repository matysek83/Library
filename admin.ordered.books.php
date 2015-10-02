<?php
include_once 'include/session.start.inc.php';
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include_once  'include/meta.inc.php';
?>

<title>Programowanie C++, Turbo Pascal, PHP, Systemy UNIX - FreeBSD</title>

</head>
<body onload="zegar();">
	<div align="center">		
		<div id="kontener">
			<div id="panel">
				<div id="formularz"><?php include 'include/login.user.php';	?>
		
				
				
				
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
connect();
if (isset($_SESSION['logged']))
if ($_SESSION['logged']==3)
{
    $choose_database = mysql_select_db("matys_baza");
    $_GET['user_id'] = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
    $_GET['book_id'] = filter_var($_GET['book_id'], FILTER_SANITIZE_NUMBER_INT);
    if (isset($_GET['book_id']) && isset($_GET['user_id']))
    {
        $book_id = $_GET['book_id'];
        $user_id = $_GET['user_id'];
        $query = "DELETE from orders WHERE book_id=$book_id";
        $result_orders = mysql_query($query) or die (mysql_error());
        $query = "UPDATE table_books SET availability = 2 WHERE book_id=$book_id";
        $result_books = mysql_query($query) or die (mysql_error());
    }

    $query = "SELECT order_id, o.book_id, book_name, author, date_of_order, availability FROM (orders o LEFT JOIN table_books t ON o.book_id = t.book_id) WHERE user_id=$user_id AND availability=1 or availability=0 LIMIT 5";
    $result = mysql_query($query) or die (mysql_error());      
    /*$i = 0;
    while ($row = mysql_fetch_assoc($result))
    {
                        $i++;
                        if ($row['availability']==0)
                            $row['availability']= 'borrowed';
                        if ($row['availability']==1)
                            $row['availability']= 'ordered';
                        
                        $book_id = $row['book_id'];
                        echo "<tr><td>".$i."</td>";
                        echo "<td>".$row['order_id']."</td>";
                        echo "<td>".$row['book_id']."</td>"; 
                        echo "<td>".$row['book_name']."</td>";
                        echo "<td>".$row['author']."</td>"; 
                        echo "<td>".$row['date_of_order']."</td>";
                        echo "<td>".$row['availability']."</td>";
                        if ($row['availability']=='ordered')
                        echo "<td><a href='my.ordered.books.php?book_id=$book_id'>Un order</a></td></tr>";
                        if ($row['availability']=='borrowed')
                        echo "<td>You already have</a></td></tr>";   

    }
    */
}
else "site not exist";
//echo "</table>";                                            
                                            
                                            
                                            
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
