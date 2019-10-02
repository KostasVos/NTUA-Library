
<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>BookInfo - Databases Project 2019</title>
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
            Book Info
        </h1>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>ISBN</th>
                <th>Writer</th>
                <th>Publisher</th>
                <th>Category</th>
                <th>Pages</th>
                <th>Copy Number</th>
                <th>Availability</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <?php
                $ISBN = $_GET['id'];

                require "../connect.php";

                $query = "SELECT B.ISBN, B.title, B.pubName, B.pubYear, 
                B.numpages,A.AFirst, A.ALast, YEAR(A.Abirthdate), BT.categoryName, C.copyNr, C.shelf, MAX(BO.date_of_return), MAX(BO.date_of_borrowing)
                FROM ((((book AS B LEFT JOIN belongs_to AS BT ON B.ISBN = BT.ISBN) LEFT JOIN written_by AS WB ON B.ISBN = WB.ISBN) 
                LEFT JOIN author as A ON A.authID = WB.authID) JOIN copy AS C ON C.ISBN = B.ISBN) LEFT JOIN borrows AS BO
                ON BO.ISBN = C.ISBN AND BO.copyNr = C.copyNr
                WHERE B.ISBN=".$ISBN."
                GROUP BY B.ISBN, C.copyNr;";

                if($query_run = mysqli_query($mysql_connection,$query))
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                    
                        $title = $row["title"];
                        $pubName = $row["pubName"];
                        $pubYear = $row["pubYear"];
                        $categ = $row["categoryName"];
                        $authYear = $row["YEAR(A.Abirthdate)"];
                        $name = $row["AFirst"];
                        $last = $row["ALast"];
                        $pages = $row["numpages"];
                        $copyNR = $row["copyNr"];
                        $shelf = $row["shelf"];
                        $date1=$row["MAX(BO.date_of_return)"];
                        $date2=$row["MAX(BO.date_of_borrowing)"];

                        if((is_null($date1) && !is_null($date2)) || ($date2 > $date1)){
                            $message="Not available";
                            $borrow="";
                        }else{
                            $message="Available at shelf ".$shelf;
                            $borrow='<a href="./borrow.php?ISBN='.$ISBN.'&copy='.$copyNR.'"><button class="smalladdButton">Borrow</button></a>';
                        }

    
                        echo '<tr><td>'.$title.'</td><td>'.$ISBN.'</td><td>'.$name.' '.$last.', '.$authYear.'</td><td>'.$pubName.', '.$pubYear.'</td><td>'.$categ.'</td><td>'.$pages.'</td><td>'.$copyNR.'</td><td>'.$message.'</td>';
                        echo'<td>'.$borrow.'</td></tr>';
                        
                    }
                }
                else
                {
                    echo 'Error';
                }
    
                mysqli_close($mysql_connection);
            
            ?>

        </table>
    </section>
</div>

<footer>
    Databases Project 2018-2019    |     Vosinas Konstantinos AM : 03116435    |    Andriopoulos Konstantinos AM : 03116023      

</footer>

</body>

</html>