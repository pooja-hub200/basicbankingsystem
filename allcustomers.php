<?php 
include "dbconfig.php";
?>

<html>
<head>
<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>ALL CUSTOMERS</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<style>
	.transfer{
	 color:white; 
	 margin-top:5px; 
	 background-color:purple;
	 font-family: 'Adamina';font-size: 40px; 
	}
 	.floated {
		float:right;
		margin-right:5px;
	}
	.m{
	margin-top: 10px;
	}
 
	</style>
</head>
<body>
<div class="container">
	<div class="m">
		<a href="moneytransfer.php"><button type="button" style="background-color: purple color: white;margin-top:6px;padding: 5px 12px;text-align: center;font-size: 16px;" class="floated" id="slide_stop_button">
		<strong>Transfer Money</strong></button></a>
		<a href="home.php"><button type="button" style=" background-color:purple /* Green */color: white;margin-top:6px;padding: 5px 12px;text-align: center;font-size: 16px;" class="floated" id="slide_start_button">
		<strong>Home</strong></button></a>
	</div>
	<h1><center><div class="transfer">Customer Details</div></center></h1>
</div>
<?php 
require "dbconfig.php";
$sql="select * from customer";
$result=mysqli_query($conn,$sql);
?>
<div class="container">
	<form action="" class="tabletext">
		<table  class="table table-striped table-condensed table-bordered" style="margin-top:50px;">
                        <thead>
                            <tr>
                            <th><center>Id</center></th>
                            <th><center>Name</center></th>
                            <th><center>E-Mail</center></th>
                            <th><center>Balance</center></th>
                            </tr>
                        </thead>
                        <tbody>
								<?php
									while($rows=mysqli_fetch_assoc($result)){
								?>
							<tr>
								<td><center><?php echo $rows['id'] ?></center></td>
								<td><center><?php echo $rows['name']?></center></td>
								<td><center><?php echo $rows['email']?></center></td>
								<td><center><?php echo $rows['currentbalance']?></center></td>
                           </tr>
                             <?php }?>	
						</tbody>
        </table>   
    </form>
</div>
</body>
</html>
