<?php

require '../connect.php';

$query1 = "SELECT * FROM member";
$members = mysqli_query($mysql_connection,$query1);

?>
<?php
    $ISBN = $_GET['ISBN'];
    $copy = $_GET['copy'];
?>
<?php

require '../connect.php';

if(isset($_POST["submit"]))
{
    $mem = $_POST['memberID'];
    $query2 = "INSERT INTO borrows VALUES ('$mem', '$ISBN' , '$copy', CURDATE() , null);";
    $query_run2 = mysqli_query($mysql_connection,$query2);
    if(!$query_run2){
        mysqli_close($mysql_connection);
        header("Refresh: 3; url=http://localhost/files/books.php");  
        echo "Could not borrow book!";

    }else{
    mysqli_close($mysql_connection);
    header("Refresh: 3; url=http://localhost/files/books.php");  
    echo "Book successfully borrowed!";
    }
}


?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Borrow - Databases Project 2019</title>
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
    echo '<form method="post" action = "borrow.php?ISBN='.$ISBN.'&copy='.$copy.'">';		
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
              <button type="submit" name="submit" class="smalladdButton" >Borrow</button>
        </div>
      </form>
    </section>
</div>
<footer>
    Databases Project 2018-2019    |     Vosinas Konstantinos AM : 03116435    |    Andriopoulos Konstantinos AM : 03116023      

</footer>

</body>

</html>