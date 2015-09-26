              
                        <div id="srodkowe_menu">
			<ul id="pierwszy_poziom" style="margin-left: 400px;">
				<li><a href="index.php"><span class="link2">Start</span></a></li>
					<li><span class="odstepik">: - :</span></li>
					<li><a href="#"><span class="link2">Books base</span></a>
                                            <ul class="drugi_poziom">
							<li class="pierwszy_element_menu"><a href="searchbooks.php">Search books</a></li>
							<li><a href="allbooks.php">All books</a></li>
                                                        <li><a href="my.ordered.books.php">Ordered books</a></li>
                                            </ul>
						
					</li>
				
									
                                        <li><span class="odstepik">: - :</span></li>
					<li><a href="#"><span class="link2">Settings</span></a>
						
                                            <ul class="drugi_poziom">
                                                <li class="pierwszy_element_menu"><a href="registration.php">Registration</a></li>
                                                <li><a href="forgot.password.php">Forgot password</a></li>
                                                <li><a href="change.password.php">Change password</a></li>
                                            </ul>
						</li>
					<li><span class="odstepik">: - :</span></li>
					<li><a href="guestbook.php"><span class="link2">Guest book</span></a></li>
					<?php if (isset($_SESSION['logged']))
					if  ($_SESSION["logged"] == 3 && $_SESSION["logged"] !=2 && $_SESSION["logged"] !=1) { ?>
					<li><span class="odstepik">: - :</span></li>
					<li><a href="ksiega.php"><span style="color:red"; class="link2">Admin Panel</span></a>
						<ul class="drugi_poziom">
							<li class="pierwszy_element_menu"><a href="admin.user.account.php">User account</a></li>
							<li><a href="admin.books.php">Admin Books</a></li>
                                                        <li><a href="admin.search.books.php">Admin Search Books</a></li>
							<li><a href="admin.history.php">History</a></li>
						</ul>
					
					
					</li>
                                        <?php } ?>
					
			</ul>
                        </div>