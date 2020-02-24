<link rel="stylesheet" href="admin.css" type="text/css" />
<?php 
if($_SESSION['type']!='admin')
{
    header("location: index.php");
}
include 'config.php';
if(isset($_POST['products'])){
    $product_name = htmlspecialchars($_POST['product_name']);
    $price = htmlspecialchars($_POST['price']);
    $discription = htmlspecialchars($_POST['description']);
    $stmt = $connect->prepare("INSERT INTO products(product_name,price,	description) VALUES(:product_name,:price,:discription)");
    $stmt->bindParam(':product_name',$product_name);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':dscription',$discription);
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

<body id="Admin">
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
        <form id="AdminForm" method="POST">
            <p id="Type">Add product:</p><br>
            <input type="text" placeholder="product name" name="product_name" required><br>
             <input type="number" placeholder="price" name="price" required><br>
            <input type="description" placeholder="description" name="description" required>
            <input type="submit" value="Add product" name="products">
        </form>
    </div>
            <div class="footnote">Copyright &copy; 2018 | ACU CS Project
    </div>
</body>

</html>