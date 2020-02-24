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

 <script>
     

     function chk()
     {
         var checkedValue=0; 
         var inputElements = document.getElementsByClassName('chk');
         for(var i=0; inputElements[i]; ++i){
            if(inputElements[i].checked){
                checkedValue += parseFloat(inputElements[i].value);
            }
         }
         //document.write(checkedValue);
         var now = new Date();
         var CurTime = now.getTime();
         var expireTime = CurTime + 120*1000;
         document.cookie = "price="+checkedValue+"; expires="+expireTime+"; path=/";
       //document.getElementById('1').style.display = "block";   
}</script>


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
    $sql = "select product_name,price,description from products";
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    echo "<table>";
    echo "<tr>
        <th>product name</th>
        <th>price</th>
        <th>description</th>
        <th>buy</th>
        </tr>";
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td> $row[0] </td>";
        echo "<td> $row[1] </td>";
        echo "<td> $row[2] </td>";
        echo "<td><input class='chk' type='checkbox' value='$row[1]'></td>";
        echo "</tr>"; 
    }
    echo "</table>";

} catch (PDOException $e) {

    echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>
<form method="POST">
    <input type="submit" value="buy" onclick="chk();" name="buy"/>
</form>
<?php if(isset($_POST['buy'])){
       echo $_COOKIE['price'];
}?>
<div class="footnote2">Copyright &copy; 2018 | ACU CS Project
    </div>

