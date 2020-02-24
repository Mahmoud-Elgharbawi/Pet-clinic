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
    <div class="Docbanner">&nbsp;</div>
<?php
include 'config.php';
try{
$sql = "SELECT users.Name, time.time, service.name_services FROM time INNER JOIN users ON time.ID_doctor=users.ID INNER JOIN service ON time.services_Id=service.ID_services";
    
    
    
    
    
    $stmt = $connect->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    echo "<table>";
    echo "<tr>
        <th>Doctor name</th>
        <th>Time</th>
        <th>services name</th>
        <th>mark</th>
       
        </tr>";
    $count = 1 ;
    foreach ($result as $row) {
        $Select1 = $connect->query("SELECT ID FROM users where Name='$row[0]' and type='Doctor'");
        $Select1 ->execute();
        $Select1=$Select1->fetch(PDO::FETCH_ASSOC);
        $ID=$Select1['ID'];
        $Select2 = $connect->query("SELECT ID_time FROM time where time='$row[1]' and ID_doctor='$ID' ");
        $Select2 ->execute();
        $Select2=$Select2->fetch(PDO::FETCH_ASSOC);
        $ID_Time=$Select2['ID_time'];
        $User_ID=$_SESSION['ID'];
        $Select3 =$connect->query( "SELECT * FROM book where time='$ID_Time' and User_id='$User_ID' ");
        $Select3 ->execute();
        $Select3=$Select3->fetch(PDO::FETCH_ASSOC);
        $N="name".$count;
        $T="time".$count;
        $S="service".$count;
       
        echo "<tr>";
        echo "<td> <p id='$N'> $row[0]</p> </td>";
        echo "<td> <p id='$T'> $row[1] </p></td>";
        echo "<td> <p  id='$S'> $row[2] </p></td>";
        
       // echo "<td> <p id='$rate'>$row[3]</p></td> ";
        if($Select3!=null)
        {
            echo "<td> Booked </td>";
        }
        else
        {
            $num1;
            
            echo "<td> <input class='chk' type='checkbox' id='$count' value='$count'> </td>";    
        }
        echo "</tr>";
        $count++;
    }
    echo "</table>";

} catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
?>
<form name="myForm" method='POST' action="<?php echo $_SERVER['PHP_SELF']?>">
<input type='submit' onclick='chk()' value = 'book'>
</form>

 <script>
     

     function chk()
     {
         var checkedValue = null; 
         var inputElements = document.getElementsByClassName('chk');
         for(var i=0; inputElements[i]; ++i){
            if(inputElements[i].checked){
                checkedValue = inputElements[i].value;
                break;
            }
         }
         var name=document.getElementById("name"+checkedValue).innerHTML;
         var time=document.getElementById("time"+checkedValue).innerHTML;
         var service=document.getElementById("service"+checkedValue).innerHTML;

         
         var now = new Date();
         var CurTime = now.getTime();
         var expireTime = CurTime + 120*1000;
         document.cookie = "name="+name+"; expires="+expireTime+"; path=/";
         document.cookie = "time="+time+"; expires="+expireTime+"; path=/";
         document.cookie = "service="+service+"; expires="+expireTime+"; path=/";
       //document.getElementById('1').style.display = "block";   
}</script>
<?php if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name=$_COOKIE['name'];
        $time=$_COOKIE['time'];
        $service=$_COOKIE['service'];
        echo "$name , $time , $service";
        $Select1 = $connect->prepare("SELECT ID FROM users where Name='$name' and type='Doctor'");
        $Select1 ->execute();
        $Select1=$Select1->fetch(PDO::FETCH_ASSOC);
        $ID=$Select1['ID'];
        $Select2 = $connect->prepare("SELECT ID_time FROM time where time='$time' and ID_doctor='$ID'");
        $Select2 ->execute();
        $Select2=$Select2->fetch(PDO::FETCH_ASSOC);
        $ID_Time=$Select2['ID_time'];
        $User_ID=$_SESSION['ID'];
        $stmt = $connect->prepare("INSERT INTO book (User_ID,time) VALUES('$User_ID','$ID_Time')");
        $stmt->execute();
}?>
<div class="footnote2">Copyright &copy; 2018 | ACU CS Project</div>
</body>

