<?php
require '../connect.php';
 
$id = $_GET['id'];

    $result2 = mysqli_query($mysql_connection, "DELETE FROM member WHERE memberID=$id");
 
mysqli_close($mysql_connection); 
if($result2){
    header("Refresh: 3; url=http://localhost/files/members.php");  
    echo "Member successfully deleted!";
}else{
    
    header("Refresh: 3; url=http://localhost/files/members.php");  
    echo "Member couldnt be deleted deleted!";
}
?>