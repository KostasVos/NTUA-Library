<?php

$ISBN = $_GET['id'];

require '../connect.php';

$query21 = "SELECT * FROM publisher";

$publishers = mysqli_query($mysql_connection,$query21);

mysqli_close($mysql_connection);
?>


<?php

require '../connect.php';

if(isset($_POST["submit"]))
{
    $titlenew = $_POST['title'];
    $pubYear = $_POST['pubYear'];
    $numpages = $_POST['numpages'];
    $pubName = $_POST['publisher'];

    $query = "UPDATE book SET title = '$titlenew', numpages = '$numpages', pubYear = '$pubYear', pubName = '$pubName' WHERE ISBN='$ISBN';";
    $query_run1 = mysqli_query($mysql_connection,$query);

    if(!$query_run1){
        header("Refresh: 3; url=http://localhost/files/books.php");  
            echo "Error: Failed to edit book!";

    }else{
    mysqli_close($mysql_connection);

    header("Refresh: 3; url=http://localhost/files/books.php");  
        echo "Book successfully edited!";
    }
}


?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Edit a Book - Databases Project 2019</title>
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
    echo '<form method="post" action = "editBook.php?id='.$ISBN.'">';		
    ?>	
        <div class="width_container">
            <label for="title">Title:</label> <br>
            <input type="text"  id="title" name = "title" value="" maxlength= "100" required>
        </div>

        <div class="width_container">
            <label for="pubYear">Year of publication:</label> <br>
            <input type="number"  id="pubYear" name = "pubYear" value="" required>
        </div>

        <div class="width_container">
            <label for="numpages">Number of Pages:</label> <br>
            <input type="number"  id="numpages" name = "numpages" value="" required>
        </div>

        <div class="width_container">
            <label for="publisher">Publisher:</label> <br>
            <select name="publisher">
            <?php
                while($row = mysqli_fetch_array($publishers)) {
                    echo '<option value='.$row['pubName'].'>'.$row['pubName'].'</option>';
                }
                ?> 
            </select>
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