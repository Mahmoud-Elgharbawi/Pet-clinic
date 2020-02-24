<?php
include 'config.php';
if(isset($_POST['Signup'])){
    $USERMAIL = htmlspecialchars($_POST['Email']);
    $PASSWORD = htmlspecialchars($_POST['password']);
    $USERNAME = htmlspecialchars($_POST['username']);
    $USERNAME = htmlspecialchars($_POST['username']);
    $Hash_Password = hash('sha256',$PASSWORD);
    $type=$_POST['type'];
    $stmt = $connect->prepare("INSERT INTO users(Name,password,email,type) VALUES(:username,:password,:Email,:type)");
    $stmt->bindParam(':username',$USERNAME);
    $stmt->bindParam(':password', $Hash_Password);
    $stmt->bindParam(':Email',$USERMAIL);
    $stmt->bindParam(':type',$type);
$stmt ->execute();
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

<body id="Regbody">
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
        <form id="RegForm" method="POST">
            <p id="Type">Registration:</p><br>
                    <input type="text" name="Email" placeholder="Email address" >
                     <input type="username"  name="username" placeholder="User name">
                    <input type="password"  name="password" placeholder="Password" id="password"  required>
                    
                   <select name="type">
                    <option>Type</option>
                    <option name = "doctor">Doctor</option>
                    <option name ="pet's_owner">pet owner</option>
                    </select>
                    <input type="submit" value="Sign up" name="Signup">
        </form>
    </div>
            <div class="footnote">Copyright &copy; 2018 | ACU CS Project
    </div>
</body>

</html>


