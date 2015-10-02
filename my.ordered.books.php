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
$db_h = connect();
if (isset($_SESSION['user_id']))
{
    
    echo "<p> Ordered books: </p>
        <table border='1' style='float: left; '>
            <tr>
                <th>LP.</th>
                <th>Order ID</th>
                <th>Book ID</th>
                <th>Book name</th>
                <th>Author</th>
                <th>Date of order</th>
                <th>Availability</th>
                <th>OPTIONS</th>

            </tr>";
    
    $user_id = $_SESSION['user_id'];
    if (isset($_GET['book_id']))
    {
        $book_id = $_GET['book_id'];
        $query = "DELETE from orders WHERE book_id=$book_id";
        $result_orders = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
        $query = "UPDATE table_books SET availability = 2 WHERE book_id=$book_id";
        $result_books = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
    }

    $query = "SELECT order_id, o.book_id, book_name, author, date_of_order, availability FROM (orders o LEFT JOIN table_books t ON o.book_id = t.book_id) WHERE user_id=$user_id AND availability=1 LIMIT 5";
    $result = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
    $i = 0;
    while ($row = mysqli_fetch_assoc($result))
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
    echo "</table><br /><br />";
    echo "<br /><br />Borrowed books: ";
    $query = "SELECT borrowed_id, t.book_id, book_name, author, date_borrowed_book FROM borrowed_books b RIGHT JOIN table_books t ON t.book_id=b.book_id WHERE user_id=$user_id AND availability=0 LIMIT 5";
    $result = mysqli_query($db_h, $query) or die (mysqli_error($db_h)); 
    echo "<table border='1' style='float: left;'>
            <tr>
                <th>LP.</th>
                <th>Borrow ID</th>
                <th>Book ID</th>
                <th>Book name</th>
                <th>Author</th>
                <th>Date of borrow</th>
                <th>Availability</th>

            </tr>";
    while ($row = mysqli_fetch_assoc($result))
    {
        $i++;
        if ($row['availability']==0)
            $row['availability']= 'borrowed';
        if ($row['availability']==1)
            $row['availability']= 'ordered';

        $book_id = $row['book_id'];
        echo "<tr><td>".$i."</td>";
        echo "<td>".$row['borrowed_id']."</td>";
        echo "<td>".$row['book_id']."</td>"; 
        echo "<td>".$row['book_name']."</td>";
        echo "<td>".$row['author']."</td>"; 
        echo "<td>".$row['date_borrowed_book']."</td>";
        echo "<td>".$row['availability']."</td>";
    }
}                                           
echo "</table>";                                            
                                            
                                            
                                            
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
