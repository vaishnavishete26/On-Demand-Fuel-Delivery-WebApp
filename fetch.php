<?php
$connect = mysqli_connect("localhost", "root", "", "fuel_delivery");
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($connect, $_POST["query"]);
	$query = "
	SELECT * FROM vendor 
	WHERE fld_name LIKE '%".$search."%'
	OR fld_address LIKE '%".$search."%' 
	
	";
}
else
{
	$query = "
	SELECT * FROM vendor ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result))
{
	$output .= '';
	while($row = mysqli_fetch_array($result))
	{
		$vendor_id= $row['fldvendor_id'];
		$output .= '
			<tr style="width:300px;background:white; border:1px solid black;">
				<td style="border-bottom:solid 1px black;padding:20px;"><a href="search.php?vendor_id='.$vendor_id.'" style="text-decoration:none;font-weight:bold; color:black;padding:100px;">'.$row["fld_name"].'</a></td>
				
			</tr>';
	}
	echo $output;
}
else
{
	echo 'Data Not Found';
}
?>