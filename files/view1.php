<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Members - Databases Project 2019</title>
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
                <li><a href="#"> View1 </a></li>
                <li><a href="view2.php"> View2 </a></li>
            
            </ul>
        </nav>
    </div>
    

</header>
<div class="width_container">
    <section>
        <h1>
            Adult Members (updatable)
        </h1>
        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>MemberID</th>
                <th>Address</th>
                <th>Date of Birth</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <?php
                require "connect.php";

                $query = "SELECT * 
                FROM adult_members";

                if($query_run = mysqli_query($mysql_connection,$query))
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        $memberid = $row["memberID"];
                        $first = $row["Mfirst"];
                        $last=$row["Mlast"];
                        $street=$row["Street"];
                        $number=$row["number"];
                        $postal=$row["postalCode"];
                        $birthdate=$row["Mbirthdate"];
    
                        echo '<tr><td>'.$last.', '.$first.'</td><td>'.$memberid.'</td><td>'.$street.' '.$number.', '.$postal.'</td><td>'.$birthdate.'</td>';
                        echo '<td><a href="./memberOps/editMember.php?id='.$memberid.'" class="no_underline"><i class="material-icons">border_color</i></a></td>';
                        echo '<td><a href="./memberOps/deleteMember.php?id='.$memberid.'" class="no_underline"><i class="material-icons" style="color:red">delete</i></a></td></tr>';
                        
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