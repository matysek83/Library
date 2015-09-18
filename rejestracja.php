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
                                            <form method="post" action="rejestracja.php" name="formularz">
                                            LOGIN: <input type="text" size="30" maxlength="40" name="login" value="<? if (isset( $_POST['login'])) echo $_POST['login'];?>"/><br /><br />
                                            PASSWORD: <input type="password" size="30" maxlength="40" name="password" ><br /><br />
                                            PASSWORD1: <input type="password" size="30" maxlength="40" name="password1"><br /><br />
                                            EMAIL: <input type="text" size="30" maxlength="40" name="email" value="<? if (isset( $_POST['email'])) echo $_POST['email'];?>"/><br /><br />
                                            EMAIL1: <input type="text" size="30" maxlength="40" name="email1" value="<? if (isset( $_POST['email1'])) echo $_POST['email1'];?>"/><br /><br />
                                            <input type="submit" value=" Wyślij ">
                                            </form>
                                            
                                            
<?


?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<form method="post" action="rejestracja.php" name="formularz">
    LOGIN: <input type="text" size="30" maxlength="40" name="login" value="<? if (isset( $_POST['login'])) echo $_POST['login'];?>"/><br /><br />
    PASSWORD: <input type="password" size="30" maxlength="40" name="password" ><br /><br />
    PASSWORD1: <input type="password" size="30" maxlength="40" name="password1"><br /><br />
    EMAIL: <input type="text" size="30" maxlength="40" name="email" value="<? if (isset( $_POST['email'])) echo $_POST['email'];?>"/><br /><br />
    EMAIL1: <input type="text" size="30" maxlength="40" name="email1" value="<? if (isset( $_POST['email1'])) echo $_POST['email1'];?>"/><br /><br />
    <input type="submit" value=" Wyślij ">
</form>
<?php

require_once("phpmailer/class.phpmailer.php");
include_once "include/logowanie.do.bazy.php";
polaczenie();
mysql_set_charset("utf8");
$wyborbazy = mysql_select_db("matys_baza");
mysql_query("SET CHARACTER SET UTF8");
   if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password1']) && isset($_POST['email']) && isset($_POST['email1']))
    {
        if ((!empty($_POST['login']) && (!empty($_POST['password'])) && (!empty($_POST['password1'])) && (!empty($_POST['email'])) && (!empty($_POST['email1']))))
        {
            if (($_POST['password']==$_POST['password1'])&&($_POST['email']==$_POST['email1']))
            {
                if (($_SESSION["czydodany"]) == ($_POST['login'].$_POST['password'].$_POST['password1'].$_POST['email'].$_POST['email1']))
                echo "dodałeś już jeden wpis";
                if (($_SESSION["czydodany"]) != ($_POST['login'].$_POST['password'].$_POST['password1'].$_POST['email'].$_POST['email1']))
                {
                    $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
                    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
                    $password1 = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
                    $email = filter_var($email, FILTER_VALIDATE_EMAIL) ;
                    $email1 = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
                    $email1 = filter_var($email, FILTER_VALIDATE_EMAIL) ;
                    $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);


                    if (!empty($email))
                    {
                        $wyborbazy = mysql_select_db("matys_baza");
                        $query = "CREATE TABLE IF NOT EXISTS users
                            (id INT unsigned AUTO_INCREMENT,
                            login VARCHAR(50) NOT NULL UNIQUE,
                            password VARCHAR(50) NOT NULL,
                            email VARCHAR(50) NOT NULL UNIQUE,
                            uprawnienia SMALLINT unsigned NOT NULL,
                            kod VARCHAR(128) NOT NULL,
                            data_dodania_wpisu TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                            PRIMARY KEY (id))
                              ";
                        
                        mysql_query($query) or die(mysql_error());


                        $_SESSION["czydodany"] = $login.$password.$password1.$email.$email1; // czy dodany
                        $salt = "grogn540gnobvn5re5njy";                                 //sól
                        $kod = hash("sha512", ($salt.$login.$password.$email));
                        $tresc = " <a href='http://praca.matys.gpe.pl/biblioteka/rejestracja.php?kod=$kod'>http://praca.matys.gpe.pl/biblioteka/rejestracja.php?kod=$kod</a>";
			$do = $email;  
			$temat = "Rejestracja na stronie praca.matys.gpe.pl/biblioteka/ ";

                        $naglowki = "Content-type: text/html; charset=UTF8\r\n".
                        "From: "."matys777@o2.pl"."\r\n".
                        "Reply-to: "."matys777@o2.pl"."\r\n";
                         mail($do, $temat, $tresc, $naglowki);
                         
                         
                         
                         $password = hash("sha512", $salt.$password);
                        
                        $sSql = "
                            INSERT INTO users(login, password, email, uprawnienia, kod, data_dodania_wpisu) VALUES ('$login', '$password', '$email', 0 ,'$kod', (CURRENT_TIMESTAMP))
                                ";
                        $query = mysql_query($sSql) or die(mysql_error());
                        echo "został wysłany mail aktywacyjny";
                    } else echo "zły format emaila";

              }
       }
        else echo "pola password i password1 oraz email i email1 musza być jednakowe";
  }
    else echo "są puste pola";
}

                    if (isset($_GET["kod"]))
                    {

                         $kod = filter_var($_GET["kod"], FILTER_SANITIZE_STRING);
                         $query = "UPDATE users SET
                             uprawnienia = 2
                             WHERE kod = '$kod'";
                         $result = mysql_query($query) or die (mysql_error());
                         if (mysql_query($query) != NULL) echo "zostałeś pomyślnie zarejestrowany";
                         else echo "blad";



                  }


zamknij_baze();
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
