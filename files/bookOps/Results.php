<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Results - Databases Project 2019</title>
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
            Books List
        </h1>
        <p>
            Click on a book to view the avaible copies.
        </p>

        <a href="addBook.php"><button class=addButton>Add a Book</button></a>
        <a href="searchBook.php"><button class=addButton>Search</button></a>

        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>ISBN</th>
                <th>Writer</th>
                <th>Publisher</th>
                <th>Category</th>

                <th></th>
                <th></th>
            </tr>
            </thead>
            <?php
                require "../connect.php";

                if(!empty($_POST)){

                $searchresult = $_POST['searchterm'];
                
                $query = 'SELECT B.ISBN, B.title, B.pubName, B.pubYear, A.AFirst, A.ALast, YEAR(A.Abirthdate), BT.categoryName
                FROM ((book AS B LEFT JOIN belongs_to AS BT ON B.ISBN = BT.ISBN) LEFT JOIN written_by AS WB ON B.ISBN = WB.ISBN) LEFT JOIN author as A 
                ON A.authID = WB.authID
                WHERE (B.title LIKE "%'.$searchresult.'%");';

                if($query_run = mysqli_query($mysql_connection,$query))
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        $ISBN = $row["ISBN"];
                        $title = $row["title"];
                        $pubName = $row["pubName"];
                        $pubYear = $row["pubYear"];
                        $categ = $row["categoryName"];
                        $authYear = $row["YEAR(A.Abirthdate)"];
                        $name = $row["AFirst"];
                        $last = $row["ALast"];


    
                        echo '<tr><td><a href="bookInfo.php?id='.$ISBN.'" class="no_underline">'.$title.'</a></td><td>'.$ISBN.'</td><td>'.$name.' '.$last.', '.$authYear.'</td><td>'.$pubName.', '.$pubYear.'</td><td>'.$categ.'</td>';
                        echo '<td><a href="editBook.php?id='.$ISBN.'" class="no_underline"><i class="material-icons">border_color</i></a></td>';
                        echo '<td><a href="deleteBook.php?id='.$ISBN.'" class="no_underline"><i class="material-icons" style="color:red">delete</i></a></td></tr>';
                        
                    }
                }
                else
                {
                    echo 'Error';
                }
    
                mysqli_close($mysql_connection);
            }            
            ?>

        </table>
    </section>
</div>

<footer>
    Databases Project 2018-2019    |     Vosinas Konstantinos AM : 03116435    |    Andriopoulos Konstantinos AM : 03116023      

</footer>

</body>

</html>