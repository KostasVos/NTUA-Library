<?php

require '../connect.php';
$error = '';


$query11 = "SELECT * FROM author";

$query21 = "SELECT * FROM publisher";

$query31 = "SELECT * FROM category";

$authors = mysqli_query($mysql_connection,$query11);

$publishers = mysqli_query($mysql_connection,$query21);

$categories = mysqli_query($mysql_connection,$query31);

mysqli_close($mysql_connection);
?>

<?php

require '../connect.php';

if(isset($_POST["submit"]))
{
    $ISBN = $_POST['ISBN'];
    $title = $_POST['title'];
    $pubYear = $_POST['pubYear'];
    $numpages = $_POST['numpages'];
    $category = $_POST['categ'];
    $authID = $_POST['author'];
    $pubName = $_POST['publisher'];
    $copy = $_POST['copy'];
    $shelf = $_POST['shelf'];


    $query1 = "INSERT INTO book VALUES('$ISBN' , '$title' , '$pubYear' , $numpages, '$pubName')";
    $query2 = "INSERT INTO written_by VALUES ('$ISBN','$authID')";
    $query3 = "INSERT INTO belongs_to VALUES ('$ISBN','$category')";
    $query_run1 = mysqli_query($mysql_connection,$query1);
    $query_run2 = mysqli_query($mysql_connection,$query2);
    $query_run3 = mysqli_query($mysql_connection,$query3);
    
    for ($i = 1; $i <= $copy; $i++) {
        $query4="INSERT INTO copy VALUES($ISBN, $i, $shelf)";
        $query_run4 = mysqli_query($mysql_connection,$query4);
        if(!$query_run4) break;
    }

    if(!$query_run1){
        mysqli_close($mysql_connection);
        header("Refresh: 3; url=http://localhost/files/books.php");  
        echo "Book with same ISBN already exists!";

    } elseif(!$query_run2 || !$query_run3 || !$query_run4){
        $result2 = mysqli_query($mysql_connection, "DELETE FROM book WHERE ISBN=$ISBN");
        mysqli_close($mysql_connection);

        header("Refresh: 3; url=http://localhost/files/books.php");  
        echo "Error: Could not add book!";
    }else{
    mysqli_close($mysql_connection);

    header("Refresh: 3; url=http://localhost/files/books.php");  
        echo "Book successfully added!";
    }
}


?>
<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Add a Book - Databases Project 2019</title>
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
    Add Book
    </h1>
    <p> Insert new book into the database.</p>
    <form method="post" action = "addBook.php">		
        <div class="width_container"> 
            <label for="ISBN">ISBN:</label> <br>
            <input type="text"  id="ISBN" name = "ISBN" value="" required pattern="[0-9]{13}">
        </div>
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
            <label for="categ">Category:</label> <br>
            <select name="categ">
            <?php
                while($row = mysqli_fetch_array($categories)) {
                    echo '<option value='.$row['categoryName'].'>'.$row['categoryName'].'</option>';
                }
                ?> 
            </select>
        </div>

        <div class="width_container">
            <label for="author">Author:</label> <br>
            <select name="author">
            <?php
                while($row = mysqli_fetch_array($authors)) {
                    echo '<option value='.$row['authID'].'>'.$row['ALast'].', '.$row['AFirst'].'</option>';
                }
                ?> 
            </select>
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
            <label for="copy">Copies:</label> <br>
            <input type="number"  id="copy" name = "copy" minvalue=0 value="" required>
        </div>

        <div class="width_container">
            <label for="shelf">Shelf:</label> <br>
            <input type="number"  id="shelf" name = "shelf" minvalue=1 value="" required>
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