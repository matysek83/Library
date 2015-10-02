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
				<div id="formularz"><?php include_once 'include/login.user.php'; ?>
		
				
				
				
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
if (isset($_GET['page_guestbook']))
{
    $_GET['page_guestbook'] = filter_var($_GET['page_guestbook'], FILTER_SANITIZE_STRING);
}
$plik = "dane.txt";
$wskaznik = fopen($plik, "r");
$licznik = 0;
if ($wskaznik)
{
    while ($linia = (fgets($wskaznik)))
    {
        $licznik++;
    }

    $ilosc_stron = ceil($licznik/10);
    if (isset($_GET['page_guestbook']))
    {
        if (($_GET['page_guestbook'] > $ilosc_stron) )
        {
            echo "Site not exists!";
            exit;
        }


        if ($_GET['page_guestbook']!=NULL)
        if (!is_numeric($_GET['page_guestbook']))
        {
            echo "Site not exists!";
            exit;
        }		
        rewind($wskaznik);
    }
}
else echo "empty file!";
fclose($wskaznik);
?>            
                                            
                                            
                                            
	<form action="guestbook1.php" method="post" name="form" >
        <input type="text" name="nick" value="nickname"/>
        <input type="text" name="validator" value="rok bitwy pod grunwaldem">
        <textarea name="contents" cols="30" rows="5">Message</textarea>
        <input type="submit" value=" Send "/>
        </form><br><br>
        <?php

echo "<table border='1' align='center' cellspacing='1'>";        
        
        
        
$plik = "dane.txt";
$wskaznik = fopen($plik, "r+");
if ($wskaznik)
{
    //$tresc = fread($wskaznik, filesize($plik));
    if (isset($_GET['page_guestbook']))
    filter_var($_GET['page_guestbook'], FILTER_SANITIZE_STRING);

    if (empty($_GET['page_guestbook']))
    {
        $ile_petli = 0;
        $tablica = file($plik);
        for ($i=0; $i<=count($tablica); $i+=2)
        {
            if (empty($tablica)) break;
            if ($ile_petli >= 5) break;
            if ($ile_petli>=$tablica) break;
            if ($tablica[$i+1] == '') break;
            echo "<tr><td>".($i/2+1)." nick </td><td>".$tablica[$i+1]."</td></tr>";
            echo "<tr><td>".($i/2+1)." tekst</td><td>".$tablica[$i+2]."</td></tr>";
            $ile_petli++;
        }
        echo "</table>";
    }
    if (isset($_GET['page_guestbook']))
    {
        if ($_GET['page_guestbook']== '0' || $_GET['page_guestbook']== '1')
        {
            $ile_petli = 0;
            $tablica = file($plik);
            for ($i=0; $i<=count($tablica); $i+=2)
            {
                if (empty($tablica)) break;
                if ($ile_petli >= 5) break;
                if ($ile_petli>=$tablica) break;
                if ($tablica[$i+1] == '') break;
                echo "<tr><td>".($i/2+1)." nick </td><td>".$tablica[$i+1]."</td></tr>";
                echo "<tr><td>".($i/2+1)." tekst</td><td>".$tablica[$i+2]."</td></tr>";
                $ile_petli++;
            }
            echo "</table>";
        }
    }

    //obliczanie ilości stron
    $licznik = 0;
    while ($linia = (fgets($wskaznik)))
    {
        $licznik++;
    }
    $ilosc_stron = ceil($licznik/10);
    if (isset($_GET['page_guestbook']))
    {
        $odktorego = ((($_GET['page_guestbook'])*10)-10);
        $doktorego = $odktorego+9;
    }
    if (isset($_GET['page_guestbook']))
    {
        if (($_GET['page_guestbook'])>=2)
        {
            $ile_petli = 0;

            $tablica = file($plik);
            for ($i = $odktorego; $i<=$doktorego; $i+=2)
            {
                if ($i>=$licznik) break;
                if ($ile_petli >=5 ) break;
                if ($tablica[$i+1] == '') break;
                echo "<tr><td>".($i/2+1)." nick </td><td>".$tablica[$i]."</td></tr>";
                echo "<tr><td>".($i/2+1)." tekst</td><td>".$tablica[$i+1]."</td></tr>";
                $ile_petli++;
            }
        echo "</table>";
        }
    }
}
else echo "File not exists"  ;
echo "<br><br>";

       
       //strzalki przód i tył
       $dwa = 2;
       if (isset($_GET['page_guestbook']))
       {
            $strona_nastepna = $_GET['page_guestbook']+1;
            $strona_poprzednia = $_GET['page_guestbook']-1;

            if (($_GET['page_guestbook'])<=$ilosc_stron)
            {
                if ($_GET['page_guestbook'] >= 2)
                {
                    echo "<a href='guestbook.php?page_guestbook=$strona_poprzednia'> < </a> ";
                }
            }
                

            for ($i=1; $i<=$ilosc_stron; $i++)
            echo "<a href='guestbook.php?page_guestbook=$i'> $i </a> ";


            if (($_GET['page_guestbook'])>=1 )
            {
                if ($ilosc_stron > ($_GET['page_guestbook']))
                {
                    echo "<a href='guestbook.php?page_guestbook=$strona_nastepna'> > </a> ";
                }
            }
        }
        
        if (empty($_GET['page_guestbook']))
        {
            for ($i=1; $i<=$ilosc_stron; $i++)
            echo "<a href='guestbook.php?page_guestbook=$i'> $i </a> ";
            if ($ilosc_stron > 1)
            echo "<a href='guestbook.php?page_guestbook=$dwa'> > </a> ";
        }
             
        //$trescpoprawiona = explode(" ", $tresc);
        
        //echo "<pre>".$trescpoprawiona[2]."</pre>";
        //echo $linia;
        //$linia = fgets($wskaznik);
        //echo $linia;

        fclose($wskaznik);

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
