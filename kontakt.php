<?php
session_start();
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include "include/meta.inc.php";
include "webstats2.php";
?>

<title>PHP Library</title>
	</head>
	<body>
	  <div align="center">
			
		<div id="kontener">
			<div id="panel">
				<div id="formularz">
			<?php
				
if (isset($_GET['akcja']) && ($_GET['akcja'])=='wyloguj')
{
    $_SESSION['zalogowany'] = 0;
    session_destroy();
    echo "<font color='#ececec'>Zostałeś wylogowany</font>";
}
if (($_SESSION['zalogowany']==1) && ((time()-$_SESSION['time'])>60*60))
{
    $_SESSION['zalogowany']=0;
    session_destroy();
    echo "<font color='#ececec'>Czas minal zostałeś wylogowany</font>";
}


if (isset($_POST['login']) && isset($_POST['password']) || $_SESSION['zalogowany'] == 1)
{
    if ((!empty($_POST['login']) && !empty($_POST['password'])) || $_SESSION['zalogowany'] == 1)
    {
        if ($_SESSION['zalogowany']==0){
       $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
       $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	   $login = strtolower($login);
        }
       if (($login == "matys" && $password == "abc")||($login == "user" && $password == "1234") || $_SESSION['zalogowany'] == 1)
                {
                    if ($_SESSION['zalogowany']==0)
                    
                        $_SESSION['login']=$login;
						$login1 = ucwords($login);
                                                           
                echo "<font color='#ececec'>Wlogowałeś się na profil <b>".$login1."</b></font>";
                echo "<br/><a href='kontakt.php?akcja=wyloguj'><i>Wyloguj</i></a>";
                
                $_SESSION['zalogowany'] = 1;
                 $_SESSION['time']=time();
                 
                
                
                }
        else echo "<font color='#ececec'>Zły login lub hasło!</font> ";
    }
    else echo "<font color='#ececec'>Nie podałeś loginu lub hasła!!! </font>";
}
if ($_SESSION['zalogowany']==0)
include "include/formularz.logowania.inc.php";
?>
				
				
				
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
						<img src="obrazki/status.png" alt="Gadu-Gadu" />
						<b>Kontakt GG:</b><a href="gg:2300247">2300247</a>
						<br/>
						<img src="obrazki/skype.png" alt="Skype" /><b> Kontakt Skype: </b><a href="skype:matysek83831?call">matysek83831</a>
						<br/>
						<img src="obrazki/email.png" alt="Email" /><b> Kontakt e-mail: </b><a href="mailto:matys777@o2.pl">matys777@o2.pl</a>
						<br/><br/>
						<h1>Formularz kontaktowy</h1>
						

<?php
if(empty($_POST['submit'])){
?>
<div id="formularz_kontaktowy">
<form action="kontakt.php" method="post">
<table align="center" border="0" cellpadding="0" cellspacing="0">
<tr><td class="dane">imię:</td>
<td><input type="text" name="imienazwisko" style="width:300px;" /></td>
</tr><tr>
<td class="dane">e-mail:</td>
<td><input type="text" name="email" style="width:300px;" /></td>
</tr><tr>
<td class="dane">treść<br/>wiadomości:&nbsp;</td>
<td><textarea cols="10" rows="10" name="trescwiadomosci" style="height:150px; width:300px;"></textarea></td>
</tr><tr>
<td>&nbsp;</td>
<td><input type="submit" name="submit" value="wyślij maila" /></td>
</tr>
</table>
</form>
</div>
<?php
}elseif(!empty($_POST['imienazwisko']) && !empty($_POST['email']) && !empty($_POST['trescwiadomosci'])){
/* Funkcja sprawdzająca poprawność E-Maila */
function SprawdzEmail($email) {
if (!eregi("^[_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,4}$" , $email)){
return false;
}
return true;
}
if(SprawdzEmail($_POST['email'])){
/* Tworzymy szkielet wysyłanej wiadomości */
$adresemail="mateuszsikora2@gmail.com";
$ip=$_SERVER['REMOTE_ADDR'];
$host=gethostbyaddr($_SERVER['REMOTE_ADDR']);
$wiadomosc="Od: $_POST[imienazwisko] ($_POST[email])\nIP: $ip, HOST: $host\n\n$_POST[trescwiadomosci]";
$nadawca="From: $_POST[email]";
@mail($adresemail, "Formularz kontaktowy", "$wiadomosc", "$nadawca") or die('Formularz nie został wysłany');
echo "Dziękuję, mail został wysłany.";
}else{ echo "Wprowadzony adres e-mail jest niepoprawny"; }
}else{ echo "Wypełnij wszystkie pola formularza"; }
?>
						<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
						


			
					</div>
					
					
				</div>
				<!--koniec div srodkowa czesc zawartosci-->
				<div id="dolna_czesc_zawartosci"></div>
			
			</div>
		
		<div id="stopka">
			&copy; 2011 Matys created by Mateusz Sikora
			
		</div>
		
		
	  </div>
	  <!-- koniec div kontener-->
	</div>
	
	
		
		
	</body>
</html>
