
<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>Search - Databases Project 2019</title>
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
            Search Books        </h1>
        <p>
            Search a book by name.
        </p>
        <form method="post" action = "Results.php">
        <div>
            <label for="searchterm">Search Term:</label>
            <input type="text"  id="searchterm" name = "searchterm" value="">
        </div>
        
        <div>	
              <button type="submit" name="submit" class="smalladdButton" >Search</button>
        </div>
      </form>

        
    </section>
</div>

<footer>
    Databases Project 2018-2019    |     Vosinas Konstantinos AM : 03116435    |    Andriopoulos Konstantinos AM : 03116023      

</footer>

</body>

</html>