<?php
session_start();
error_reporting(0);
extract($_REQUEST);
include("../connection.php");
$gtotal=array();
$ar=array();
$total=0;
if(isset($_GET['product']))//product id
{
	$product_id=$_GET['product'];
}
else
{
	$product_id="";
}
 if(isset($_SESSION['cust_id']))
 {
 $cust_id=$_SESSION['cust_id'];
 $qq=mysqli_query($con,"select * from customer where fld_email='$cust_id'");
	 $qqr= mysqli_fetch_array($qq);
 }
if(empty($cust_id))
{
	header("location:index.php?msg=you must login first");
}
if(!empty($product_id && $cust_id ))
{
if(mysqli_query($con,"insert into cart (fld_product_id,fld_customer_id) values ('$product_id','$cust_id') "))
{
	echo "success";
	$product_id="";
	header("location:cart.php");
}
else
{
	echo "failed";
}
}
if(isset($del))
{
	
	//echo $del;
	if(mysqli_query($con,"delete from cart where fld_cart_id='$del' && fld_customer_id='$cust_id'"))
	{
		header("location:deletecart.php");
	}
	
}
 
 
 if(isset($logout))
 {
	 session_destroy();
	 
	 header("location:../home.php");
 }
 if(isset($login))
 {
	 session_destroy();
	 
	 header("location:index.php");
 }
 
 //update section
  $cust_details=mysqli_query($con,"select * from customer where fld_email='$cust_id'");
  $det_res=mysqli_fetch_array($cust_details);
  $fld_name=$det_res['fld_name'];
  $fld_email=$det_res['fld_email'];
  $fld_mobile=$det_res['fld_mobile'];
  $fld_password=$det_res['password'];
  $fld_address=$det_res['address'];

  if(isset($update))
  {
	   
	 if(mysqli_query($con,"update customer set fld_name='$name',fld_mobile='$mobile',password='$pswd', address='$address' where fld_email='$fld_email'"))
      {
	   header("location:customerupdate.php");
	  }
  }

    if(isset($delete))
  {
	   
	 if(mysqli_query($con,"delete from customer where fld_email='$fld_email'"))
      {
	   header("location:customerdelete.php");
	  }
  }

  if(isset($delete))
 {
	 session_destroy();
	 header("location:../home.php");
 }
  
  $query=mysqli_query($con,"select fuel.fuelname,fuel.fldvendor_id,fuel.cost,fuel.quantity,fuel.fldimage,cart.fld_cart_id,cart.fld_product_id,cart.fld_customer_id from fuel inner  join cart on fuel.fuel_id=cart.fld_product_id where cart.fld_customer_id='$cust_id'");
  $re=mysqli_num_rows($query);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cart </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <style>
		ul li{list-style:none;}
		ul li a {color:black;text-decoration:none; }
		ul li a:hover {color:black;text-decoration:none; }
		
	 </style>
	 <script>
		  function del(id)
		  {
			  if(confirm('are you sure you want to cancel order')== true)
			  {
				  window.location.href='cancelorder.php?id=' +id;
			  }
		  }
		</script>

</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="../home.php"><span style="color:green;font-family: 'Permanent Marker', cursive;">On Demand Fuel Delivery</span></a>
    <?php
	if(!empty($cust_id))
	{
	?>
	<a class="navbar-brand" style="color:black; text-decoratio:none;"><i class="far fa-user"><?php if(isset($cust_id)) { echo $qqr['fld_name']; }?></i></a>
	<?php
	}
	?>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
	
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="../home.php">Home
                
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../aboutus.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../contact.php">Contact</a>
        </li>
		<li class="nav-item">
		  <form method="post">
          <?php
			if(empty($cust_id))
			{
			?>
			<span style="color:black; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:red;" id="cart"  class="badge badge-light">4</span></i></span>
			
			&nbsp;&nbsp;&nbsp;
			<button class="btn btn-outline-danger my-2 my-sm-0" name="login">Log In</button>&nbsp;&nbsp;&nbsp;
            <?php
			}
			else
			{
			?>
			<a href="cart.php"><span style="color:green; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:green;" id="cart"  class="badge badge-light"><?php if(isset($re)) echo $re; ?></span></i></span></a>
			<button class="btn btn-outline-success my-2 my-sm-0" name="logout" type="submit">Log Out</button>&nbsp;&nbsp;&nbsp;
			<?php
			}
			?>
			</form>
        </li>
		
		
      </ul>
	  
    </div>
	
</nav>

<!--navbar ends-->


