<?
include_once 'include/start.sesji.inc.php';
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include "include/meta.inc.php";
require_once 'include/logowanie.do.bazy.php';
?>

<title>Pasje.biz - Programowanie C++, Turbo Pascal, PHP, Systemy UNIX - FreeBSD</title>

</head>
<body onload="zegar();">
	<div align="center">		
		<div id="kontener">
			<div id="panel">
				<div id="formularz"><?include_once 'include/logowanie.inc.php';	?>	
							
				
				
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
		include "include/srodkowe.menu.inc.php";
		?>
		<!-- koniec div srodkowe menu-->
		
			<div id="zawartosc">
				<div id="gorna_czesc_zawartosci"></div>
				<div id="srodkowa_czesc_zawartosci">
					<div id="tekst">
				<?php
                                if (isset($_SESSION['zalogowany']))
                                if ($_SESSION['zalogowany']==3)
                                {
                                    polaczenie();

                                    $wyborbazy = mysql_select_db("matys_baza") or die (mysql_error());

                                    $id_uzytkownika = filter_var($_GET['id_uzytkownika'], FILTER_SANITIZE_NUMBER_INT);
                                    $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
                                    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
                                    $uprawnienia = filter_var($_POST['uprawnienia'], FILTER_SANITIZE_NUMBER_INT);
                                    
                                    if ((!empty($id)) && (!empty($login)) && (!empty($email)) && (!empty($uprawnienia)))
                                    {
                                         if ((isset($id)) && (isset($login)) && (isset($email)) && (isset($uprawnienia)))
                                         {



                                            $query = "UPDATE users SET
                                                    login = '$login',
                                                    email = '$email',
                                                    uprawnienia = '$uprawnienia'
                                                    WHERE id_uzytkownika = '$id_uzytkownika'
                                                    ";
                                            $result = mysql_query($query) or die (mysql_error());

                                            if ($result)
                                            {
                                                if ($uprawnienia == 1)
                                                $uprawnienia = "Niezarejestrowany użytkownik";
                                                else if ($uprawnienia == 2)
                                                $uprawnienia = "Zarejestrowany użytkownik";
                                                else if ($uprawnienia == 3)
                                                $uprawnienia = "Administrator";
                                                else $uprawnienia = "nieznane uprawniania";
                                                echo "Dodano wpis: <br />";
                                                echo "ID: $id_uzytkownika <br />";
                                                echo "Login: $login <br />";
                                                echo "E-Mail: $email <br />";
                                                echo "Uprawnienia: $uprawnienia <br />";
                                            }
                                        else echo "blad";
                                        }
                                    else echo "Nie wypełniono wszystkich pól!!";
                                    zamknij_baze();
                                    }
                                    else echo "Nie wypełniono wszystkich pól!!";
                                }
                                else echo "nie jesteś zalogowany jako Administrator!!!";
error_reporting(E_ALL);
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
