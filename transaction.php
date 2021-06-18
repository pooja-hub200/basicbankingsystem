
<?php
include 'dbconfig.php';

if(isset($_POST['submit']))
{
    $from = $_GET['id'];
    $to = $_POST['to'];
    $amount = $_POST['amount'];

    $sql = "SELECT * from customer where id=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.

    $sql = "SELECT * from customer where id=$to";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);



    
    if (($amount)<0)
   {
         echo '<script>alert("Oops! Negative values cannot be transferred")</script>';
        
    }
    else if($amount > $sql1['currentbalance']) 
    {
       
        echo '<script>alert("Bad Luck! Insufficient Balance")</script>';  // showing an alert box.
        
    }
    else if($amount == 0){
         echo '<script>alert("Oops! Zero value cannot be transferred")</script>';
     }
    else {
        
                // deducting amount from sender's account
                $newbalance = $sql1['currentbalance'] - $amount;
                $sql = "UPDATE customer set currentbalance=$newbalance where id=$from";
                mysqli_query($conn,$sql);
                

                // adding amount to reciever's account
                $newbalance = $sql2['currentbalance'] + $amount;
                $sql = "UPDATE customer set currentbalance=$newbalance where id=$to";
                mysqli_query($conn,$sql);
                
                $sender = $sql1['name'];
                $receiver = $sql2['name'];
				
                $sqlfinal= "INSERT INTO transactions(sender,receiver,amount,datetime)Values('$sender','$receiver','$amount',CURRENT_TIMESTAMP)";
               
                if( mysqli_query($conn,$sqlfinal)){
                     echo '<script>alert("Transaction Successful")</script>';
					 header('refresh:0;url=transactionhistory.php');
                }
				else
				{
					echo'<script>alert("error")</script>';
				}

                $newbalance= 0;
                $amount =0;
        }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction</title>
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

	<div class="container">
        <h1><center><div class="transfer" >Transaction</div></center></h1>
            <?php
                include 'dbconfig.php';
                $id=$_GET['id'];
                $sql = "SELECT * FROM  customer where id=$id";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error : ".$sql."<br>".mysqli_error($conn);
                }
                $rows=mysqli_fetch_assoc($result);
            ?>
            <form method="post"  class="tabletext" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
                <tr>
                    <th class="text-center">Id</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Balance</th>
                </tr>
                <tr>
                    <td><center><?php echo $rows['id'] ?></center></td>
                    <td><center><?php echo $rows['name'] ?></center></td>
                    <td><center><?php echo $rows['email'] ?></center></td>
                    <td><center><?php echo $rows['currentbalance'] ?></center></td>
                </tr>
            </table>
        </div>
        <br>
        <label><strong>Transfer To:</strong></label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose</option>
            <?php
                include 'dbconfig.php';
                $sid=$_GET['id'];
                $sql = "SELECT * FROM customer where id!=$id";
                $result=mysqli_query($conn,$sql);
                if(!$result)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }
                while($rows = mysqli_fetch_assoc($result)) {
            ?>
                <option class="table" value="<?php echo $rows['id'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['currentbalance'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
        <br>
            <label><strong>Amount:</strong></label>
            <input type="number" class="form-control" name="amount" required>   
            <br><br>
                <div class="text-center" >
            <button  name="submit" type="submit" class="btn btn-success">Transfer</button>
            </div>
        </form>
    </div>
</body>
</html>
