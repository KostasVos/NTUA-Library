<?php

$memberID = $_GET['id'];
?>
<?php
require '../connect.php';

if(isset($_POST["submit"]))
{
    $first = $_POST['first'];
    $last = $_POST['last'];
    $street = $_POST['street'];
    $num = $_POST['num'];
    $postal = $_POST['postal'];
    $date = $_POST['date'];

    $query = "UPDATE member SET MFirst = '$first', MLast = '$last', Street = '$street', Number = '$num', postalCode = '$postal', Mbirthdate = '$date' WHERE memberID='$memberID';";
    $query_run1 = mysqli_query($mysql_connection,$query);

    if(!$query_run1){
        mysqli_close($mysql_connection);
        header("Refresh: 3; url=http://localhost/files/members.php");  
        echo "Error: Member couldnt be edited !";
        

    }else{
    mysqli_close($mysql_connection);

    header("Refresh: 3; url=http://localhost/files/members.php");  
    echo "Member edited successfully";

    }
}


?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Member - Databases Project 2019</title>
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
    <p> Edit existing member.</p>
    <?php
    echo '<form method="post" action = "editMember.php?id='.$memberID.'">';		
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
            <label for="street">Street:</label> <br>
            <input type="text"  id="street" name = "street" value="" maxlength= "45" required>
        </div>

        <div class="width_container">
            <label for="num">Street number:</label> <br>
            <input type="text"  id="num" name = "num" value="" required>
        </div>

        <div class="width_container">
            <label for="postal">Postal Code:</label> <br>
            <input type="text"  id="postal" name = "postal" value="" required>
        </div>

        <div class="width_container">
            <label for="date">Date of Birth:</label> <br>
            <input type="date"  id="date" name = "date" value="" required >
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