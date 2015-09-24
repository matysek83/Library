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
					
                                            
                                            <?php
$validator = filter_var($_POST['validator'], FILTER_SANITIZE_STRING);
if ($validator == "1410")
{
$nick = filter_var($_POST['nick'], FILTER_SANITIZE_STRING);
$contents = filter_var($_POST['contents'], FILTER_SANITIZE_STRING);

echo $nick."<br>";
echo $contents;



        $plik = "dane.txt";
        $wskaznik = @fopen($plik, "a+");
        //$contents = fread($wskaznik, filesize($plik));
        $zapis = fwrite($wskaznik, ("\n".$nick."\n".$contents));
        fclose($wskaznik);
}
?>
<div align="center">
    <a href="guestbook.php" >Back</a>


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
