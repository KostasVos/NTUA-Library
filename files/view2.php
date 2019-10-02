<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Books - Databases Project 2019</title>
    <link rel="stylesheet" type="text/css" href="main.css">

</head>

<body>
<header class="header_bar">
    <div class="width_container">
        <img src="logo.png" height="100" width=100 float:left>
        <nav>
            <ul>
                
                <li><a href="../index.php">Home</a> </li>
                <li><a href="books.php">Books</a> </li>
                <li><a href="members.php">Members</a> </li>
                <li><a href="employees.php">Employees</a> </li>
                <li><a href="transactions.php">Transactions</a></li>
                <li><a href="stats.php">Statistics</a> </li>
                <li><a href="view1.php"> View1 </a></li>
                <li><a href="#"> View2 </a></li>
            
            </ul>
        </nav>
    </div>
    

</header>
<div class="width_container">
    <section>
        <h1>
            Popular Books (non-updatable)
        </h1>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>ISBN</th>
                <th>Publisher</th>
                <th># of Pages</th>
                <th>Times Borrowed</th>
            </tr>
            </thead>
            <?php
                require "connect.php";

                $query = "SELECT * FROM popular_books";

                if($query_run = mysqli_query($mysql_connection,$query))
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        $ISBN = $row["ISBN"];
                        $title = $row["title"];
                        $pubName = $row["pubName"];
                        $numpages = $row["numpages"];
                        $count = $row["COUNT(*)"];


    
                        echo '<tr><td><a href="./bookOps/bookInfo.php?id='.$ISBN.'" class="no_underline">'.$title.'</a></td><td>'.$ISBN.'</td><td>'.$pubName.'</td><td>'.$numpages.'</td><td>'.$count.'</td></tr>';
                        
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