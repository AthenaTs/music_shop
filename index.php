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
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	
</head>

<body>
 <link type="text/css" href="style.css" rel="stylesheet">
<nav class="navbar navbar-inverse">
	<div class="container-fluid">
		<div class="navbar-header">
		<a class="navbar-brand" href="#">VCDshop</a>
    </div>
	<ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Pages
<span class="caret"></span></a>	
 <ul class="dropdown-menu">
          <li><a href="#">Explore</a></li>
          <li><a href="#">Marketplace</a></li>
          <li><a href="contact.html">Contact</a></li>
		  <li><a href="About.html">About us</a></li>
		  
		  
        </ul>
	    </li>
         
		 <li><a href="https://facebook.com"><img src="images/icon10.png"></a>
		 <li><a href="https://mail.google.com"><img src="images/icon9.png"></a>
		 <li><a href="https://www.instagram.com"><img src="images/icon8.png"></a>
		 <li><a href ="ShoppingCart.html"><img src="images/icons8-shopping-cart-50.png"></a></li>
		
    </ul>
	
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>

  <div class="footer"></div>
	
		
	<p id="p-1">PRODUCT</p>
	</nav>
	
	
	<ul>
		<?php
		$rlst = $connection->query("select * from products");
		if (!$rlst) {
			echo "---ERROR 404---";
		} else {
			while ($row = $rlst->fetch_assoc()) {
				echo "<li>" . $row["id"] . " " . $row["name"] . " "
					. $row["price"] ."</li>";
			}
		}
		?>
	</ul>
	

</body>

</html>