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
                include_once ("captcha/securimage/securimage.php");
		?>
		<!-- koniec div srodkowe menu-->
		
			<div id="zawartosc">
				<div id="gorna_czesc_zawartosci"></div>
				<div id="srodkowa_czesc_zawartosci">
					<div id="tekst">
                                            <form method="post" action="registration.php" name="formularz">
                                            LOGIN: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="30" maxlength="40" name="login" value="<?php if (isset($_POST['login'])) echo $_POST['login']; ?>"/><br /><br />
                                            PASSWORD: &nbsp;&nbsp;<input type="password" size="30" maxlength="40" name="pass" /><br /><br />
                                            PASSWORD1: <input type="password" size="30" maxlength="40" name="pass1" /><br /><br />
                                            EMAIL: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="30" maxlength="40" name="email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"/><br /><br />
                                            EMAIL1: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" size="30" maxlength="40" name="email1" value="<?php if (isset($_POST['email1'])) echo $_POST['email1']; ?>"/><br /><br />
                                            <img src="captcha/securimage/securimage_show.php" id="image" align="absmiddle" /> <br> 
                                            Captcha code: <input type="text" name="code" size="10" maxlength="6"> 
                                            <a href="registration.php" onclick="document.getElementById('captcha').src = 'captcha/securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
                                            
                                            <input type="submit" value=" Send " />
                                            </form>
                                            
                                  
                                            
                                            
<?php




$db_h = connect();
//mysqli_query($db_h, "SET CHARACTER SET UTF8");
if (isset($_POST['login']) && isset($_POST['pass']) && isset($_POST['pass1']) && isset($_POST['email']) && isset($_POST['email1']))
{
    if ((!empty($_POST['login']) && (!empty($_POST['pass'])) && (!empty($_POST['pass1'])) && (!empty($_POST['email'])) && (!empty($_POST['email1']))))
    {
        if (($_POST['pass'] == $_POST['pass1']) && ($_POST['email'] == $_POST['email1']))
        {
            if (isset($_SESSION["ifadded"]))
            {
                if (($_SESSION["ifadded"]) == ($_POST['login'].$_POST['password'].$_POST['password1'].$_POST['email'].$_POST['email1'])) 
                {
                    die ("you have already added!");

                }
            }
            include_once ("captcha/securimage/securimage.php");
            $img = new Securimage();
            $valid = $img->check($_POST['code']);
            if ($valid == FALSE) {
              die('Wrong captcha code!');
            }     

            $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
            $password = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
            $password1 = filter_var($_POST['pass1'], FILTER_SANITIZE_STRING);
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ;
            $email1 = filter_var($_POST['email1'], FILTER_VALIDATE_EMAIL) ;
            $login = filter_var($_POST['login'], FILTER_SANITIZE_STRING);


            if (isset($email))
            {
                
                $query = "CREATE TABLE IF NOT EXISTS users
                        (id INT unsigned AUTO_INCREMENT,
                        login VARCHAR(50) NOT NULL UNIQUE,
                        password VARCHAR(50) NOT NULL,
                        email VARCHAR(50) NOT NULL UNIQUE,
                        permissions SMALLINT(4) unsigned NOT NULL,
                        activation_code VARCHAR(128) NOT NULL,
                        date_added_entry TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        PRIMARY KEY (id))
                          ";

                mysqli_query($db_h, $query) or die(mysqli_error($db_h));


                $_SESSION["ifadded"] = $login.$password.$password1.$email.$email1; // czy dodany
                $salt = "grogn540gnobvn5re5njy";                                 //sól
                $activation_code = hash("sha512", ($salt.$login.$password.$email));
                $contents = "Tap link to register: <a href='http://matys.jupe24.pl/biblioteka/registration.php?activation_code=$activation_code'>http://matys.jupe24.pl/biblioteka/registration.php?activation_code=$activation_code</a>"; 
                $subject = "Registration on site: http://matys.jupe24.pl/biblioteka/ ";

                $headlines = "Content-type: text/html; charset=UTF8\r\n".
                "From: "."ismatys@onet.pl"."\r\n".
                "Reply-to: "."ismatys@onet.pl"."\r\n";
                

                $password = hash("sha512", $salt.$password);


                $sSql = "
                        INSERT INTO users (login, password, email, permissions, activation_code, date_added_entry) VALUES ('$login', '$password', '$email', 1 ,'$activation_code', (CURRENT_TIMESTAMP))
                                ";
                $query = mysqli_query($db_h, $sSql) or die(mysqli_error($db_h));
                if ($query)
                {
                    echo 'written to database...';
                    if (mail($email, $subject, $contents, $headlines))
                    echo "There was sented activation code ";
                    else echo "email error ";
                }
                else echo 'database error';
                   
            } else echo "wrong email format";

        } else echo "fields password and password1, email and email1 must be same";
    } else echo "there are empty fields";
    
}
	
	

if (isset($_GET["activation_code"]))
{

	 $activation_code = filter_var($_GET["activation_code"], FILTER_SANITIZE_STRING);
	 $query = "UPDATE users SET
		 permissions = 2
		 WHERE activation_code = '$activation_code'";
	 $result = mysqli_query($db_h, $query) or die (mysqli_error($db_h));
	 if (mysqli_query($db_h, $query) != NULL) echo "you are registered please re login! ";
	 else echo "error";


}
    

disconnect();;
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
