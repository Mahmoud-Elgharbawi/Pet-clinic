<?php session_start(); ?>
<link href="css/style.css" rel="stylesheet" type="text/css">
<style>
    body
    {
     background-color:floralwhite;   
    }
table{
    font-family: "Consolas", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 80%;
   margin-left: auto;margin-right: auto;
    margin-top: 50px;
    margin-bottom: 50px;
}

 td, th {
    border: 1px solid #ddd;
    padding: 8px;
}
tr:nth-child(even){background-color: #f2f2f2;}
tr:nth-child(odd){background-color: #a84762;}

tr:hover {background-color: #ddd;}

th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #145;
    color: white;
}

</style>
<body>
    <div id="header"> <a href="#" id="logo"><img src="images/logo.png" width="310" height="114" alt=""></a>
        <ul class="navigation">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="products.php">PetMarket</a></li>
            <li><a href="evaluations.php">Evaluations</a></li>
            <li><a href="all_Doctors.php">Doctors</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="Login.php">Log in</a></li>
            <li><a href="log_out.php">Log out</a></li>

        </ul>
    </div>
<?php
include 'config.php';
try{
   
    echo "<table>";
    echo "<tr>
        <th>Doctor_name</th>
        <th>rate</th>
        <th>feedback</th>
        </tr>";
    $result=$connect->query("SELECT * FROM evaluations");
    $result->execute();
    $result=$result->fetchAll();
    foreach($result as $row){
        $name=null;
        $sql = "SELECT Name FROM users WHERE ID=$row[0]";
        $DocName=$connect->query($sql);
        $DocName->execute();
        $DocName=$DocName->fetch(PDO::FETCH_ASSOC);
        $name=$DocName['Name'];

        if($name!=null)
        {
            echo "<tr>";
            echo "<td>$name</td>";
            echo "<td>$row[2]</td>";
            echo "<td>$row[3]</td>";
            
            echo "</tr>";
        }
    }
    echo "</table>";
} catch (PDOException $e) {
    echo $result . "<br>" . $e->getMessage();
}
?>
    <div class="footnote">
            Copyright &copy; 2018 | ACU CS Project
        </div>
</body>
