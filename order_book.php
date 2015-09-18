<?php
include_once 'include/session.start.inc.php';
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include 'include/meta.inc.php';
?>

<title>Programowanie C++, Turbo Pascal, PHP, Systemy UNIX - FreeBSD</title>

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
						
<?php
connect();
mysql_select_db('matys_baza');
$how_much_rows = 0;
if (isset($_SESSION['user_id']))
if (isset($_GET['book_id']))    
if (!empty($_GET['book_id']))      
{
    $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_STRING);
    if (isset($_SESSION['book_id']))
    if ($_SESSION['book_id'] == $_GET['book_id'])
    {
        echo "you have added once!";
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: my.ordered.books.php');
        exit;
    }
        
    $_SESSION['book_id'] = $_GET['book_id'];
    if (isset($_SESSION['user_id']))
    {
        $user_id = filter_var($_SESSION['user_id'], FILTER_SANITIZE_STRING);
    }
    $query = "SELECT user_id FROM orders WHERE user_id=$user_id";
    $result = mysql_query($query) or die (mysql_error());
    $how_much_rows = mysql_num_rows($result);
    $query = "SELECT user_id FROM borrowed_books WHERE user_id=$user_id";
    $result = mysql_query($query) or die (mysql_error());
    $how_much_rows_borrowed = mysql_num_rows($result);
    $how_much_rows += $how_much_rows_borrowed; //counting books
    
    if ($how_much_rows>=5)
    {
        echo 'too many books max 5!';
        echo $how_much_rows;
    }
    else 
    {
            
        
        $book_id = filter_var($_GET['book_id'], FILTER_SANITIZE_STRING);


        $query = "INSERT INTO orders (user_id, book_id, date_of_order)
            VALUES ('$user_id', '$book_id', (CURRENT_TIMESTAMP))
                ";

        $result = mysql_query($query) or die (mysql_error());
        if ($result)
            echo "You have ordered book<br>Id of book: $book_id";
        $query = "UPDATE table_books SET availability = 1 WHERE book_id=$book_id";
        $result = mysql_query($query) or die (mysql_error());
    
    
    
    }
}
else echo 'you can add only once!';


disconnect();
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
