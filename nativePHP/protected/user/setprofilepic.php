<h1> Profilkép cseréje</h1>
<?php
if(isset($_POST["profpic"]))
{
    $sql = "UPDATE users SET profilepic=".$_POST['profpic']." WHERE uid = ".$_SESSION["uid"];
    executeQuery($sql);
    header('Location: index.php?P=profile');
}

?>
<form action = "" method ="post">
    
    <table>
    
        <tr>
            <td><input type="radio" name="profpic" value="1"><img src='<?php echo PROFILE_PIC_DIR."1.png";?>'></td>
            <td><input type="radio" name="profpic" value="2"><img src='<?php echo PROFILE_PIC_DIR."2.png";?>'></td>
            <td><input type="radio" name="profpic" value="3"><img src='<?php echo PROFILE_PIC_DIR."3.png";?>'></td>
            <td><input type="radio" name="profpic" value="4"><img src='<?php echo PROFILE_PIC_DIR."4.png";?>'></td>
            <td><input type="radio" name="profpic" value="5"><img src='<?php echo PROFILE_PIC_DIR."5.png";?>'></td>
            </tr>
        <tr>
        <td><input type="radio" name="profpic" value="6"><img src='<?php echo PROFILE_PIC_DIR."6.png";?>'></td>
        <td><input type="radio" name="profpic" value="7"><img src='<?php echo PROFILE_PIC_DIR."7.png";?>'></td>
        <td><input type="radio" name="profpic" value="8"><img src='<?php echo PROFILE_PIC_DIR."8.png";?>'></td>
        <td><input type="radio" name="profpic" value="9"><img src='<?php echo PROFILE_PIC_DIR."9.png";?>'></td>
        <td><input type="radio" name="profpic" value="10"><img src='<?php echo PROFILE_PIC_DIR."10.png";?>'></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>
                <input type = "submit" value = "Mentés">
            </td>
            <td></td>
            <td></td>
        </tr>

    </table>

</form>