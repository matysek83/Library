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
connect();
include_once ("captcha/securimage/securimage.php");
if (empty($_POST['emailforpassword']) && empty($_GET['activation_password']))
{
?>          <form action='' method='post' name='form'>
            Type email: <input type='text' name='emailforpassword'><br>
            <img src='captcha/securimage/securimage_show.php' id='image' align='absmiddle' /> <br>
            code: <input type='text' name='code' size='10' maxlength='6'>
            <a href="forgot.password.php" onclick="document.getElementById('captcha').src = 'captcha/securimage/securimage_show.php?' + Math.random(); return false">[ Different Image ]</a>
            <input type='submit' value=' Send '>
           </form>";
<?php           
}

//sending email // select activation code from base
if (isset($_POST['emailforpassword']))
{
    if (!empty($_POST['emailforpassword']))
    {
        $emailforpassword = filter_var($_POST['emailforpassword'], FILTER_SANITIZE_EMAIL);
        if (isset($emailforpassword))
        {
            
            $img = new Securimage();
            $valid = $img->check($_POST['code']);
            if ($valid == FALSE) {
              die('Wrong captcha code!');             
            }
            

                $select = mysql_select_db("matys_baza");
                $query = "SELECT login, activation_code FROM users WHERE email='$emailforpassword' LIMIT 1";
                $result = mysql_query($query) or die (mysql_error());
                $row = mysql_fetch_assoc($result);
                $activation_code = $row['activation_code'];
                $login = $row['login'];


                $contents = "Hi $login ! Tap link to change password: <a href='http://matys.jupe24.pl/biblioteka/forgot.password.php?activation_password=$activation_code'>http://matys.jupe24.pl/biblioteka/forgot.password.php?activation_password=$activation_code</a>"; 
                $subject = "Change password: http://matys.jupe24.pl/biblioteka/";

                $headlines = "Content-type: text/html; charset=UTF8\r\n".
                "From: "."ismatys@onet.pl"."\r\n".
                "Reply-to: "."ismatys@onet.pl"."\r\n";
                if (mail($emailforpassword, $subject, $contents, $headlines))
                {
                    echo "sended email";
                }
            
        }
        
        
    }
}
$login = $row['login'];
// write new password // chcecking if adde once
if (isset($_GET['activation_password']))
{
    if (!empty($_GET['activation_password']))
    {
        
        
      
        
        $activation_code = $_GET['activation_password'];
        $_SESSION['activation_password'] = $activation_code;
        echo "Hi $login!<br>";
        echo "<form action='' method='post' name ='activation_password'>";
        echo "<input type='password' name='newpassword'>";
        echo "<input type='password' name='newpassword1'>";
        echo "<input type='hidden' name='activation_code' value='$activation_code'>";
        echo "<input type='submit' value=' Send new password '>";
        echo "</form>";
            
        
    }
}
//checking password //create Session // hash password // update database
if (isset($_POST['newpassword']) && isset($_POST['newpassword1']) && isset($_POST['activation_code']))
{
    if (!empty($_POST['newpassword']) && !empty($_POST['newpassword1']) && !empty($_POST['activation_code']))
    {
        if (($_POST['newpassword']) == ($_POST['newpassword1']))
        {      
            if ($_SESSION['newpassword'] == $_POST['newpassword'].$_POST['activation_code'])
            {
                echo "can add only once";
            }
            else 
            {
                $_SESSION['newpassword'] = $_POST['newpassword'].$_POST['activation_code'];
                $activation_code = filter_var($_POST['activation_code'], FILTER_SANITIZE_STRING);
                $selectdb = mysql_select_db("matys_baza");
                $newpassword = filter_var($_POST['newpassword'], FILTER_SANITIZE_STRING);
                $salt = "grogn540gnobvn5re5njy";     
                $newpassword = hash("sha512", $salt.$newpassword);
                $query = "UPDATE users SET password = '$newpassword' WHERE activation_code = '$activation_code'"; 
                $result = mysql_query($query) or die (mysql_error());
                if ($result)
                {
                    echo "$login You have changed password";
                }
                else echo "Error updating database";
            }   
        }else echo "Password must be identical";
    }
}
    


disconnect();                                           
ini_set('display_errors', 1);
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
