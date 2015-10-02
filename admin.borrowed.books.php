<?php
include_once 'include/session.start.inc.php';
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include "include/meta.inc.php";
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
		?>
		<!-- koniec div srodkowe menu-->
		
			<div id="zawartosc">
				<div id="gorna_czesc_zawartosci"></div>
				<div id="srodkowa_czesc_zawartosci">
					<div id="tekst">
                                            
					<?php
if (isset($_SESSION['logged']))
{
    if ($_SESSION['logged']==3)
    {
        
        $db_h = connect();
        if (isset($_GET['user_id']))
        {
            $user_id = filter_var($_GET['user_id'], FILTER_SANITIZE_STRING);
            if (isset($_GET['book_id']))
            { 
                $book_id = $_GET['book_id'];
                $query = "DELETE from orders WHERE book_id=$book_id";
                $result_orders = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                $query = "UPDATE table_books SET availability = 0 WHERE book_id=$book_id";
                $result_books = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
            }
            $query = "SELECT user_id, login, email FROM users WHERE user_id = $user_id";
            $result = mysqli_query($db_h, $query) or die(mysqli_error($db_h));
            $row = mysqli_fetch_assoc($result);
            $login = $row['login'];
            $email = $row['email'];
            echo "USER ID: $user_id <br>";
            echo " LOGIN: $login <br>";
            echo " EMAIL: $email <br>";
            echo "<h1> Ordered books </h1>";
            echo "<table border='1' style='float: left; '>
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
            
            $query = "SELECT order_id, o.book_id, book_name, author, date_of_order, availability FROM (orders o LEFT JOIN table_books t ON o.book_id = t.book_id) WHERE user_id=$user_id AND availability=1 or availability=0 LIMIT 5";
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
                echo "<td><a href='admin.borrowed.books.php?book_id=$book_id&user_id=$user_id&action=borrow'>Borrow book</a> | <a href='admin.borrowed.books.php?book_id=$book_id&user_id=$user_id&action=un_order'>Un order</a></td></tr>";
                if ($row['availability']=='borrowed')
                echo "<td><a href='admin.borrowed.books.php?book_id=$book_id&user_id=$user_id&action=un_borrow'>Return book</a></td></tr>";   

            }
            
        }                                           
        echo "</table>"; 

        if (isset($_GET['book_id']) && isset($_GET['user_id']) && isset($_GET['action']))  //set data
        {
            //Order book
            if ($_GET['action'] == "un_order")
            {
                $_GET['user_id'] = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
                $_GET['book_id'] = filter_var($_GET['book_id'], FILTER_SANITIZE_NUMBER_INT);
                $book_id = $_GET['book_id'];
                $user_id = $_GET['user_id'];
                if (isset($_SESSION['action']))
                { 
                    if ($_SESSION['action'] != $_GET['book_id'].$_GET['user_id'].$_GET['action'])
                    {
                        
                        if ($_SESSION['action'] != $_GET['book_id'].$_GET['user_id'].$_GET['action'])
                        {
                            $query = "DELETE from orders WHERE book_id=$book_id";
                            $result_orders = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                            $query = "UPDATE table_books SET availability = 2 WHERE book_id=$book_id";
                            $result_books = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                            $_SESSION['action'] = $_GET['book_id'].$_GET['user_id'].$_GET['action'];
                        }
                    }    
                }
                else 
                {
                    $query = "DELETE from orders WHERE book_id=$book_id";
                    $result_orders = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                    $query = "UPDATE table_books SET availability = 2 WHERE book_id=$book_id";
                    $result_books = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                    $_SESSION['action'] = $_GET['book_id'].$_GET['user_id'].$_GET['action'];
                }
            }
       

    


            //Borrow book
            if ($_GET['action'] == "borrow")
            {

                    $_GET['user_id'] = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
                    $_GET['book_id'] = filter_var($_GET['book_id'], FILTER_SANITIZE_NUMBER_INT);
                    $book_id = $_GET['book_id'];
                    $user_id = $_GET['user_id'];
                    if (isset($_SESSION['action']))
                    {
                        if ($_SESSION['action'] != $_GET['book_id'].$_GET['user_id'].$_GET['action'])
                        {
                            $query = " INSERT INTO borrowed_books (book_id, user_id) 
                                       VALUES($book_id, $user_id)
                                       ";
                            $result_orders = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                            $query = "DELETE from orders WHERE book_id=$book_id";
                            $result_orders = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                            $query = "UPDATE table_books SET availability = 0 WHERE book_id=$book_id";
                            $result_books = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                            $_SESSION['action'] = $_GET['book_id'].$_GET['user_id'].$_GET['action'];
                        }
                    }
                    else
                    {
                        $query = " INSERT INTO borrowed_books (book_id, user_id) 
                                       VALUES($book_id, $user_id)
                                       ";
                        $result_orders = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                        $query = "DELETE from orders WHERE book_id=$book_id";
                        $result_orders = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                        $query = "UPDATE table_books SET availability = 0 WHERE book_id=$book_id";
                        $result_books = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                        $_SESSION['action'] = $_GET['book_id'].$_GET['user_id'].$_GET['action'];
                    }    
                    
            }
    
    
        
            // Un borrow book // return
            if ($_GET['action'] == "un_borrow")
            {
                $book_id = $_GET['book_id'];
                $query = "SELECT borrowed_id, date_borrowed_book FROM borrowed_books WHERE book_id=$book_id";
                $result = mysqli_query($db_h, $query) or die (mysqli_error($db_h));      
                $row = mysqli_fetch_assoc($result);
                $date_borrowed_book = $row['date_borrowed_book'];
                $borrowed_id = $row['borrowed_id'];

                $_GET['user_id'] = filter_var($_GET['user_id'], FILTER_SANITIZE_NUMBER_INT);
                $_GET['book_id'] = filter_var($_GET['book_id'], FILTER_SANITIZE_NUMBER_INT);
                $book_id = $_GET['book_id'];
                $user_id = $_GET['user_id'];
                if (isset($_SESSION['action']))
                {
                    if ($_SESSION['action'] != $_GET['book_id'].$_GET['user_id'].$_GET['action'])
                    {
                        $query = " INSERT INTO returned_books (borrowed_id, book_id, user_id, date_borrowed_book) 
                                   VALUES ($borrowed_id, $book_id, $user_id, '$date_borrowed_book')
                                   ";

                        $result_orders = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                        $query = "UPDATE table_books SET availability = 2 WHERE book_id=$book_id";
                        $result_books = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                        $query = "DELETE from borrowed_books WHERE book_id=$book_id";
                        $delete_from_borrowed = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                        $_SESSION['action'] = $_GET['book_id'].$_GET['user_id'].$_GET['action'];
                    }
                }
                
                else
                {
                   $query = " INSERT INTO returned_books (borrowed_id, book_id, user_id, date_borrowed_book) 
                                   VALUES ($borrowed_id, $book_id, $user_id, '$date_borrowed_book')
                                   ";

                    $result_orders = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                    $query = "UPDATE table_books SET availability = 2 WHERE book_id=$book_id";
                    $result_books = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
                    $query = "DELETE from borrowed_books WHERE book_id=$book_id";
                    $delete_from_borrowed = mysqli_query($db_h, $query) or die (mysqli_error($db_h)); 
                }
            }
        }    
        $query = "SELECT b.user_id, borrowed_id, t.book_id, book_name, author, date_borrowed_book FROM (table_books t RIGHT JOIN borrowed_books b ON b.book_id = t.book_id) WHERE b.user_id = $user_id ";
        $result = mysqli_query($db_h, $query) or die (mysqli_error($db_h));    
        echo "<br><br>";
        echo "<h1> Borrowed books </h1>";
            echo "<table border='1' style='float: left; '>
                <tr>
                    <th>LP.</th>
                    <th>Order ID</th>
                    <th>Book ID</th>
                    <th>Book name</th>
                    <th>Author</th>
                    <th>Date of borrow</th>
                    <th>Availability</th>
                    <th>OPTIONS</th>

                </tr>";



        while ($row = mysqli_fetch_assoc($result))
        {
            $i++;

            $book_id = $row['book_id'];
            echo "<tr><td>".$i."</td>";
            echo "<td>".$row['borrowed_id']."</td>"; 
            echo "<td>".$row['book_id']."</td>"; 
            echo "<td>".$row['book_name']."</td>";
            echo "<td>".$row['author']."</td>"; 
            echo "<td>".$row['date_borrowed_book']."</td>";
            echo "<td>Borrowed</td>";
            echo "<td><a href='admin.borrowed.books.php?book_id=$book_id&user_id=$user_id&action=un_borrow'>Return book</a></td></tr>";     

        }
        echo "</table>";

    }
    disconnect();;
}
else echo "site not exists!";

                                        
                                        
                                        
                                        
                                        
                                        
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


