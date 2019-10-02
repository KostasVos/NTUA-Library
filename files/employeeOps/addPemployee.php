<?php
require '../connect.php';
if(isset($_POST["submit"]))
{
    $first = $_POST['first'];
    $last = $_POST['last'];
    $salary = $_POST['salary'];
    $date = $_POST['date'];

    $query1 = "INSERT INTO employee (EFirst, ELast, salary) VALUES ('$first', '$last', $salary);";
    $query_run1 = mysqli_query($mysql_connection,$query1);

    if(!$query_run1){
        mysqli_close($mysql_connection);
        header("Location:http://localhost/files/employees.php");
        echo "<script type='text/javascript'>alert('Error: Could not add employee!');</script>";

    }else{

    $query2 = "SELECT empID
    FROM employee
    ORDER BY empID desc
    LIMIT 1";
    
    $query_run2 = mysqli_query($mysql_connection,$query2);
    $row = mysqli_fetch_assoc($query_run2);
    $id = $row['empID'];
    
    $query3 = "INSERT INTO permanent_employee VALUES ('$id', '$date');";
    $query_run3 = mysqli_query($mysql_connection,$query3);
    if(!$query_run3){
        mysqli_close($mysql_connection);
        header("Refresh: 3; url=http://localhost/files/employees.php");  
            echo "Error: Employee couldnt be added added!";

    }else{
        mysqli_close($mysql_connection);
        header("Refresh: 3; url=http://localhost/files/employees.php");  
            echo "Employee successfully added!";
    }
}
}
?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Add Permanent Employee - Databases Project 2019</title>
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
    Add a Temporary Employee
    </h1>
    <p> Insert new temporary employee into the database.</p>
    <form method="post" action = "addPemployee.php">		
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