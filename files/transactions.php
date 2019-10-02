<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Transactions - Databases Project 2019</title>
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
                <li><a href="#">Transactions</a></li>
                <li><a href="stats.php">Statistics</a> </li>
                <li><a href="view1.php"> View1 </a></li>
                <li><a href="view2.php"> View2 </a></li>
            
            </ul>
        </nav>
    </div>
    

</header>
<div class="width_container">
    <section>
        <h1>
            Transactions List
        </h1>
        
        <h2>
            Ongoing Transactions
        </h2>
        <table class="table">
            <thead>
            <tr>
                <th>Date of Borrowing</th>
                <th>Due date</th>
                <th>Book</th>
                <th>Member</th>
                <th></th>
            </tr>
            </thead>
            <?php
                require "connect.php";

                $query = "SELECT B1.title, M.MFirst, M.MLast, M.memberID, C.ISBN, B2.copyNr, B2.date_of_borrowing, DATE_ADD(B2.date_of_borrowing,INTERVAL 30 DAY)
                FROM member AS M, borrows AS B2, copy AS C, book AS B1
                WHERE B1.ISBN=B2.ISBN AND C.ISBN = B2.ISBN AND C.copyNr = B2.copyNr AND M.memberID = B2.memberID AND B2.date_of_return IS NULL
                ORDER BY B2.date_of_borrowing;";

                if($query_run = mysqli_query($mysql_connection,$query))
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        $memberid = $row["memberID"];
                        $first = $row["MFirst"];
                        $last=$row["MLast"];
                        $ISBN=$row["ISBN"];
                        $title=$row["title"];
                        $copyNr=$row["copyNr"];
                        $bor=$row["date_of_borrowing"];
                        $due=$row["DATE_ADD(B2.date_of_borrowing,INTERVAL 30 DAY)"];

    
                        echo '<tr><td>'.$bor.'</td><td>'.$due.'</td><td>'.$title.', '.$ISBN.', #'.$copyNr.'</td><td>'.$first.' '.$last.', '.$memberid.'</td>';
                        echo '<td><a href="./bookOps/return.php?ISBN='.$ISBN.'&copy='.$copyNr.'&id='.$memberid.'&date='.$bor.'"><button class="smalladdButton">Return</button></a>';

                    }
                }
                else
                {
                    echo 'Error';
                }
    
                mysqli_close($mysql_connection);
            
            ?>

        </table>

        <h2>
            Completed Transactions
        </h2>
        <table class="table">
            <thead>
            <tr>
            <tr>
                <th>Date of Borrowing</th>
                <th>Return date</th>
                <th>Book</th>
                <th>Member</th>
            </tr>
            </tr>
            </thead>
            <?php
                require "connect.php";

                $query = "SELECT M.MFirst, M.MLast, M.memberID, B1.ISBN, B1.title, B2.copyNr, B2.date_of_borrowing, B2.date_of_return
                FROM member AS M, book as B1, borrows AS B2
                WHERE B1.ISBN = B2.ISBN AND M.memberID = B2.memberID AND B2.date_of_return IS NOT NULL
                ORDER BY B2.date_of_borrowing;";

                if($query_run = mysqli_query($mysql_connection,$query))
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        $memberid = $row["memberID"];
                        $first = $row["MFirst"];
                        $last=$row["MLast"];
                        $ISBN=$row["ISBN"];
                        $title=$row["title"];
                        $copyNr=$row["copyNr"];
                        $bor=$row["date_of_borrowing"];
                        $due=$row["date_of_return"];

    
                        echo '<tr><td>'.$bor.'</td><td>'.$due.'</td><td>'.$title.', '.$ISBN.', #'.$copyNr.'</td><td>'.$first.' '.$last.', '.$memberid.'</td></tr>';
                    }
                }
                else
                {
                    echo 'Error';
                }
    
                mysqli_close($mysql_connection);
            
            ?>

        </table>



        <h2>
            Reminders
        </h2>
        <table class="table">
            <thead>
            <tr>
            <tr>
                <th>Date of Reminder</th>
                <th>Date of Borrowing</th>
                <th>Book</th>
                <th>Employee</th>
                <th>Member</th>
            </tr>
            </tr>
            </thead>
            <?php
                require "connect.php";

                $query = "SELECT M.MFirst, M.MLast, M.memberID, B1.ISBN, B1.title, R.copyNr, R.date_of_borrowing, E.empID, E.EFirst, E.ELast, R.date_of_reminder
                FROM member AS M, book as B1, reminder AS R, employee AS E, borrows AS B2
                WHERE B1.ISBN = R.ISBN AND E.empID = R.empID AND M.memberID = R.memberID AND R.copyNr = B2.copyNr AND R.date_of_borrowing = B2.date_of_borrowing
                AND B2.memberID = M.memberID AND B2.ISBN = R.ISBN
                ORDER BY R.date_of_reminder desc;";

                if($query_run = mysqli_query($mysql_connection,$query))
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        $memberid = $row["memberID"];
                        $empid = $row["empID"];
                        $first = $row["MFirst"];
                        $efirst = $row["EFirst"];
                        $last=$row["MLast"];
                        $elast=$row["ELast"];
                        $ISBN=$row["ISBN"];
                        $title=$row["title"];
                        $copyNr=$row["copyNr"];
                        $bor=$row["date_of_borrowing"];
                        $rem=$row["date_of_reminder"];

    
                        echo '<tr><td>'.$rem.'</td><td>'.$bor.'</td><td>'.$title.', '.$ISBN.', #'.$copyNr.'</td><td>'.$efirst.' '.$elast.', '.$empid.'</td><td>'.$first.' '.$last.', '.$memberid.'</td></tr>';
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