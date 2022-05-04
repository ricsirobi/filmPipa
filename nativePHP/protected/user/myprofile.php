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
        Ennyi időt szántam sorozat részek megtekintésre: 
        <?php 
            $sql = "select sum(resz.hossz) as \"min\" from resz, sawepisode where ".$_SESSION["uid"]." = sawepisode.uid and sawepisode.eid = resz.id ";
            $res = classList($sql);
            if($res[0]["min"] == "")
            {
                echo 0;
            }
            else
            {
                echo $res[0]["min"];
            }
            
        ?>
        perc 
    </div>
    <div>
    Ennyi időt szántam filmek megtekintésre: 
        <?php
            $sql = "select sum(filmek.hossz) as \"min\" from filmek, sawfilm where ".$_SESSION["uid"]." = sawfilm.uid and sawfilm.fid = filmek.id ";
            $res = classList($sql);
            if($res[0]["min"] == "")
            {
                echo 0;
            }
            else
            {
                echo $res[0]["min"];
            }
            ?>
            perc 

    </div>
</BODY>

</HTML>
<?php

?>


<?php

?>