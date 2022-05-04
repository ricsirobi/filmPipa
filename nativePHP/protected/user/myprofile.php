<HTMl>
<?php 
    $pic=1;
        $uid =$_SESSION["uid"];
        $checkQuery = "sELECT uid, username, profilepic FROM users WHERE uid =" .$uid;
        $userinfo = classList($checkQuery);
        if ($userinfo === null || empty($userinfo)) {
            $pic = 1;    
        }
        else
        {
            $pic = $userinfo[0]["profilepic"];
        }
?>
<HEAD>
    <link rel="stylesheet" href="<?php echo PUBLIC_DIR . "login_register.css"; ?>">
    <link rel="stylesheet" href="../../public/style.css">
   
</HEAD>

<BODY>
    <h1> Profilom: <?php echo $userinfo[0]["username"];?> </h1>
    <a href="index.php?P=setprofilepic">><img src='<?php echo PROFILE_PIC_DIR.$pic.".png";?>'/></a> 
    <div>
        Ennyi időt szántam film és sorozat megtekintésre: 

    </div>
</BODY>

</HTML>
<?php

?>


<?php

?>