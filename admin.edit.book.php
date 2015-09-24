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
        connect();

        echo "<table bgcolor=#EEEEEE border=1 width='920'>
                <thead>
                <tr align=center>
                    <th>Book name</th>
                    <th>Author</th>
                    <th>Publishing house</th>
                    <th>Year of publication</th>
                    <th>Binding</th>
                </tr>
                </thead>";
        
        
        $wyborbazy = mysql_select_db("matys_baza");
        $edit_id = filter_var($_GET['book_id'], FILTER_SANITIZE_STRING);
        $edit_id = mysql_real_escape_string($edit_id);
        $query = "SELECT * from table_books WHERE book_id='$edit_id'";
        $result = mysql_query($query) or die(mysql_error());
        mysql_query($query) or die(mysql_error());

        
        $row = mysql_fetch_assoc($result);
        if ($row['binding'] == 1)
        $row['binding'] = "hard";
        else $row['binding'] = "soft";

        if ($row['availability'] ==1)
        $row['availability'] = "avaiable";
        else $row['availability'] = "not avaiable";

        $book_id = $row['book_id'];
        echo "<tbody>";
        echo "<tr align=center>";
        echo "<td>".$row['book_name']."</td>";
        echo "<td>".$row['author']."</td>";
        echo "<td>".$row['publishing_house']."</td>";
        echo "<td>".$row['year_of_publication']."</td>";
        echo "<td>".$row['binding']."</td></tr>";
        echo "</tbody>";
        
        


        echo "<form method='post' action='admin.edit.book.check.php?book_id=$book_id'>";

?>
    <tr>
<td><input type="text" name="book_name" size="30" maxlength="40" value="<?php echo $row['book_name']; ?>"/></td>
<td><input type="text" name="author" size="30" maxlength="40" value="<?php echo $row['author']; ?>"/></td>
<td><input type="text" name="publishing_house" size="30" maxlength="40" value="<?php echo $row['publishing_house']; ?>"/></td>
<td align="center"><input type="text" name="year_of_publication" size="5" maxlength="4" value="<?php echo $row['year_of_publication'];?>"/></td>
<td><input type="radio" name="binding" value=1 <?php if ($row['binding']== "hard") echo "checked"; ?>/>hard<br>
<input type="radio" name="binding" value=0 <?php if ($row['binding']== "soft") echo "checked"; ?>/>soft</td>
</tr>
<tr><td><input type="submit" name=" Add " value="Send"></form></td><tr/></table> 
                                            
                                            
 <?php
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
<?php disconnect(); ?>