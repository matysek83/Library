<?php
include_once "include/session.start.inc.php";
?>
<!--metatagi, kodowanie, skrypt google analitics-->
<?php
include_once "include/meta.inc.php";
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
		include_once "include/middle.menu.inc.php";
		?>
		<!-- koniec div srodkowe menu-->

			<div id="zawartosc">
                            <div id="gorna_czesc_zawartosci"></div>
				<div id="srodkowa_czesc_zawartosci">
					<div id="tekst">
					<br />
<?php                                              
if (isset($_SESSION["logged"]))
{
    if ($_SESSION["logged"] == 3)
    {
        $db_h = connect();
    
        $query = "SELECT * from users";
        $result = mysqli_query($db_h, $query) or die(mysqli_error($db_h));


        echo
        "<table bgcolor=#EEEEEE  border='1' align=center  width='880'><tr align=center>
        <th>LP</th>
        <th>USER ID</th>
        <th>Login</th>
        <th>E-Mail</th>
        <th>Permissions</th>
        <th>Date added entry</th>         
        <th>OPTIONS</th>
        </tr>";


        for ($i = 0; $i < mysqli_num_rows($result); $i++)
        {
            $row = mysqli_fetch_assoc($result);
            if ($row['permissions'] == 1)
            $row['permissions'] = "not registered";
            else if ($row['permissions']==2)
            $row['permissions'] = "registered";
            else if ($row['permissions']==3)
            $row['permissions'] = "admin";


            $del_id = $row['user_id'];
            $edit_id = $row['user_id'];
            $borrow_id = $row['user_id'];

            echo "<tr align=center><td>".($i+1)."</td>";
            echo "<td>".$row['user_id']."</td>";
            echo "<td>".$row['login']."</td>";
            echo "<td>".$row['email']."</td>";
            echo "<td width='150'>".$row['permissions']."</td>";
            echo "<td>".$row['date_added_entry']."</td>";
            echo "<td><a href='admin.edit.user.php?user_id=$edit_id'>edit</a> | <a href='admin.deleteuser.php?user_id=$del_id' onclick='return confirm(\"Are you sure?\")'>delete</a><br><a href='admin.borrowed.books.php?user_id=$borrow_id'>edit books</a></td></tr>";
        }
        /*echo
        "<table bgcolor=#EEEEEE  border='1' align=center  width='880'><tr align=center>
        <th>LP</th>
        <th>USER ID</th>
        <th>Login</th>
        <th>E-Mail</th>
        <th>Permissions</th>
        <th>Date added entry</th>         
        <th>OPTIONS</th>
        </tr>";*/

    echo "</table>";
    disconnect();;
    }
else echo "You are not Administrator!";
}
else echo "You are not Administrator!";
error_reporting(E_ALL);
?>
						<br />

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
