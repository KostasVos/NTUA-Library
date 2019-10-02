<?php
require '../connect.php';
 
$id = $_GET['id'];

    $result2 = mysqli_query($mysql_connection, "DELETE FROM employee WHERE empID=$id");
 
if($result2){
    header("Refresh: 3; url=http://localhost/files/employees.php");  
    echo "Employee successfully deleted!";
}else{
    
    header("Refresh: 3; url=http://localhost/files/employees.php");  
    echo "Employee couldnt be deleted deleted!";
}

mysqli_close($mysql_connection);
?>