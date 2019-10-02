<?php

require '../connect.php';

$query1 = "SELECT DISTINCT M.memberID, M.Mfirst, M.Mlast
           FROM borrows AS B, member AS M
           WHERE B.memberID = M.memberID AND B.date_of_return IS NULL";
$members = mysqli_query($mysql_connection,$query1);

$query2 = "SELECT * FROM employee";
$employees = mysqli_query($mysql_connection,$query2);
?>
<?php

require '../connect.php';

if(isset($_POST["submit"]))
{
    $mem = $_POST['memberID'];
    $emp = $_POST['empID'];
    $query1 = "SELECT BO.ISBN, BO.copyNr, BO.date_of_borrowing FROM borrows AS BO WHERE BO.memberID = '$mem' AND BO.date_of_return IS NULL";
    $query_run1 = mysqli_query($mysql_connection,$query1);
    if($query_run1){
    while($row = mysqli_fetch_array($query_run1)) {
        $ISBN=$row['ISBN'];
        $copy = $row['copyNr'];
        $date1 = $row['date_of_borrowing'];
        
        $query2 = "INSERT INTO reminder VALUES('$emp','$mem','$ISBN', '$copy','$date1',CURDATE())";
        $query_run2 = mysqli_query($mysql_connection,$query2);
    }
}
    if(!$query_run2){
        mysqli_close($mysql_connection);
        header("Refresh: 3; url=http://localhost/files/transactions.php");  
        echo "Could not send reminder!";

    }else{
    mysqli_close($mysql_connection);
    header("Refresh: 3; url=http://localhost/files/transactions.php");  
    echo "Reminders successfully sent";
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Send Reminder - Databases Project 2019</title>
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
    Borrow a Book
    </h1>
    <p> Select the member to borrow the book.</p>
    <?php
    echo '<form method="post" action = "reminder.php">';		
    ?>
        <div class="width_container">
            <label for="memberID">Member:</label> <br>
            <select name="memberID">
            <?php
                while($row = mysqli_fetch_array($members)) {
                    echo '<option value='.$row['memberID'].'>'.$row['Mlast'].' '.$row['Mfirst'].', memberID ='.$row['memberID'].'</option>';
                }
                ?> 
            </select>
        </div>
        <div class="width_container">
            <label for="empID">Employee:</label> <br>
            <select name="empID">
            <?php
                while($row = mysqli_fetch_array($employees)) {
                    echo '<option value='.$row['empID'].'>'.$row['ELast'].' '.$row['EFirst'].', empID ='.$row['empID'].'</option>';
                }
                ?> 
            </select>
        </div>

          <div class="width_container">	
              <button type="submit" name="submit" class="smalladdButton" >Send</button>
        </div>
      </form>
    </section>
</div>
<footer>
    Databases Project 2018-2019    |     Vosinas Konstantinos AM : 03116435    |    Andriopoulos Konstantinos AM : 03116023      

</footer>

</body>

</html>