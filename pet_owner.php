<?php
include 'config.php';
session_start();
 if(!isset($_SESSION['ID']))
 {
     header("Location: index.php");  
 }
// echo $_SESSION['Email'];
if(isset($_POST['OK'])){
     $doctor = htmlspecialchars($_POST['doctor']);
    $feedback = htmlspecialchars($_POST['feedback']);
    $rate=htmlspecialchars($_POST['rate']);
    $stmt = $connect->prepare("SELECT ID FROM users WHERE Name='$doctor'");
    $stmt->execute();
     $stmt = $stmt->fetch(PDO::FETCH_ASSOC); 
    $ID=$stmt['ID'];
    $stmt2 = $connect->prepare("INSERT INTO evaluations(users_id,feedback,rateing) VALUES('$ID','$feedback','$rate')");
$stmt2 ->execute();
}
?>

<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <!--[if IE 6]><link href="css/ie6.css" rel="stylesheet" type="text/css"><![endif]-->
    <!--[if IE 7]><link href="css/ie7.css" rel="stylesheet" type="text/css"><![endif]-->
</head>
<body id="owner">
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
        <form id="ownerForm" method='POST'>
            <p id="Type">Evaluation</p><br>
    <?php
     echo "<select name='doctor'>";
    $name =$connect->query("SELECT Name FROM users WHERE type = 'Doctor'")  ;
    $name ->execute(); 
   while($Name=$name->fetch(PDO::FETCH_ASSOC)) {
       $row=$Name['Name'];
        echo "<option> $row </option>";
        }
    echo "</select>";
    ?>




                <textarea name="feedback"></textarea>
        <h2> Rate this Doctor</h2>
        <select name="rate" value="rate">
       <option>bad</option><br>
        <option>good</option><br>
        <option>very good</option><br>
        <option>Exellent</option>
        </select>
        
         <input type="submit" value="OK" name="OK"/>
        </form>
    </div>
            <div class="footnote">Copyright &copy; 2018 | ACU CS Project
    </div>
</body>

