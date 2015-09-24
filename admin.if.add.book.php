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
                                            <html>
                                                <title>Library Admin</title>
</head>
<body>
<?php
if (isset($_SESSION['logged']))
{
    if ($_SESSION['logged'] == 3)
    {
        connect();
        mysql_select_db("matys_baza");

        if (empty($_POST["how_much_check"]))
        {
            if (isset($_SESSION["ifadded"]))
            {
                if ($_SESSION["ifadded"] == $_POST['book_name1'].$_POST['author1'].$_POST['publishing_house1'].$_POST['year_of_publication1'])
                echo "You have added already"; 
            }
            else  
            {

                if (!isset($_SESSION["ifadded"]) || $_SESSION["ifadded"] != $_POST['book_name1'].$_POST['author1'].$_POST['publishing_house1'].$_POST['year_of_publication1'])
                {

                    if (!mysql_select_db("matys_baza"))
                    {
                        echo "Creating new database... <br />";
                        $base = mysql_query("CREATE DATABASE matys_baza;");
                    }
                    $choosebase = mysql_select_db("matys_baza");

                    $book_name = filter_var($_POST['book_name1'], FILTER_SANITIZE_STRING);
                    $author = filter_var($_POST['author1'], FILTER_SANITIZE_STRING);
                    $publishing_house = filter_var($_POST['publishing_house1'], FILTER_SANITIZE_STRING);
                    $year_of_publication = filter_var($_POST['year_of_publication1'], FILTER_SANITIZE_STRING);
                    $binding = filter_var($_POST['binding1'], FILTER_SANITIZE_STRING);


                    $_SESSION["ifadded"] = $book_name.$author.$publishing_house.$year_of_publication;
                    $add_data = mysql_query("
                            INSERT INTO table_books (book_name, author, publishing_house, year_of_publication, binding, availability, date_added_book)
                            VALUES
                            ('$book_name', '$author', '$publishing_house', '$year_of_publication', '$binding', 2, (CURRENT_TIMESTAMP))
                        ") or die(mysql_error());

                    if ($binding==1)
                    $binding = "hard";
                    else $binding = "soft";



                    if ($add_data) echo "Added position: <br />Book name: $book_name<br /> Author: $author <br /> Publishing house: $publishing_house <br /> Year of publication: $year_of_publication <br /> Binding: $binding";
                    else "Error";

                }
            }
        }
        if (isset($_POST["how_much_check"]))
        {
            if (!empty($_POST["how_much_check"]))
            {
                if (isset($_POST['book_name1']) && isset($_POST['author1']) && isset($_POST['publishing_house1']) && isset($_POST['year_of_publication1']))
                {
                    if ($_SESSION["ifadded"] == $_POST['book_name1'].$_POST['author1'].$_POST['publishing_house1'].$_POST['year_of_publication1'])
                    {
                        echo "you have added once!";
                        exit;
                    }
                    if (isset($_POST['book_name1']) && isset($_POST['author1']) && isset($_POST['publishing_house1']) && isset($_POST['year_of_publication1']) && isset($_SESSION["ifadded"]))
                    {
                        if ($_SESSION["ifaddedbook"] != $_POST['book_name1'].$_POST['author1'].$_POST['publishing_house1'].$_POST['year_of_publication1'])
                        {

                            $how_much_check = filter_var($_POST["how_much_check"] , FILTER_SANITIZE_NUMBER_INT);
                            $_SESSION["ifaddedbook"] = $_POST['book_name1'].$_POST['author1'].$_POST['publishing_house1'].$_POST['year_of_publication1'];
                            for ($i=1; $i<=$how_much_check; $i++)
                            {
                                $book_name =  filter_var($_POST["book_name"."$i"], FILTER_SANITIZE_STRING);
                                $author = filter_var($_POST["author"."$i"], FILTER_SANITIZE_STRING);
                                $publishing_house = filter_var($_POST["publishing_house"."$i"], FILTER_SANITIZE_STRING);
                                $year_of_publication = filter_var($_POST["year_of_publication"."$i"], FILTER_SANITIZE_STRING);
                                $binding =  filter_var($_POST["binding"."$i"], FILTER_SANITIZE_STRING);
                                //$availability = filter_var($_POST["availability"."$i"], FILTER_SANITIZE_STRING);


                                $add_data = mysql_query("
                                    INSERT INTO table_books (book_name, author, publishing_house, year_of_publication, binding, availability, date_added_book)
                                        VALUES
                                        ('$book_name', '$author', '$publishing_house', '$year_of_publication', '$binding', 2, (CURRENT_TIMESTAMP))
                                    ") or die(mysql_error());

                                if ($binding==1)
                                $binding = "hard";
                                else $binding = "soft";


                                if ($add_data) echo "You added position number: $i: <br />Book name: $book_name <br>Author: $author <br>Publishing house: $publishing_house <br>Year of publication: $year_of_publication <br>Binding: $binding <br/>";
                                else "You haven't added any book";
                            }
                        }else echo "blad1";
                    }else echo "blad2";
                }else echo "blad3";

            }else echo "blad4";
        }
        else echo "You can't add many times";
    }
}
        disconnect();
?>
<input type="button" value=" Back " onClick="parent.location.href='admin.add.book.php'">

</body>
</html>
                                            
                                            
                                            
                                            
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
