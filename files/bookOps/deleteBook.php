<?php
require '../connect.php';
 
    $id = $_GET['id'];

    $result2 = mysqli_query($mysql_connection, "DELETE FROM book WHERE ISBN=$id");
    if($result2){
        header("Refresh: 3; url=http://localhost/files/books.php");  
        echo "Book successfully deleted!";
    }else{
        
        header("Refresh: 3; url=http://localhost/files/books.php");  
        echo "Book couldnt be deleted!";
    }
?>