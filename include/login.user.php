<title>Library</title>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body bgcolor="#EEEEEE">

    
<?php
require_once 'login.to.base.php';
if (isset($_GET['action']))
if (($_GET['action']) == "log_out")
{
    $_SESSION["logged"] = NULL;
    
    session_destroy();
    echo "You are succefully log out<br />";
}
connect();

if (isset($_GET['activation_code']))
{
    if ($_GET['activation_code'] == "sendcode")
    {
        connect;
        $login = $_SESSION["login"];
        $login = mysql_real_escape_string($login);
        $wyborbazy = mysql_select_db("matys_baza");
        $query = "SELECT login, password, email, permissions, activation_code FROM users WHERE login = '$login' LIMIT 1
            ";
        $result = mysql_query($query) or die (mysql_error());
        $row = mysql_fetch_assoc($result);
        $activation_code = $row["activation_code"];
        $activation_code = mysql_real_escape_string($activation_code);
        $email = $row['email'];


        $contents = "Tap link to register: <a href='http://matys.jupe24.pl/biblioteka/registration.php?activation_code=$activation_code'>http://matys.jupe24.pl/biblioteka/registration.php?activation_code=$activation_code</a>";
        $topic = "Registration on site www.matys.jupe24.pl/biblioteka/ ";

        $headlines = "Content-type: text/html; charset=UTF8\r\n".
        "From: "."ismatys@onet.pl"."\r\n".
        "Reply-to: "."ismatys@onet.pl"."\r\n";
        if (mail($email, $topic, $contents, $headlines))
        echo "Activation E-Mail was sented ";
        else echo "Activation E-Mail error ";
        disconnect();
    }
}




if ((isset($_POST['login']) && (isset($_POST['password']))) && empty($_SESSION['logged']))
{
    
        
    $salt = "grogn540gnobvn5re5njy";
    $_POST['login'] = filter_var($_POST['login'], FILTER_SANITIZE_STRING);
    $login = $_POST['login'];
    $_POST['password'] = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $_POST['password'] = hash("sha512", $salt.$_POST['password']);


    connect();
    $wyborbazy = mysql_select_db("matys_baza");
    $query = 
        "SELECT user_id, login, password, email, permissions, activation_code FROM users WHERE login = '$login' LIMIT 1
        ";
    $result = mysql_query($query) or die (mysql_error());
    $row = mysql_fetch_assoc($result);
    $activation_code = $row['activation_code'];
    $_SESSION['user_id'] = $row['user_id'];   



    //if (isset($row['permissions']))


    if (($_POST['login'] == $row['login']) && ($_POST['password'] == $row['password']) && ($row['permissions'] == 1))
    {                      
        $_SESSION["login"] = $_POST['login'];
        $_SESSION["logged"] = $row['permissions'];
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION["logged"] = 1;

    }




    else if (($_POST['login'] == $row['login']) && ($_POST['password'] == $row['password']) && ($row['permissions'] == 2))
    {
        
        $_SESSION["login"] = $_POST['login'];
        $_SESSION["logged"] = $row['permissions'];
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION["logged"] = 2;
    }



    else if (($_POST['login'] == $row['login']) && ($_POST['password'] == $row['password']) && ($row['permissions'] == 3))
    {      
        $_SESSION["login"] = $_POST['login'];
        $_SESSION["logged"] = $row['permissions'];
        $_SESSION['user_id'] = $row['user_id'];
        $_SESSION["logged"] == 3;
    }

    else if ($_POST['login'] == "Matys" && $_POST['password'] == "3e2b76a7500a105b5e0b63e860785ce02ffdc325f03207b05da225ce8c8bbda8f1550112348b39f37b87dffc1ab4ed1732b878538cf4f32f1eb4ab3308e0a95e")
    {       
        $_SESSION["login"] = $_POST['login'];        
        $_SESSION["logged"] = 2;
    }


    else if($_POST['login'] == "admin" && $_POST['password'] == "5b6d17ec44a72ad89728b1ae63a9a646ecb32460059134a3f60d20d39f4e02fef45873502b62a2375430f1bbffd1cc859a7fde35092a17b482985737eb13d1e0")
    {      
        $_SESSION["login"] = $_POST['login'];
        
        $_SESSION["logged"] = 3;
    }
        
}


if (isset($_SESSION['logged']))
{
    if ($_SESSION['logged'] == 1)
    {
        echo "You are logged as: <font style='color:grey'>".$_SESSION["login"]."</font><br /> you are not registered check email and activate account <br />";
        if (!isset($_GET['activation_code']))
        {
        echo "Send activation E-mail<a href='index.php?activation_code=sendcode'>Send</a><br>";
        }
        echo "<a href='index.php?action=log_out'>log out</a><br />";
        $_SESSION["logged"] = 1;
    }
    elseif ($_SESSION['logged'] == 2)
    {
        echo "You are logged as: <font style='color:blue'>".$_SESSION["login"]."</font><br />";
        echo "<a href='index.php?action=log_out'>log out </a><br />";
        $_SESSION["logged"] = 2;
    }
    elseif ($_SESSION['logged'] == 3)
    {
        echo "You are logged as: <font style='color:red'>".$_SESSION["login"]."</font><br />";
        echo "<a href='index.php?action=log_out'>log out</a><br />";
        $_SESSION["logged"] = 3;
    }
}


if (empty($_SESSION["logged"]))
{
?>
    
LOG IN:
<form name="panellogin" method="post" action="index.php">
    <input type="text" name="login"/>
    <input type="password" name="password"/>
    <input type="submit" value="Log in"/>
</form>


<?php
echo "<a style='align:center;' href='registration.php'>REGISTRATION </a>";
}
disconnect();
//error_reporting(E_ALL);
//ini_set('display_errors','1');
?>