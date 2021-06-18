<?php 
require "dbconfig.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer Money</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	<style>
	.transfer{
		color:white; 
		margin-top:5px; 
		background-color:purple;
		font-family: 'Adamina';font-size: 40px;
	}
	</style>
</head>
<body>
<?php
    include 'dbconfig.php';
    $sql = "SELECT * FROM customer";
    $result = mysqli_query($conn,$sql);
?>
<div class="container">
	<form action="" class="tabletext">
		<h1><center><div class="transfer" >Transfer Money</div></center></h1>
			<table  class="table table-striped table-condensed table-bordered" style="margin-top:50px;">
                        <thead>
                            <tr>
                            <th><center>Id</center></th>
                            <th><center>Name</center></th>
                            <th><center>E-Mail</center></th>
                            <th><center>Balance</center></th>
                            <th><center>Operation</center></th>
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
                        <td><center><a href="transaction.php?id= <?php echo $rows['id'] ;?>"> <button type="button" class="btn btn-success">Transfer</button></a></center></td>
                    </tr>
					
                <?php
                    }
                ?>
				</tbody>
			</table>   
	</form>    
</div>
</body>
</html>
