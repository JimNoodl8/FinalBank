<?php
session_start();
include("Connection.php");
if(isset($_POST['account_delete_btn']))
{
    $pin = $_POST['transfer'];

    $query = "DELETE FROM users WHERE pin='$pin' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Account Deleted Successfully";
        header("Location: Homepage.php");
    }
    else
    {
        $_SESSION['status'] = "Account Not Deleted";
        header("Location: Closebankaccount.php");
    }
}

?>
