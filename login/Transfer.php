<?php
session_start();

	include("Connection.php");
	include("Functions.php");

  if(isset($_POST ['done'])){
  $toNumber = $_POST['toaccount'];
  $fromNumber = $_POST['fromaccount'];
  $amount = $_POST['transfer'];

  $fromBalance = "SELECT checkingbalance FROM users WHERE checkingroute = '$fromNumber'";
  $query_run = mysqli_query($con, $fromBalance);
	$fromchecking = mysqli_fetch_array($query_run);
	$from = $fromchecking['checkingbalance'];

  $toBalance = "SELECT checkingbalance FROM users WHERE checkingroute = '$toNumber'";
  $query_run1 = mysqli_query($con, $toBalance);
	$tochecking = mysqli_fetch_array($query_run1);
	$to = $tochecking['checkingbalance'];

	$result1 = $from - $amount;
  $fromUpdate = "UPDATE users SET checkingbalance = '$result1' WHERE checkingroute = '$fromNumber'";
  $query_run2 = mysqli_query($con, $fromUpdate);

  $result2 = $to + $amount;
  $toUpdate = "UPDATE users SET checkingbalance = '$result2' WHERE checkingroute = '$toNumber'";
  $query_run3 = mysqli_query($con, $toUpdate);

	if($query_run2 & $query_run3){
    echo '<script>alert("Success")</script>';
  }
  else{
    echo '<script>alert("Failed")</script>';
		header ("Location: Transfer.php");
  }
}


?>

<html>

    <head>
        <title>Transfer</title>
        <link rel="stylesheet" href="style.css">
    </head>

    <body>

        <img id="background" src="Images/Background.png" alt="Background" class="background" width="1850" height="1040.625">
        <img id="logomid" src="Images/Logo.png" alt="Icon" class="icon" width="326" height="179">
        <div id="rectanglemid" class="round"></div>
        <a href="Homepage.php"><img id="headericon" src="Images/Logo.png" alt="Icon" class="icon" width="127.486" height="70"></a>
		<div id="header" class=""></div>

        <div>
            <form id="register" method = "POST" action = "Transfer.php" >
                <input type="text" id="transfer" name="transfer" placeholder="Transfer Amount: $ ">
                <input type="text" id="fromAccount" name="fromaccount" placeholder="Routing Number: #from ">
                <input type="text" id="toAccount" name="toaccount" placeholder="Routing Number: #to ">
                <input type="submit" name = "done" id="donemid" value="Done">
            </form>
        </div>

        <div>
            <form id="register" action="Statuspage.php">
                <input type="submit" id="backmid" value="Back">
            </form>
        </div>

    </body>

</html>
