<?php

$host = "localhost";
$database = "music_shop";
$user = "root";
$pwd = "";

$connection = mysqli_connect($host, $user, $pwd, $database);

if (!$connection) {
	echo "Ops! No server connection";
} else {
	// $result = $connection->query("SELECT * FROM products");

	//while($row = $result->fetch_assoc()) {
	//echo $row["name"]." with price of ". $row["price"] ."<br>";
	//}
}
?>
<html>

<head>
	<title>VCDShop</title>
	<link type="text/css" href="style.css" rel="stylesheet">
	
</head>

<body>
	<div class="main"> 
		<div class="topbar">
				<div id="side_nav" class="side_nav">
					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
					<a href="#">EXPLORE</a>
					<a href="#">MARKETPLACE</a>
					<a href="#">CONTACT</a>
					<a href="#">ABOUT</a>
				</div>
				<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
				<script>
				function openNav() {
					document.getElementById("side_nav").style.width = "250px";
				}

				function closeNav() {
				document.getElementById("side_nav").style.width = "0";
				}
				</script>
		</div>

		<div class="social_icon">
				<div class="container"> 
					<div class="icon">
						<a href="https://facebook.com"><img src="images/icon10.png"></a>
						<a href="https://mail.google.com"><img src="images/icon9.png"></a>
						<a href="https://www.instagram.com"><img src="images/icon8.png"></a>
					</div>
					<div class="header-centered">
						<input type="text" placeholder="Search..">
					</div>
					<div class="header_right">
						<div class="login_register_buttons">
							<a href="">Login /</a>
							<a href=""> Register</a>
						</div>
						<div class="cart_btn">
							<img src="images/icon7.png">
							<span>Cart (0)</span>
						</div>
					</div>
				</div>	
			</div>
		<div class="header">
			<div class="container">
				<div class="logo">
					<img src="images/icons8-music-record-100 (1).png">
				</div>
			</div>
		</div>
	

	</div> 
	<div class="footer"></div>
		
	<p id="p-1">PRODUCT</p>
	<!button onclick="buttonClick()"/button>
	<ul>
		<?php
		$rlst = $connection->query("select * from products");
		if (!$rlst) {
			echo "---ERROR 404---";
		} else {
			while ($row = $rlst->fetch_assoc()) {
				echo "<li>" . $row["id"] . " " . $row["name"] . " "
					. $row["price"] . "</li>";
			}
		}
		?>
	</ul>
	<script>
		
		function buttonClick() {
			alert('HAHAHAHAHAHAHHAHAHA')
		}
	</script>
</body>

</html>