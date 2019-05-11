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
				echo'<script>alert("Item Rmoved")</script>';
				echo'<script>windoe.location="ShoppingCart.php"</script>';
			}
		}
	}
}
?>


<html>
    <head>
        <title>Shopping Cart</title>
        <link type="text/css" href="style.css" rel="stylesheet">
        <style>
                body {
                  font-family: Arial;
                  font-size: 17px;
                  padding: 8px;
                }
                
                * {
                  box-sizing: border-box;
                }
        </style>
    </head>

    <body>
        <div class="headerbar">
            <a href="index.php" class="active">Home</a>
            <div style="text-align:center">
                <h2 id=h-1>Checkout Form</h2>
                <br>
            </div> 
        </div>   
            <div class="row_sc">
                    <div class="col1">
                      <div class="container_sc">
                        <form action="/action_page.php">
                        
                          <div class="row_sc">
                            <div class="colmn2">
                              <h3>Billing Address</h3>
                              <label for="fname"><i class="fa fa-user"></i> Full Name</label>
                              <input type="text" id="fname" name="firstname" placeholder="">
                              <label for="email"><i class="fa fa-envelope"></i> Email</label>
                              <input type="text" id="email" name="email" placeholder="">
                              <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
                              <input type="text" id="adr" name="address" placeholder="">
                              <label for="city"><i class="fa fa-institution"></i> City</label>
                              <input type="text" id="city" name="city" placeholder="">
                  
                              <div class="row_sc">
                                <div class="colmn2">
                                  <label for="state">State</label>
                                  <input type="text" id="state" name="state" placeholder="">
                                </div>
                                <div class="colmn2">
                                  <label for="zip">Zip</label>
                                  <input type="text" id="Postcode" name="Postcode" placeholder="">
                                </div>
                              </div>
                            </div>
                  
                            <div class="colmn">
                              <h3>Payment</h3>
                              <label for="fname">Accepted Cards</label>
                              <div class="icon-container_sc">
                                <i class="fa fa-cc-visa" style="color:navy;"></i>
                                <i class="fa fa-cc-amex" style="color:blue;"></i>
                                <i class="fa fa-cc-mastercard" style="color:red;"></i>
                                <i class="fa fa-cc-discover" style="color:orange;"></i>
                              </div>
                              <label for="cname">Name on Card</label>
                              <input type="text" id="cname" name="cardname" placeholder="">
                              <label for="ccnum">Credit card number</label>
                              <input type="text" id="ccnum" name="cardnumber" placeholder="">
                              <label for="expmonth">Exp Month</label>
                              <input type="text" id="expmonth" name="expmonth" placeholder="">
                              <div class="row_sc">
                                <div class="colmn2">
                                  <label for="expyear">Exp Year</label>
                                  <input type="text" id="expyear" name="expyear" placeholder="">
                                </div>
                                <div class="colmn2">
                                  <label for="cvv">CVV</label>
                                  <input type="text" id="cvv" name="cvv" placeholder="">
                                </div>
                              </div>
                            </div>
                            
                          </div>
                          <label>
                            <input type="checkbox" checked="checked" name="sameadr"> I accept the Privacy Policy.
                          </label>
                          <input type="submit" value="Continue to checkout" class="btn">
                        </form>
                      </div>
                    </div>
                    <h3>Order Details</h3>
                    <div class="table-responsive">
                      <table class="table table-bordered">
                        <tr>
                          <th width="40%">Item Name</th>
                          <th width="10%">Quantity</th>
                          <th width="20%">Price</th>
                          <th width="15%">Total</th>
                          <th width="5%">Action</th>
                        </tr>
                        <?php
                        if(!empty($_SESSION["shopping_cart"]))
                        {
                          $total = 0;
                          foreach($_SESSION["shopping_cart"] as $keys => $values)
                          {
                        ?>
                        <tr>
                          <td><?php echo $values["item_name"];?></td>
                          <td><?php echo $values["item_quantity"];?></td>
                          <td>$ <?php echo $values["item_price"]; ?></td>
                          <td><?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>                       
                          <td><a href="ShoppingCart.php?action=delete&id=<?php echo $values["item_id"];?>"><span class="text-danger">Remove</span></a></td>  
                        </tr>
                        <?php 
                            $total = $total + ($values["item_quantity"] * $values["item_price"]);   
                          }
                          ?>
                          <td colspan="3" align="right">Total</td>
                          <td align="right">$<?php echo number_format($total,2);?></td>


                          <?php
                        }
                        ?>
                      </table>

                    </div>
                      
                  


    </body>
</html>