<br><br>
<div class="middle" style="  padding:60px; border:1px solid #ED2553;  width:100%;">
       <!--tab heading-->
	   <ul class="nav nav-tabs nabbar_inverse" id="myTab" style="background:#ED2553;border-radius:10px 10px 10px 10px;" role="tablist">
          <li class="nav-item">
             <a class="nav-link active" style="color:#BDDEFD;" id="viewitem-tab" data-toggle="tab" href="#viewitem" role="tab" aria-controls="viewitem" aria-selected="true">View Cart</a>
          </li>
          <li class="nav-item">
              <a class="nav-link" style="color:#BDDEFD;" id="manageaccount-tab" data-toggle="tab" href="#manageaccount" role="tab" aria-controls="manageaccount" aria-selected="false">Account Settings</a>
          </li>
		  <li class="nav-item">
              <a class="nav-link" style="color:#BDDEFD;" id="orders-tab" data-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false">Orders</a>
          </li>

		  
       </ul>
	   <br><br>
	<!--tab 1 starts-->   
	   <div class="tab-content" id="myTabContent">
	   
            <div class="tab-pane fade show active" id="viewitem" role="tabpanel" aria-labelledby="home-tab">
                 <table class="table">
                  <tbody>
	               <?php
	                  $query=mysqli_query($con,"select fuel.fuelname,fuel.fldvendor_id,fuel.cost,fuel.quantity,fuel.fldimage,cart.fld_cart_id,cart.fld_product_id,cart.fld_customer_id from fuel inner  join cart on fuel.fuel_id=cart.fld_product_id where cart.fld_customer_id='$cust_id'");
	                  $re=mysqli_num_rows($query);
	                   if($re)
	                    {
		                 while($res=mysqli_fetch_array($query))
		                  {
			                $vendor_id=$res['fldvendor_id'];
			               $v_query=mysqli_query($con,"select * from vendor where fldvendor_id='$vendor_id'");
			               $v_row=mysqli_fetch_array($v_query);
			               $em=$v_row['fld_email'];
			               $nm=$v_row['fld_name'];
	                ?>
                      <tr>
                         <td><image src="../image/pump/<?php echo $em."/foodimages/".$res['fldimage'];?>" height="80px" width="100px"></td>
                         <td><?php echo $res['fuelname'];?></td>
                         <td><?php echo "RS ".$res['cost'];?></td>
                         <td><?php echo $res['quantity'];?></td>
                         <td><?php echo $nm; ?></td>
		                <form method="post" enctype="multipart/form-data">
                           <td><button type="submit" name="del"  value="<?php echo $res['fld_cart_id']?>" class="btn btn-danger">Delete</button></td>
                        </form>
                        <td><?php $total=$total+$res['cost']; $gtotal[]=$total;  ?></td>
                      </tr>
					  
					  
                   <?php
	                    }
						?>
						<tr>
					  <td>
					  <h5 style="color:red;">Grand total</h5>
					  </td>
					  <td>
					  <h5><i class="fas fa-rupee-sign"></i>&nbsp;<?php echo end($gtotal); ?></h5>
					  </td>
					  <td>
					  
					  </td>
					  <td></td>
					  
					  <td style="padding:30px; text-align:center;">
					  <a href="order.php?cust_id=<?php echo $cust_id; ?>"><button type="button" style=" color:white; font-weight:bold; text-transform:uppercase;" class="btn btn-warning">Proceed to checkout</button></a>
					  </td>
					  <td></td>
					  </tr>
						
						<?php
	
	                  }
					  else
					  {
						  
	
	                 ?>
					 <tr><button type="button" class="btn btn-outline-success"><a href="../home.php" style="color:green; text-decoration:none;">No Items In cart Let's Shop Now</a></button></tr>
					 
					 <?php
					  }
					 ?>
                 </tbody>
	      </table>	
		  
		  <span style="color:green; text-align:centre;"><?php if(isset($success)) { echo $success; }?></span>
		       
			   
		 
		
         </div>	 
	  
