<?php 
session_start();
?>
<?php 
include 'config.php';
if(isset($_POST['services'])){
    $services_name = htmlspecialchars($_POST['services_name']);
    $date = htmlspecialchars($_POST['date']);
    $stmt = $connect->prepare("SELECT ID_services FROM service WHERE name_services='$services_name'");
    $stmt3 = $connect->prepare("INSERT INTO service(name_services) VALUES('$services_name')");
    $stmt3 ->execute();
    $stmt ->execute();
    $stmt=$stmt->fetch(PDO::FETCH_ASSOC);
    $result=$stmt['ID_services'];
    $ID=$_SESSION['ID'];
    $stmt2 = $connect->prepare("INSERT INTO time(ID_doctor,time,services_Id) VALUES('$ID','$date','$result')");
    $stmt2 ->execute();
    
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <!--[if IE 6]><link href="css/ie6.css" rel="stylesheet" type="text/css"><![endif]-->
    <!--[if IE 7]><link href="css/ie7.css" rel="stylesheet" type="text/css"><![endif]-->
</head>

<body id="DocService">
    <div id="header"> <a href="#" id="logo"><img src="images/logo.png" width="310" height="114" alt=""></a>
        <ul class="navigation"> 
            <li class="active"><a href="index.html">Home</a></li>
            <li><a href="products.php">PetMarket</a></li>
            <li><a href="evaluations.php">Evaluations</a></li>
            <li><a href="all_Doctors.php">Doctors</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="Login.php">Log in</a></li>
            <li><a href="log_out.php">Log out</a></li>

        </ul>
        <form id="DocForm" method="POST">
            <p id="Type">Add Services:</p><br>
            <input type="text" name="services_name" placeholder="services name" required ><br>
            <input type="date"  name="date" placeholder="date" required><br>
            <input type="submit" value="add services" name="services" required>
        </form>
    </div>
            <div class="footnote">Copyright &copy; 2018 | ACU CS Project
    </div>
</body>

</html>
