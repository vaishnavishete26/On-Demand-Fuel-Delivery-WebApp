<?php
include("../connection.php");
echo $cust_id=$_GET['cust_id'];

$query=mysqli_query($con,"select fuel.fuel_id,fuel.fuelname,fuel.fldvendor_id,fuel.cost,fuel.quantity,fuel.fldimage,cart.fld_cart_id,cart.fld_product_id,cart.fld_customer_id from fuel inner  join cart on fuel.fuel_id=cart.fld_product_id where cart.fld_customer_id='$cust_id'");
$re=mysqli_num_rows($query);
while($row=mysqli_fetch_array($query))
{
	echo "<br>";
	echo "cart id is".$cart_id=$row['fld_cart_id'];
	echo "vendor id is".$ven_id=$row['fldvendor_id'];
	echo "fuel_id is".$fuel_id=$row['fuel_id'];
	echo "cost is".$cost=$row['cost'];
	//$em_id=$row['fld_email'];
	echo 'payment status is'.$paid="In Process";
	
	if(mysqli_query($con,"insert into myorder
	(fld_cart_id,fldvendor_id,fld_fuel_id,fld_email_id,fld_payment,fldstatus) values
	('$cart_id','$ven_id','$fuel_id','$cust_id','$cost','$paid')"))
	{
		if(mysqli_query($con,"delete from cart where fld_cart_id='$cart_id'"))
		{
			header("location:customerupdate.php");
		}
	}
	else
	{
		echo "failed";
	}
	//$row['fuel_id']."<br>";
}
?>