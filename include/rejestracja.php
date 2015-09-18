<?php
session_start();

if (!isset($_SESSION['initiate']))
{
        session_regenerate_id();
        $new_session_id = session_id();
        session_write_close();
        session_id($new_session_id);
        session_start();
        $_SESSION['initiate'] = 1;
}

?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<form method="post" action="rejestracja.php" name="formularz">
    LOGIN: <input type="text" size="30" maxlength="40" name="login" value="<? if (isset( $_POST['login'])) echo $_POST['login'];?>"/><br /><br />
    PASSWORD: <input type="password" size="30" maxlength="40" name="password" value="<? if (isset( $_POST['password'])) echo $_POST['password'];?>"><br /><br />
    PASSWORD1: <input type="password" size="30" maxlength="40" name="password1" value="<? if (isset( $_POST['password1'])) echo $_POST['password1'];?>"><br /><br />
    EMAIL: <input type="text" size="30" maxlength="40" name="email" value="<? if (isset( $_POST['email'])) echo $_POST['email'];?>"/><br /><br />
    EMAIL1: <input type="text" size="30" maxlength="40" name="email1" value="<? if (isset( $_POST['email1'])) echo $_POST['email1'];?>"/><br /><br />
    <input type="submit" value=" Wyślij ">
</form>
<?php

require_once("phpmailer/class.phpmailer.php");
include "include/logowanie.do.bazy.php";
polaczenie();
    if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['password1']) && isset($_POST['email']) && isset($_POST['email1']))
    {
        if ((!empty($_POST['login']) && (!empty($_POST['password'])) && (!empty($_POST['password1'])) && (!empty($_POST['email'])) && (!empty($_POST['email1']))))
        {
            if (($_POST['password']==$_POST['password1'])&&($_POST['email']==$_POST['email1']))
            {
                if (($_SESSION["czydodany"]) == ($_POST['login'].$_POST['password'].$_POST['password1'].$_POST['email'].$_POST['email1']))
                echo "dodałeś już jeden wpis, więcej nie dodasz";
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
                        $_SESSION["czydodany"] = $login.$password.$password1.$email.$email1; // czy dodany
                        $salt = "grogn540gnobvn5re5njy";                                      //sól
                        $kod = hash("md5", ($salt.$login.$password.$email));
                        $tresc = " <a href='http://praca.matys.gpe.pl/biblioteka/rejestracja.php?kod=$kod'>http://praca.matys.gpe.pl/biblioteka/rejestracja.php?kod=$kod</a>";
			$do = $email;  
			$temat = "Rejestracja na stronie praca.matys.gpe.pl/biblioteka/ ";

                        $naglowki = "Content-type: text/html; charset=UTF8\r\n".
                        "From: "."matys777@o2.pl"."\r\n".
                        "Reply-to: "."matys777@o2.pl"."\r\n";
                         mail($do, $temat, $tresc, $naglowki);
                         
                         
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
                        
                        $sSql = "
                            INSERT INTO users(login, password, email, uprawnienia, data_dodania_wpisu) VALUES ('$login', '$password', '$email', 0 ,'$kod', (CURRENT_TIMESTAMP))
                                ";
                        $query = mysql_query($sSql) or die(mysql_error());
                        echo "dane zostały dodane";
                    } else echo "zły format emaila";

              }
       }
        else echo "pola password i password1 oraz email i email1 musza być jednakowe";
  }
    else echo "są puste pola";
}

                    if (isset($_GET["getmail"]))
                    {
                        $salt = "grogn540gnobvn5re5njy";
                        $wyborbazy = mysql_select_db("matys_baza");
                         $query = "SELECT 'uprawnienia', 'kod'
                                    from users";
                         $result = mysql_query($query) or die (mysql_error());

                         for ($i = 0; $i < mysql_num_rows($result); $i++)
                         {
                             $row = mysql_fetch_assoc($result);
                             $kod = $row['id'];
                             //$zakodowane = (hash("md5", ($salt.$row['login'].$row['password'].$row['email'])));
                             echo $kod;
                             if ($kod == $_GET["kod"])
                             {
                                $query = "UPDATE users SET
                                     uprawnienia = '1'
                                     WHERE kod = '$kod' LIMIT 1
                                ";
                                $result = mysql_query($query) or die (mysql_error());
                                echo "dodalismy uprawnienia";
                                break;
                             }


                        }

                  }

              
    
error_reporting(E_ALL);
zamknij_baze();
?>
