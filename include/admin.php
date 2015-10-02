<?
include_once "include/logowanie.include.php";
?>
<html>
<title>Cwiczenia z baza danych dla infotechu</title>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body bgcolor="#DDDDDD" text="#000000">
<font face="tahoma" size="2">

    <div style="text-align: center;">
<?php
include_once "include/logowanie.do.bazy.php";
if ($_SESSION["zalogowany"] == 3)
{
polaczenie();

if (!mysql_select_db("matys_baza"))
{
    echo "nie ma bazy danych tworzę nową bazę: biblioteka<br />";
    $baza = mysql_query("CREATE DATABASE matys_baza;");
}

$wyborbazy = mysql_select_db("matys_baza");

$tworzenie_tabeli = mysql_query("
        CREATE TABLE IF NOT EXISTS tabelabiblioteka
        (id_ksiazki INT unsigned AUTO_INCREMENT,
        nazwa VARCHAR(50) NOT NULL,
        autor VARCHAR(50) NOT NULL,
        wydawnictwo VARCHAR(50) NOT NULL,
        rok_wyd SMALLINT NOT NULL,
        oprawa TINYINT NOT NULL,
        akt_stan TINYINT NOT NULL,
        data_dodania_ksiazki TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id_ksiazki)
        )") ;
mysql_query($tworzenie_tabeli);

$query = "SELECT * from tabelabiblioteka";
$result = mysql_query($query) or die(mysql_error());



echo
"<table bgcolor=#EEEEEE border=1 align=center><tr>
<th>LP</th>
<th>ID</th>
<th>Nazwa</th>
<th>Autor</th>
<th>Wydawnictwo</th>
<th>Rok wyd.</th>
<th>Oprawa</th>
<th>Dostepność</th>
<th>OPCJE</th>
</tr>";


for ($i = 0; $i < mysql_num_rows($result); $i++)
{
    $row = mysql_fetch_assoc($result);
    if ($row['oprawa'] == 1)
    $row['oprawa'] = "twarda";
    else $row['oprawa'] = "miękka";

    if ($row['akt_stan'] ==1)
    $row['akt_stan'] = "dostępna";
    else $row['akt_stan'] = "niedostępna";
    $usun_id = $row['id_ksiazki'];
    $edit_id = $row['id_ksiazki'];

    echo "<tr align=center><td>".($i+1)."</td>";
    echo "<td>".$row['id_ksiazki']."</td>";
    echo "<td>".$row['nazwa']."</td>";
    echo "<td>".$row['autor']."</td>";
    echo "<td>".$row['wydawnictwo']."</td>";
    echo "<td>".$row['rok_wyd']."</td>";
    echo "<td>".$row['oprawa']."</td>";
    echo "<td>".$row['akt_stan']."</td>";
    echo "<td><a href='edit.php?id=$edit_id' onclick='return confirm(\"Czy na pewno?\")'>edit</a> | <a href='usun.php?id=$usun_id' onclick='return confirm(\"Czy na pewno?\")'>usuń</a></td></tr>";
}


echo "</table>";
echo "<br><br>
<input type='button' style='padding:20px;' value=' Odswiez ' onClick='parent.location.href=\"admin.php\"'>
<form action='dodaj.php' method=post>
<input type='submit' style='padding:20px;' value='Dodaj ksiazke' method='post'></form>
<br><br>";


//panel z użytkownikami

$query = "SELECT * from users";
$result = mysql_query($query) or die(mysql_error());



echo
"<table bgcolor=#EEEEEE border=1 align=center><tr>
<th>LP</th>
<th>ID</th>
<th>Login</th>
<th>E-Mail</th>
<th>Uprawnienia</th>
<th>Data rejestracji</th>
<th>OPCJE</th>
</tr>";


for ($i = 0; $i < mysql_num_rows($result); $i++)
{
    $row = mysql_fetch_assoc($result);
    if ($row['uprawnienia'] == 1)
    $row['uprawnienia'] = "niezarejestrowany";
    else if ($row['uprawnienia']==2)
    $row['uprawnienia'] = "zarejestrowany";
    else if ($row['uprawnienia']==3)
    $row['uprawnienia'] = "admin";
    

    $usun_id = $row['id'];
    $edit_id = $row['id'];

    echo "<tr align=center><td>".($i+1)."</td>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['login']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['uprawnienia']."</td>";
    echo "<td>".$row['data_dodania_wpisu']."</td>";
    echo "<td><a href='edit.uzytkownik.php?id=$edit_id' onclick='return confirm(\"Czy na pewno?\")'>edit</a> | <a href='usun.uzytkownik.php?id=$usun_id' onclick='return confirm(\"Czy na pewno?\")'>usuń</a></td></tr>";
}


echo "</table>";
zamknij_baze();
}
?>

</div>
</html>