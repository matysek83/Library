<?
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
				<div id="formularz"><?include_once 'include/login.user.php';	?>
		
				
				
				
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
                                            <table>
                                                <tr>
                                                    <th>User ID</th>
                                                    <th>Book 1</th>
                                                    <th>Book 2</th>
                                                    <th>Book 3</th>
                                                    <th>Book 4</th>
                                                    <th>Book 5</th>
                                                </tr>
                                            </table>
					<?
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
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


if (($row['availability'] == "not available") )
            {
                if (($_SESSION["logged"] == 2) || ($_SESSION["logged"] == 3))
                {
                    $query_book_id = "SELECT * from orders WHERE user_id = '$user_id'";
                    $result_book_id = mysql_query($query_book_id) or die (mysql_error());
                    //$book_id1 = $row_book_id1['book_id'];
                    //while ($row_book_id = mysql_fetch_assoc($result_book_id))
                    {
                        $result_book_id = mysql_query($query_book_id) or die (mysql_error());
                        $row_book_id = mysql_fetch_assoc($result_book_id);
                        $book_id1 = $row_book_id['book_id'];
                        if ($book_id == $book_id1)
                        echo "<a href='return_book.php?book_id=$book_id1&user_id=$user_id'> Return </a><br></td>";
                    }
                    
                }
            }