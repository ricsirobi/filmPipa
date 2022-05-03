<HTMl>
<HEAD>
    <link rel="stylesheet" href="<?php echo PUBLIC_DIR . "login_register.css"; ?>">
    <link rel="stylesheet" href="../../public/style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function alertText(id, msg, alertType) {
            if (alertType == "success") {
                document.getElementById(id).style.color = "#66CD00";
            } else {
                document.getElementById(id).style.color = "crimson";
            }
            document.getElementById(id).innerHTML = msg;
        }
    </script>
</HEAD>
<BODY>
    <form method="POST">
        <div class="simple-container">
            <h2>Rész hozzáadása</h2>
            <span id="alertText"></span>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="text" class="form-control" placeholder="Cím" name="episode_title">
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12 form-group">
                <?php
                $sql = "select * from sorozatok";
                $result = classList($sql);
                ?>    
                <select name="serie" id="serie">
                
                        <option value="" selected disabled>Sorozat</option>
                        <?php foreach ($result as $row) : $n = $n + 1 ?>
                        <option value="<?=$row["id"]?>|<?=$row["evad"]?>"><?=$row["cim"]?>: <?=$row["evad"]?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="number" placeholder="Hanyadik rész" class="form-control" name="episode_episode">
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="number" placeholder="Hossz (perc)" class="form-control" name="episode_minute">
                </div>
            </div>
            <div class="g-recaptcha" data-sitekey="6Ldn7pwfAAAAACw2iKHx8m9Z44PmGvO0WMI0jOSv"></div>
            <br>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="submit" class="btn btn-block btn-login" name="addEpisodeBtn" value="Hozzáadás">
                </div>
            </div>
        </div>
    </form>
</BODY>
</HTML>
<?php
if (isset($_POST["addEpisodeBtn"])) {
    if ($_POST['g-recaptcha-response'] != "") {
        if ($_POST["episode_title"] == "") {
?>
            <script>
                Swal.fire(
                    'Hiba!!',
                    'A cím nem lehet üres!',
                    'warning'
                )
            </script>
        <?php
        } else if ($_POST["serie"] == "") {
            ?>
                <script>
                    Swal.fire(
                        'Hiba!!',
                        'Válassza ki a sorozatot!',
                        'warning'
                    )
                </script>
            <?php
            } 
        
        else if ($_POST["episode_episode"] == "") {
        ?>
            <script>
                Swal.fire(
                    'Hiba!!',
                    'A rész sorszáma nem lehet üres!',
                    'warning'
                )
            </script>
        <?php
        } else if ($_POST["episode_minute"] == "") {
        ?>
            <script>
                Swal.fire(
                    'Hiba!!',
                    'A hossz nem lehet üres!',
                    'warning'
                )
            </script>
        <?php
        }   else {
            $secret = "6Ldn7pwfAAAAACRw3JETEHv49XHprFK4_nePnRy8";
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                
                $minute = $_POST["episode_minute"];    
                $etitle = $_POST["episode_title"];
                    $season = $_POST["serie"];
                    $serie = explode("|", $season)[0];
                    $season = explode("|", $season)[1];
                    $episode = $_POST["episode_episode"];
                    echo "<script>alertText('alertText','Sikeres hozzáadás!','success')</script>";
                    $addepisodequery = "INSERT INTO sorozatok(evad, resz, cim, kategoria, borito) VALUES ($season,$episode,\"".$stitle."\",$category,\"".$cover."\")";
                    $addepisodequery = "INSERT INTO resz(evadSzam, reszSzam, cim, hossz, sorozatid) VALUES ($season,$episode,\"".$etitle."\",$minute,$serie);";
                    //echo $addepisodequery;
                    executeQuery($addepisodequery);
                } 
             else {
            ?>
                <script>
                    Swal.fire(
                        'Hiba!!',
                        'Hibásan oldotta meg a reCAPTCHA-t!',
                        'warning'
                    )
                </script>
        <?php
            }
        }
    } else {
        ?>
        <script>
            Swal.fire(
                'Hiba!!',
                'Oldja meg a reCAPTCHA-t!',
                'warning'
            )
        </script>

<?php
    }
}
?>