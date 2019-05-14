<?php

$host = "localhost";
$database = "music_shop";
$user = "root";
$pwd = "";

$connection = mysqli_connect($host, $user, $pwd, $database);

if(isset($_POST["add_to_cart"]))
{
	echo"kati";
	//$_SESSION["shopping_cart"] = array();
	if(!empty($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"],"item_id");
		echo"something";
		if(!in_array($_GET["id"], $item_array_id))
		{
			echo"phnel";
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_id'		=> $_GET["id"],
				'item_name'	=> $_POST["hidden_name"],
				'item_price'	=> $_POST["hidden_price"],
				'item_quantity' => $_POST["quantity"]
			);
			$_SESSION["shopping_cart"]["$count"] = $item_array;
			echo '<script>window.location="store.php"</script>';
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
			echo '<script>window.location="store.php"</script>';
		}
	}
	else
	{
		$_SESSION["shopping_cart"] = array();
		echo"athina";
		$item_array = array(
			'item_id'		=> $_GET["id"],
			'item_name'	=> $_POST["hidden_name"],
			'item_price'	=> $_POST["hidden_price"],
			'item_quantity' => $_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] =  $item_array;
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
				echo'<script>alert("Item Removed successfully")</script>';
				echo'<script>window.location="store.php"</script>';
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
								<a href="index.html" class="active">Home</a>
								<div style="text-align:center">
								</div> 
						</div>
						<div class="container_store" style="width:500px;">
							<?php
								$sql = "SELECT * FROM products ORDER BY id ASC";
								$rlst = mysqli_query($connection, $sql);
								$x=mysqli_num_rows($rlst);
								echo"$x";
								if(mysqli_num_rows($rlst)>0)
								{
												?>
												<?php while($row = mysqli_fetch_assoc($rlst)){ ?>
														<div class="col-md-3">
																<form method="post" action="store.php?action=add&id=<?php echo $row["id"]; ?>">
																<img src="assets/<?php echo $row['image']; ?>" alt="<?php echo $row['name'] ?>">
																<div class="caption">
																	<h3><?php echo $row['name'] ?></h3>
																	<h4 class="text_info">$<?php echo $row["price"];?></h4>
																	<h4 class="text-danger">quantity left in store: <?php echo $row["quantity"];?></h4>
																	<input type="text" name="quantity" class="form-control" value="0">
																	<input type="hidden" name="hidden_name" value="<?php echo $row["name"] ?>">
																	<input type="hidden" name="hidden_price" value="<?php echo $row["price"] ?>">
																	<input type="submit" name="add_to_cart" style="margin-top:5px" class="btn-success"  value="Add to Cart">
																</div>
															</form>
														</div>
												<?php 

															} ?>  
					<?php
									
						
								}
					?>	
	</div>	
		<div style="clear:both" ></div>	
		<h3>Order Details</h3>
                    <div class="table-responsive">
                      <table class="table-bordered">
                        <tr>
                          <th width="30%">Item Name</th>
													<th width="20%">Quantity</th>
                          <th width="20%">Price</th>
                          <th width="20%">Total Price</th>
													<th width="22%">Remove Item</th>
													<th width="22%">Buy</th>
                        </tr>
                        <?php
                        if(!empty($_SESSION["shopping_cart"]))
                        {
													echo count($_SESSION["shopping_cart"]);
                          $total = 0;
                          foreach($_SESSION["shopping_cart"] as $keys => $values)
                          {
														//echo"{$keys}=> {$values}";
														print_r($_SESSION["shopping_cart"]);
												?>
                        <tr>

                          <td><?php echo $values["item_name"];?></td>
                          <td><?php echo $values["item_quantity"];?></td>
                          <td>$ <?php echo $values["item_price"]; ?></td>
                          <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>                       
                          <td><a href="store.php?action=delete&id=<?php echo $values["item_id"];?>"><span class="text-danger">Remove</span></a></td>  
													<td><a href="store.php?action="><span class="text-danger">Buy</span></a></td>	
												</tr>
                        <?php 
														$total = $total + ($values["item_quantity"] * $values["item_price"]); 
														//$sql="UPDATE products SET quantity='$_POST[quantity]' WHERE id=$_POST[id]";
											
													}
													
													?>

                          <?php
                        }
												?>
												
                      </table>

                    </div>	
		
			

		</nav>
	
    </body>
</html>