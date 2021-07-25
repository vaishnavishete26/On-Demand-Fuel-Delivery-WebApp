<?php
session_start();
error_reporting(0);
include("connection.php");
extract($_REQUEST);
$arr=array();

if(isset($_SESSION['cust_id']))
{
	 $cust_id=$_SESSION['cust_id'];
	 $qq=mysqli_query($con,"select * from customer where fld_email='$cust_id'");
	 $qqr= mysqli_fetch_array($qq);
}
else
{
	$cust_id="";
}
 





$query=mysqli_query($con,"select  vendor.fld_name,vendor.fldvendor_id,vendor.fld_email,
vendor.fld_mob,vendor.fld_address,vendor.fld_logo,fuel.fuel_id,fuel.fuelname,fuel.cost,
fuel.quantity,fuel.paymentmode 
from vendor inner join fuel on vendor.fldvendor_id=fuel.fldvendor_id;");
while($row=mysqli_fetch_array($query))
{
	$arr[]=$row['fuel_id'];
	shuffle($arr);
}

//print_r($arr);

 if(isset($addtocart))
 {
	 
	if(!empty($_SESSION['cust_id']))
	{
		 $_SESSION['cust_id']=$cust_id;
		header("location:form/cart.php?product=$addtocart");
	}
	else
	{
		header("location:form/?product=$addtocart");
	}
 }
 
 if(isset($login))
 {
	 header("location:form/index.php");
 }
 if(isset($logout))
 {
	 session_destroy();
	 header("location:home.php");
 }
 $query=mysqli_query($con,"select fuel.fuelname,fuel.fldvendor_id,fuel.cost,fuel.quantity,fuel.fldimage,cart.fld_cart_id,cart.fld_product_id,cart.fld_customer_id from fuel inner  join cart on fuel.fuel_id=cart.fld_product_id where cart.fld_customer_id='$cust_id'");
  $re=mysqli_num_rows($query);
?>
<html>
  <head>
     <title>Home</title>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
     <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	 <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	 <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Permanent+Marker" rel="stylesheet">
     
	 <style>
	 .carousel-item {
  height: 100vh;
  min-height: 350px;
  background: no-repeat center center scroll;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
	 }
  body{
     background-image:url("img/background.jpg");
	 background-repeat: no-repeat;
	 background-attachment: fixed;
	  background-position: center;
  
}

	 </style>
	 
	 
	 <script>
	 //search product function
            $(document).ready(function(){
	
	             $("#search_text").keypress(function()
	                      {
	                       load_data();
	                       function load_data(query)
	                           {
		                        $.ajax({
			                    url:"fetch.php",
			                    method:"post",
			                    data:{query:query},
			                    success:function(data)
			                                 {
				                               $('#result').html(data);
			                                  }
		                                });
	                             }
	
	                           $('#search_text').keyup(function(){
		                       var search = $(this).val();
		                           if(search != '')
		                               {
			                             load_data(search);
		                                }
		                            else
		                             {
			                         load_data();			
		                              }
	                                });
	                              });
	                            });
</script>
<style>
ul li {list-style:none;}
 ul li a{color:black;text-decoration:none;}
 ul li a:hover{color:black;text-decoration:none;}
</style>
  </head>
  
    
	<body>
	<!--navbar start-->

<div id="result" style="position:fixed;top:100; right:50;z-index: 3000;width:350px;background:white;"></div>
<!--navbar ends-->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  
    <a class="navbar-brand" href="home.php"><span style="color:green;font-family: 'Permanent Marker', cursive;">On Demand Fuel Delivery</span></a>
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
          <a class="nav-link" href="home.php">Home
                
              </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="aboutus.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="services.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
		<li class="nav-item">
		  <form method="post">
          <?php
			if(empty($cust_id))
			{
			?>
			<a href="form/index.php?msg=you must be login first"><span style="color:red; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:red;" id="cart"  class="badge badge-light">0</span></i></span></a>
			
			&nbsp;&nbsp;&nbsp;
			<button class="btn btn-outline-danger my-2 my-sm-0" name="login" type="submit">Log In</button>&nbsp;&nbsp;&nbsp;
            <?php
			}
			else
			{
			?>
			<a href="form/cart.php"><span style=" color:green; font-size:30px;"><i class="fa fa-shopping-cart" aria-hidden="true"><span style="color:green;" id="cart"  class="badge badge-light"><?php if(isset($re)) { echo $re; }?></span></i></span></a>
			<button class="btn btn-outline-success my-2 my-sm-0" name="logout" type="submit">Log Out</button>&nbsp;&nbsp;&nbsp;
			<?php
			}
			?>
			</form>
        </li>
		<li class="nav-item">
		
		  
		</li>
      </ul>
	  
    </div>
	
</nav>
<!--navbar ends-->
<br><br>
<!--<div class="container-fluid">
   <img src="img/about.bmp" width='100%'/>
</div> -->
<br><br>
<div class="container-fluid" style="background:black; opacity:0.30;">
<!--<h1 style="color:white; text-align:center; text-transform:uppercase;">we do this by</h1>
<h3 style="color:white; text-align:center; text-transform:uppercase;">Helping people discover great places around them.</h3>
<p style="color:white; text-align:center; font-size:25px;">Our team gathers information from every restaurant on a regular basis to ensure our data is fresh. Our vast community of food lovers share their reviews and photos, so you have all that you need to make an informed choice.</p>

<h3 style="color:white; text-align:center; text-transform:uppercase;">Building amazing experiences around dining.</h3>
<p style="color:white; text-align:center; font-size:25px;">Starting with information for over 1 million restaurants (and counting) globally, we're making dining smoother and more enjoyable with services like online ordering and table reservations.</p>

<h3 style="color:white; text-align:center; text-transform:uppercase;">Enabling restaurants to create amazing experiences.</h3>
<p style="color:white; text-align:center; font-size:25px;">With dedicated engagement and management tools, we're enabling restaurants to spend more time focusing on food itself, which translates directly to better dining experiences.</p>-->

<p style="color:white; text-align:center; font-size:25px;"> We at On Demand Fuel Delivery, are working on the following problems we face in our day to day activities. <br> 

Wastage of fuel <br>
Increased CO2 emission <br>
Wastage of time / money <br>
We can overcome these problems by reducing wastage in unwanted movement of vehicles such as-in travel “from” and “to” the fuel station, unplanned journey for fueling the vehicles, reduce traffic JAM due to congestion of vehicles at road side fuel stations and hoardings at fuel stations etc. </p>

<h2>DIESEL AT DOORSTEP </h2>
 
<p style="color:white; text-align:center; font-size:25px;"> 
We believe that intense dedication is needed to do anything significant in this world. At On Demand Fuel Delivery, we have dedicated our lives to a purpose that is larger than us. We are delivering diesel at the doorstep to all those who find it difficult to procure diesel from the retail outlet (Petrol pump). The conventional procurement process leads to wastage of diesel just to procure diesel leading to environmental damage due to pollution and spillages. Not to forget the time, the manpower and money that the Nation wastes on this way of procurement. </p>

</div> 

<br><br>
<div class="container-fluid" style="background:white; text-transform:uppercase;padding:20px; border-left:10px solid black;"><h3>locate us</h3></div>
<div class="container-fluid">
<div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="304" id="gmap_canvas" src="https://maps.google.com/maps?q=hotel%20limontree&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://www.emojilib.com">emojilib.com</a></div><style>.mapouter{position:relative;text-align:right;height:304px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:304px;width:100%;}</style></div>
</div>
<br><br>
 <?php
			include("footer.php");
			?>








	</body>
</html>