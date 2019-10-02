<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Employees - Databases Project 2019</title>
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
                <li><a href="#">Employees</a> </li>
                <li><a href="transactions.php">Transactions</a></li>
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
            Employees List
    </h1>
    <h2>Permanent Employees</h2>

    <a href="./employeeOps/addPemployee.php"><button class=addButton>Add a Permanent Employee</button></a>

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>EmployeeID</th>
                <th>Salary</th>
                <th>Hiring Date</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <?php
                require "connect.php";

                $query = "SELECT E.empID, E.EFirst, E.ELast, E.salary, PE.hiringDate
                FROM employee AS E, permanent_employee AS PE
                WHERE E.empID = PE.empID
                ORDER BY PE.empID;";

                if($query_run = mysqli_query($mysql_connection,$query))
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        $empID = $row["empID"];
                        $first = $row["EFirst"];
                        $last=$row["ELast"];
                        $salary=$row["salary"];
                        $date=$row["hiringDate"];
                        
                        echo '<tr><td>'.$last.', '.$first.'</td><td>'.$empID.'</td><td>'.$salary.' $'.'</td><td>'.$date.'</td>';
                        echo '<td><a href="./employeeOps/editPEmployee.php?id='.$empID.'" class="no_underline"><i class="material-icons">border_color</i></a></td>';
                        echo '<td><a href="./employeeOps/deleteEmployee.php?id='.$empID.'" class="no_underline"><i class="material-icons" style="color:red">delete</i></a></td></tr>';
                        
                    }
                }
                else
                {
                    echo 'Error';
                }
                mysqli_close($mysql_connection);
            
            ?>

        </table>

        <h2>Temporary Employees</h2>
        <a href="./employeeOps/addTemployee.php"><button class=addButton>Add a Temporary Employee</button></a>

        <table class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>EmployeeID</th>
                <th>Salary</th>
                <th>Contract Number</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <?php
                require "connect.php";

                $query = "SELECT E.empID, E.EFirst, E.ELast, E.salary, TE.contractNr
                FROM employee AS E, temporary_employee AS TE
                WHERE E.empID = TE.empID
                ORDER BY E.empID;";

                if($query_run = mysqli_query($mysql_connection,$query))
                {
                    while($row = mysqli_fetch_assoc($query_run))
                    {
                        $empID = $row["empID"];
                        $first = $row["EFirst"];
                        $last=$row["ELast"];
                        $salary=$row["salary"];
                        $con=$row["contractNr"];
                        
                        echo '<tr><td>'.$last.', '.$first.'</td><td>'.$empID.'</td><td>'.$salary.' $'.'</td><td>'.$con.'</td>';
                        echo '<td><a href="./employeeOps/editTemployee.php?id='.$empID.'" class="no_underline"><i class="material-icons">border_color</i></a></td>';
                        echo '<td><a href="./employeeOps/deleteEmployee.php?id='.$empID.'" class="no_underline"><i class="material-icons" style="color:red">delete</i></a></td></tr>';
                        
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