<!--tab 1 ends-->	   
			
			
			<!--tab 2 starts-->
            <div class="tab-pane fade" id="manageaccount" role="tabpanel" aria-labelledby="manageaccount-tab">
			    <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" id="name" value="<?php if(isset($fld_name)){ echo $fld_name;}?>" class="form-control" name="name" required="required"/>
                    </div>
					
					<div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" id="email" name="email" value="<?php if(isset($fld_email)){ echo $fld_email;}?>" class="form-control"  readonly/>
                    </div>
					<div class="form-group">
                      <label for="mobile">Mobile</label>
                      <input type="tel" id="mobile" class="form-control" name="mobile" pattern="[6-9]{1}[0-9]{2}[0-9]{3}[0-9]{4}" value="<?php if(isset($fld_mobile)){ echo $fld_mobile;}?>" placeholder="" required>
                    </div>
					
                   <div class="form-group">
                      <label for="pwd">Password:</label>
                     <input type="password" name="pswd" value="<?php if(isset($fld_password)) {echo $fld_password;}?>"class="form-control"  id="pwd" required/>
                   </div>
                   <div class="form-group">
                      <label for="add">Address:</label>
                     <input type="address" name="address" value="<?php if(isset($fld_address)){echo $fld_address; }?>"class="form-control"id="add" required/>
                   </div>				   
				   
 
                  <button type="submit" name="update" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Update</button>
                  <button type="submit" name="delete" style="background:#ED2553; border:1px solid #ED2553;" class="btn btn-primary">Delete My Account</button>

                  <div class="footer" style="color:red;"><?php if(isset($ermsg)) { echo $ermsg; }?><?php if(isset($ermsg2)) { echo $ermsg2; }?></div>
			 </form>
			</div>
			<!--tab 2 ends-->
			 <!--tab 3 starts-->
            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
			    <table class="table">
				<th>Order Number</th>
				<th>Item Name</th>
				<th>Price</th>
				<th>Cancel order</th>
				    <tbody>
					<?php
					$quer_res=mysqli_query($con,"select * from myorder where fld_email_id='$cust_id' and fldstatus='In Process'");
					while($roww=mysqli_fetch_array($quer_res))
					{   
				         $fid=$roww['fld_fuel_id'];
				         $qr=mysqli_query($con,"select * from fuel where fuel_id='$fid'");
						 $qrr=mysqli_fetch_array($qr);
						
					  
					?>
					   <tr>
					   <td><?php echo $roww['fld_order_id']; ?></td>
					   <?php
					   if(empty($qrr['fuelname']))
					   {
					   ?>
					   <td><span style="color:red;">Product Not Available Now</span></td>
					   <?php
					   }
					   else
					   {
						   ?>
						    <td><?php echo $qrr['fuelname']; ?></td>
						   <?php
					   }

					  ?>
					  
					   <td><?php echo $qrr['cost']; ?></td>
					   <td><a href="#" onclick="del(<?php echo $roww['fld_order_id'];?>);"><button type="button" class="btn btn-danger">Cancel Order</button></a></td>
					   </tr>
					 <?php
					}

					  ?>  
					   <!-- new code here 
					  <?php 
					  		// $quer_res=mysqli_query($con,"select * from order where fld_email_id='$cust_id' && fldstatus='Delivered'");
					   		//while($roww=mysqli_fetch_array($quer_res))
							{   
				         	//	$fid=$roww['fld_fuel_id'];
				         	//	$qr=mysqli_query($con,"select * from fuel where fuel_id='$fid'");
						 	//	$qrr=mysqli_fetch_array($qr);
						
					  
						?>
					   <tr>
					   //<td><?php echo $roww['fld_order_id']; ?></td>
					   <?php
					   		//if(empty($qrr['fuelname']))
					   		{
					   ?>
					   			<td><span style="color:red;">Product Not Available Now</span></td>
					   <?php
					   }
					  // else
					   {
						   ?>
						   // <td><?php //echo $qrr['fuelname']; ?></td>
						   <?php
					   }
					  } ?>
					  <td><?php //echo $qrr['cost']; ?></td>
					   <td><button type="button" c>Delivered</button></td>
					   </tr>
					 <?php
				

					  ?>  

					    new code ends here -->

					</tbody>
				</table>
			</div>
			<!--tab 3 ends-->

			<!-- table of delievered orders here -->
			
			    <table class="table">
				<th>Order Number</th>
				<th>Item Name</th>
				<th>Status</th>
				    <tbody>
					<?php
					$quer_res=mysqli_query($con,"select * from myorder where fld_email_id='$cust_id' && fldstatus='Delivered'");
					while($roww=mysqli_fetch_array($quer_res))
					{   
				         $fid=$roww['fld_fuel_id'];
				         $qr=mysqli_query($con,"select * from fuel where fuel_id='$fid'");
						 $qrr=mysqli_fetch_array($qr);
						
					  
					?>
					   <tr>
					   <td><?php echo $roww['fld_order_id']; ?></td>
					   <?php
					   if(empty($qrr['fuelname']))
					   {
					   ?>
					   <td><span style="color:red;">Product Not Available Now</span></td>
					   <?php
					   }
					   else
					   {
						   ?>
						    <td><?php echo $qrr['fuelname']; ?></td>
						   <?php
					   }

					  ?>
					  
					   <td><?php echo "delivered"; ?></td>
					   
					   </tr>
					 <?php
					}

					  ?>  
					  <!-- out of stock code here -->
					  <?php
					$quer_res=mysqli_query($con,"select * from myorder where fld_email_id='$cust_id' && fldstatus='Out Of Stock'");
					while($roww=mysqli_fetch_array($quer_res))
					{   
				         $fid=$roww['fld_fuel_id'];
				         $qr=mysqli_query($con,"select * from fuel where fuel_id='$fid'");
						 $qrr=mysqli_fetch_array($qr);
						
					  
					?>
					   <tr>
					   <td><?php echo $roww['fld_order_id']; ?></td>
					   <?php
					   if(empty($qrr['fuelname']))
					   {
					   ?>
					   <td><span style="color:red;">Product Not Available Now</span></td>
					   <?php
					   }
					   else
					   {
						   ?>
						    <td><?php echo $qrr['fuelname']; ?></td>
						   <?php
					   }

					  ?>
					  
					   <td><?php echo "out of stock"; ?></td>
					   
					   </tr>
					 <?php
					}

					  ?>  
					  <!-- out of stock code here ends -->
			</tbody>
				</table>		

			<!-- table of delievered orders ends here -->
	  </div>
	</div>  
	  
<?php
include("footer.php");
?>   
</body>
</html>