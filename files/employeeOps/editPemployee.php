<?php

$empID = $_GET['id'];
?>

<?php
require '../connect.php';

if(isset($_POST["submit"]))
{
    $first = $_POST['first'];
    $last = $_POST['last'];
    $salary = $_POST['salary'];
    $date = $_POST['date'];

    $query1 = "UPDATE employee SET EFirst = '$first', ELast = '$last', salary = '$salary' WHERE empID='$empID';";
    $query_run1 = mysqli_query($mysql_connection,$query1);
    $query2 = "UPDATE permanent_employee SET hiringDate='$date' WHERE empID='$empID';";
    $query_run2 = mysqli_query($mysql_connection,$query2);

    if(!$query_run1){
        mysqli_close($mysql_connection);if($result2)
    header("Refresh: 3; url=http://localhost/files/employees.php");  
    echo "Error: Employee couldnt be edited !";


    }else{
        mysqli_close($mysql_connection);
        header("Refresh: 3; url=http://localhost/files/employees.php");  
        echo "Employee successfully edited !";
    }
}

?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Employee - Databases Project 2019</title>
    <link rel="stylesheet" type="text/css" href="../main.css">

</head>

<body>
<header class="header_bar">
    <div class="width_container">
        <img src="../logo.png" height="100" width=100 float:left>
        <nav>
            <ul>
                
                <li><a href="../../index.php">Home</a> </li>
                <li><a href="../books.php">Books</a> </li>
                <li><a href="../members.php">Members</a> </li>
                <li><a href="../employees.php">Employees</a> </li>
                <li><a href="../transactions.php">Transactions</a></li>
                <li><a href="../stats.php">Statistics</a> </li>
                <li><a href="../view1.php"> View1 </a></li>
                <li><a href="../view2.php"> View2 </a></li>
            
            </ul>
        </nav>
    </div>
    

</header>
<div class="width_container">
    <section>
    <h1>
    Edit Book
    </h1>
    <p> Edit existing Book.</p>
    <?php
    echo '<form method="post" action = "editPemployee.php?id='.$empID.'">';		
    ?>	
         <div class="width_container">
            <label for="first">First Name:</label> <br>
            <input type="text"  id="first" name = "first" value="" maxlength= "45" required>
        </div>

        <div class="width_container">
            <label for="last">Last Name:</label> <br>
            <input type="text"  id="last" name = "last" value="" maxlength= "45" required>
        </div>

        <div class="width_container">
            <label for="salary">Salary:</label> <br>
            <input type="number"  id="salary" name = "salary" value="" required>
        </div>

        <div class="width_container">
            <label for="date">Hiring Date:</label> <br>
            <input type="date"  id="date" name = "date" value="" required>
        </div>

          <div class="width_container">	
              <button type="submit" name="submit" class="smalladdButton" >Add</button>
        </div>
      </form>
    </section>
</div>
<footer>
    Databases Project 2018-2019    |     Vosinas Konstantinos AM : 03116435    |    Andriopoulos Konstantinos AM : 03116023      

</footer>

</body>

</html>