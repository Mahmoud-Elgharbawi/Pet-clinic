<?php
    session_start();
    if($_SESSION['type']=="admin")
    {
         header('Location: admin.php');
    }
 elseif($_SESSION['type']=='doctor')
    {
         header('Location: doctor.php');
    }
else
{
    header('Location: pet_owner.php');
}
?>