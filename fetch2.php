<?php
$connect = mysqli_connect("localhost", "root", "", "fuel_delivery");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = " 	SELECT * FROM fuel WHERE fuelname LIKE '%".$search."%' OR quantity LIKE '%".$search."%' ";
}
else
{
	$query = " SELECT * FROM fuel ";
}
$result = mysqli_query($connect, $query);
if(!$result||mysqli_num_rows($result) > 0)
{
	$output .= '';
	while($row = mysqli_fetch_array($result))
	{
		$fuel_id= $row['fuel_id'];
		$output .= '
			<tr style="width:100%;background:white; border:1px solid black;">
				<td style="border-bottom:solid 1px black;padding:10px;"><a href="searchfuel.php?fuel_id='.$fuel_id.'" style="text-decoration:none;font-weight:bold; color:black;padding:100px;">'.$row["fuelname"].'</a></td>
			</tr>';
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>