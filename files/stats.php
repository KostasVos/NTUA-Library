<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Statistics - Databases Project 2019</title>
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
                <li><a href="#">Statistics</a> </li>
                <li><a href="view1.php"> View1 </a></li>
                <li><a href="view2.php"> View2 </a></li>
            
            </ul>
        </nav>
    </div>
    

</header>
<div class="width_container">
    <section>
    <h1>
        Statistics
    </h1>
    <h2>Top 5 Borrowed Books</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Title</th>
                <th>Times borrowed</th>
            </tr>
            </thead>
            <?php
                require "connect.php";

                $query = "SELECT B.title,B.ISBN, COUNT(*)
                FROM book AS B, borrows AS BO
                WHERE B.ISBN = BO.ISBN
                GROUP BY B.ISBN
                ORDER BY COUNT(*) DESC
                LIMIT 5;";

                if($query_run = mysqli_query($mysql_connection,$query))
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        $title = $row["title"];
                        $ISBN = $row["ISBN"];
                        $count = $row["COUNT(*)"];
                        echo '<tr><td>'.$title.', ISBN = '.$ISBN.'</td><td>'.$count.'</td></tr>';
                    }
                }
                else
                {
                    echo 'Error';
                }
                mysqli_close($mysql_connection);
            
            ?>

        </table>

        <h2>Top 5 Members with most books borrowed</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>MemberID</th>
                <th># of books borrowed</th>
            </tr>
            </thead>
            <?php
                require "connect.php";

                $query = "SELECT M.MFirst, M.MLast, M.memberID, COUNT(*)
                FROM member AS M, borrows AS B
                WHERE M.memberID = B.memberID
                GROUP BY M.memberID
                ORDER BY COUNT(*) DESC
                LIMIT 5;";

                if($query_run = mysqli_query($mysql_connection,$query))
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        $first = $row["MFirst"];
                        $last=$row["MLast"];
                        $memberID=$row["memberID"];
                        $count=$row["COUNT(*)"];
                        
                        echo '<tr><td>'.$last.', '.$first.'</td><td>'.$memberID.'</td><td>'.$count.'</td></tr>';
                        
                    }
                }
                else
                {
                    echo 'Error';
                }
                mysqli_close($mysql_connection);
            
            ?>

        </table>

        
        <h2>Members which have borrowed no books</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>MemberID</th>
            </tr>
            </thead>
            <?php
                require "connect.php";

                $query = "SELECT MFirst, MLast, memberID
                FROM member
                WHERE NOT EXISTS
                (SELECT *
                FROM borrows
                WHERE borrows.memberID = member.memberID)
                ORDER BY Mlast;";

                if($query_run = mysqli_query($mysql_connection,$query))
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        $first = $row["MFirst"];
                        $last=$row["MLast"];
                        $memberID=$row["memberID"];
                        
                        echo '<tr><td>'.$last.', '.$first.'</td><td>'.$memberID.'</td></tr>';
                        
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