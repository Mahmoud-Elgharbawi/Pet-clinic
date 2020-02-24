<?php 
include 'config.php';
session_start();
if(isset($_POST["Signin"]))
{
    $USERMAIL = htmlspecialchars($_POST['Email']);
    $PASSWORD = htmlspecialchars($_POST['password']);
    echo $PASSWORD;
    $Hash_Password = hash('sha256',$PASSWORD);
    $types = $connect->prepare("SELECT * FROM users WHERE  email = '$USERMAIL' ");
    $types ->execute();
    $types=$types->fetch(PDO::FETCH_ASSOC);   
    $count = count($types);  
   if($count>0){
    $_SESSION['Email']=$USERMAIL;
    }
    $result=$types['type'];
    $pass=$types['password'];
    if($Hash_Password==$pass)
    {
        if ($result == 'pet owner'){
     //echo "pets";
        $ID = $connect->query("SELECT ID FROM users WHERE  email = '$USERMAIL' ");
        $ID ->execute();
        $ID=$ID->fetch(PDO::FETCH_ASSOC); 
        $_SESSION['ID']=$ID['ID'];
        $_SESSION['type']='pet owner';
          header('Location: pet_owner.php');
    } elseif($result == 'Doctor'){
        $ID = $connect->query("SELECT ID FROM users WHERE  email = '$USERMAIL' ");
        $ID ->execute();
        $ID=$ID->fetch(PDO::FETCH_ASSOC); 
        $_SESSION['ID']=$ID['ID'];
        $_SESSION['type']='doctor';
       //echo "doctor";
         header('Location: doctor.php');
    } elseif($result == 'admin') {
        $_SESSION['type']=$result;
       // echo "welcome admin";
             $_SESSION['type']='admin';
        header('Location: admin.php');
       
    }else{
        echo "no Type";
    }
    }
    else{
        echo "Email and password combination doesn't exist";
    }
}
?>
<!DOCTYPE html>
<html>
<style>
    #join
    {
        margin-top: -10px;
        text-align: center;
    }
    a
    {
        color: white;
    }
    a:visited
    {
        color: white;
    }
    </style>
<head>
    <title>Pet Shop</title>
    <meta charset="iso-8859-1">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <!--[if IE 6]><link href="css/ie6.css" rel="stylesheet" type="text/css"><![endif]-->
    <!--[if IE 7]><link href="css/ie7.css" rel="stylesheet" type="text/css"><![endif]-->
</head>

<body id="Logbody">
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
        <form id="Logform" method="POST">
            <p id="Type">Log In:</p><br>
            <input type="text" placeholder="Email" name="Email" required><br>
             <input type="password" placeholder="password" id="password" name="password" required><br>
            <input type="submit" value="Sign in" name="Signin"> 
            <a href="registration.php"><p id="join">Join now</p></a>
        </form>
    </div>
            <div class="footnote">Copyright &copy; 2018 | ACU CS Project
    </div>
</body>

</html>
