<?php
include_once 'include/session.start.inc.php';
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include "include/meta.inc.php";
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
		include "include/middle.menu.inc.php";
		?>
		<!-- koniec div srodkowe menu-->
		
			<div id="zawartosc">
				<div id="gorna_czesc_zawartosci"></div>
				<div id="srodkowa_czesc_zawartosci">
					<div id="tekst">
						
                                            
                                            
                                            
                                            
                                            <?php
if (isset($_SESSION["logged"]))
{
    if ($_SESSION["logged"] == 3)
    {
        $db_h = connect();

        

        $book_id = filter_var($_GET['book_id'], FILTER_SANITIZE_STRING);
        $book_name = filter_var($_POST['book_name'], FILTER_SANITIZE_STRING);
        $author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);
        $publishing_house = filter_var($_POST['publishing_house'], FILTER_SANITIZE_STRING);
        $year_of_publication = filter_var($_POST['year_of_publication'], FILTER_SANITIZE_STRING);
        $binding = filter_var($_POST['binding'], FILTER_SANITIZE_NUMBER_INT);
        
        $book_id = mysqli_real_escape_string($db_h, $book_id);
        $book_name = mysqli_real_escape_string($db_h, $book_name);
        $publishing_house = mysqli_real_escape_string($db_h, $publishing_house);
        $publishing_house = mysqli_real_escape_string($db_h, $publishing_house);
        $year_of_publication = mysqli_real_escape_string($db_h, $year_of_publication);
        $binding = mysqli_real_escape_string($db_h, $binding);

        

        $query = "UPDATE table_books SET
            book_name = '$book_name',
            author = '$author',
            publishing_house = '$publishing_house',
            year_of_publication = '$year_of_publication',
            binding = '$binding'
            WHERE book_id = $book_id
            ";
        $result = mysqli_query($db_h, $query) or die(mysqli_error($db_h));

        if ($binding == 1)
            $binding = "hard";
            else $binding = "soft";

                        
        if ($result) 
        {
            echo "Added entry: <br>";
            echo "Book ID: ".$book_id."<br>";
            echo "Book name: ".$book_name."<br>";
            echo "Author: ".$author."<br>";
            echo "Publishing house: ".$publishing_house."<br>";
            echo "Year of publication: ".$year_of_publication."<br>";
            echo "Binding: ".$binding."<br>";
        }
        else echo "false";

        disconnect();;
    }
    
}
else echo "You don't have permissions";
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
