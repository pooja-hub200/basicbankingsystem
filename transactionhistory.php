<?phpinclude "dbconfig.php" 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
	.font{
	 font-family: 'Adamina';font-size: 22px;
	 color:white;
	 background-color:purple;
	}
	.m{
		margin-top: 10px;
	}
	.floated {
		float:right;
		margin-right:10px;
	}
	</style>
</head>
<body>
<div class="m">
<a href="home.php"><button type="button" style=" background-color:purple color: white;margin-top:6px;padding: 5px 12px;text-align: center;font-size: 16px;" class="floated" id="slide_start_button">
<strong>Home</strong></button></a></div>
<div class="font">
	<h1><center>Transaction History</center></h1>
</div>
       <br>
       
   <table  class="table table-striped table-condensed table-bordered" style="margin-top:50px;">
        <thead>
            <tr>
                <th class="text-center">S.No.</th>
                <th class="text-center">Sender</th>
                <th class="text-center">Receiver</th>
                <th class="text-center">Amount</th>
                <th class="text-center">Date & Time</th>
            </tr>
        </thead>
        <tbody>
        <?php
            include 'dbconfig.php';
            $sql ="select * from transactions";
            $query =mysqli_query($conn, $sql);
            while($rows = mysqli_fetch_assoc($query))
            {
        ?>

            <tr>
            <td class="text-center"><?php echo $rows['slno']; ?></td>
            <td class="text-center"><?php echo $rows['sender']; ?></td>
            <td class="text-center"><?php echo $rows['receiver']; ?></td>
            <td class="text-center"><?php echo $rows['amount']; ?> </td>
            <td class="text-center"><?php echo $rows['datetime']; ?> </td>

        <?php
            }

        ?>
        </tbody>
    </table>
</div>
</body>
</html>
