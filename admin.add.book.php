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
		include_once 'include/middle.menu.inc.php';
		?>
		<!-- koniec div srodkowe menu-->
		
			<div id="zawartosc">
				<div id="gorna_czesc_zawartosci"></div>
				<div id="srodkowa_czesc_zawartosci">
					<div id="tekst">
						
                                            
                                          <div style="float:left; margin: 0px 0px 0px 0px;">
<?php
if (isset($_SESSION['logged']))
{
    if ($_SESSION['logged'] == 3)
    {
        connect();
        echo
        "<table bgcolor=#EEEEEE border=1><tr>
        <th align=center>Book name</th>
        <th align=center>Author</th>
        <th>Publishing house</th>
        <th>Year of publication</th>
        <th>Binding</th>
        </tr>";
        if(isset($_POST["how_much"]))
        {
            filter_var($_POST["how_much"], FILTER_SANITIZE_NUMBER_INT);
        }
        if (!isset($_POST["how_much"]))
        {
            echo "<form action='admin.if.add.book.php' method=post name='formadd'>";
            echo "<tr>
            <td><input type='text' name='book_name1' size='30' maxlength='40'/></td>
            <td><input type='text' name='author1' size='30' maxlength='40'/></td>
            <td><input type='text' name='publishing_house1' size='30' maxlength='40'/></td>
            <td><input type='text' name='year_of_publication1' size='5' maxlength='4'/></td>
            <td><input type='radio' name='binding1' value=1/>hard
            <input type='radio' name='binding1' value=0/>soft</td>
            </tr>
            
            ";
        }


        if (isset($_POST["how_much"]))
        {
            $how_much = $_POST["how_much"];
            for ($i=1; $i<=$how_much; $i++)
            {
                echo "<form action='admin.if.add.book.php' method=post name='formadd'>";
                echo "<tr>
                <td><input type='text' name='book_name".$i."' size='30' maxlength='40'/></td>
                <td><input type='text' name='author".$i."' size='30' maxlength='40'/></td>
                <td><input type='text' name='publishing_house".$i."' size='30' maxlength='40'/></td>
                <td><input type='text' name='year_of_publication".$i."' size='5' maxlength='4'/></td>
                <td><input type='radio' name='binding".$i."' value=1/>hard
                <input type='radio' name='binding".$i."' value=0/>soft</td>
                <input type='hidden' name='how_much_check' value='$how_much'>
                </tr>";   

            }
        }
    

?>
<tr><td><input type='submit' value='Add book'></td></tr>                                              
</form>
</table>
<form name="how_much" action="" method="post">
    <input name="how_much" type="text"/>
    <input type="submit" value="How much books you want to add?">
</form>
</div>

<div style="margin: 0px 0px 0px 0px; float:left;">
    <br><br>
   <p> Add file to base. Formating: Book name|Author|Publishing house|Year of publication|1: hard binding 0: soft binding</p>
   <p>File format: *.txt</p>
    
   <form action="" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="MAX_FILE_SIZE" value="100000">
        <input type="file" name="file">12 plus 3 minus 2 :
        <input type="text" name="captcha" size="5"/>
        <input type="submit" value="Add file">
    </form>

    
<?php
        if (isset($_FILES["file"]) && $_POST['captcha']== '13')
        {

            switch ($_FILES["file"]["error"])
            {
            case 0:
                if ($_FILES["file"]["type"] == "text/plain")
                {
                    if (move_uploaded_file($_FILES["file"]["tmp_name"], $file = "pliki/".$_FILES["file"]["name"]))
                    echo "file is uploaded";
                    else echo "error file upload";

                }
                else echo "wrong type of file";
                break;
            case 1:
                echo "too large file";
                break;
            case 2:
                echo "too large file";
                break;
            case 3:
                echo "too large file";
                break;
            case 4:
                echo "not chosen file";
                break;
            default:
                echo "Unknown error";
            }

        }

    



        connect();

        if (!mysql_select_db("matys_baza"))
        {
            echo "Creating new database...<br />";
            $baza = mysql_query("CREATE DATABASE table_books;");
        }
        $wyborbazy = mysql_select_db("matys_baza");

        if (isset($_POST['captcha']) && isset($file))
        {
            if (($_POST['captcha'] == "13"))
            {

                $wskaznik = @fopen($file, "r+");
                $tablica = file($file);
                while ($linia = (fgets($wskaznik)))
                {

                    $tablica = explode("|", $linia);


                    $query = "INTO TABLE table_books 
                        (book_name, author, publishing_house, year_of_publication, binding)
                        VALUES ($pierwszafraza[0], $pierwszafraza[1], $pierwszafraza[2], $pierwszafraza[3], $pierwszafraza[4])  
                        ";

                    mysql_query($query) or die(mysql_error());
                }
            }
        }
        disconnect();
        error_reporting(E_ALL);
    }
}
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
