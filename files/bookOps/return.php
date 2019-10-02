<?php

$ISBN = $_GET['ISBN'];
$copy = $_GET['copy'];
$mem = $_GET['id'];
$date = $_GET['date'];

require "../connect.php";

    $query = "UPDATE borrows 
    SET date_of_return = '2019-05-31' 
    WHERE ((memberID='$mem') AND (copyNr = '$copy') AND (ISBN = '$ISBN') AND (date_of_borrowing = '$date'));";
    $query_run1 = mysqli_query($mysql_connection,$query);

    if(!$query_run1){
        mysqli_close($mysql_connection);
        header("Refresh: 3; url=http://localhost/files/transactions.php");  
            echo "Book couldn't be returned!";

        

    }else{
    mysqli_close($mysql_connection);

    header("Refresh: 3; url=http://localhost/files/transactions.php");  
        echo "Book successfully returned!";


    }

?>
