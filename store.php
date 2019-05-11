<?php

$host = "localhost";
$database = "music_shop";
$user = "root";
$pwd = "";

$connection = mysqli_connect($host, $user, $pwd, $database);

if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"],"item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'		=> $_GET["id"],
				'item_name'	=> $_POST["hidden_name"],
				'item_price'	=> $_POST["hidden_price"],
				'item_quantity' => $_POST["quantity"]
			);
			$_SESSION["shopping_cart"]["$count"] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
			echo '<script>window.location="ShoppingCart.php"</script>';
		}
	}
	else
	{
		$item_array = array(
			'item_id'		=> $_GET["id"],
			'item_name'	=> $_POST["hidden_name"],
			'item_price'	=> $_POST["hidden_price"],
			'item_quantity' => $_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}
if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo'<script>alert("Item Removed")</script>';
				echo'<script>windoe.location="ShoppingCart.php"</script>';
			}
		}
	}
}
?>

<html>
    <head>
        <title>Store</title>
        <link type="text/css" href="style.css" rel="stylesheet">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
		<nav>
			<div class="headerbar">
					<a href="index.php" class="active">Home</a>
					<div style="text-align:center">
					</div> 
			</div>
			<?php
				$sql = "SELECT * FROM products ORDER BY id ASC";
				$rlst = mysqli_query($connection, $sql);
				if(mysqli_num_rows($rlst)>0)
				{
					while($row = mysqli_fetch_array($rlst))
				{
				
			?>
				<?php while($row = mysqli_fetch_assoc($rlst)){ ?>
						<div class="col-sm-6 col-md-3">
							<form method="post" action="ShoppingCart.php?action=add&id=<?php echo $row["id"]; ?>">
								<img src="assets/<?php echo $row['image']; ?>" alt="<?php echo $row['name'] ?>">
								<div class="caption">
									<h3><?php echo $row['name'] ?></h3>
									<h4 class="text_info"><?php echo $row["name"];?></h4>
									<h4 class="text-danger"><?php echo $row["price"];?></h4>
									<input type="text" name="quantity" class="for-control" value="1">
									<input type="hidden" name="hidden_name" value="<?php echo $row["name"] ?>">
									<input type="hidden" name="hidden_price" value="<?php echo $row["price"] ?>">
									<input type="submit" name="add_to_cart" style="margin-top:5px" class="btn btn-success"  value="Add to Cart">
								</div>
							</form>
						</div>
				<?php } ?>  
		<?php
				}
			
			}
		?>			
		
			

		</nav>
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
    </body>
</html>