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
            <h2>Sorozat hozzáadása</h2>
            <span id="alertText"></span>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="text" class="form-control" placeholder="Cím" name="series_title">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="number" placeholder="Hanyadik évad" class="form-control" name="series_season">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="number" placeholder="Évadban szereplő részek" class="form-control" name="series_episode">
                </div>
            </div>
            <div class="row" >
                <div class="col-md-12 form-group">
                <?php
                $sql = "select * from kategoria";
                $result = classList($sql);
                ?>    
                <select name="category" id="category">
                
                        <option value="" selected disabled>Kategória</option>
                        <?php foreach ($result as $row) : $n = $n + 1 ?>
                        <option value="<?=$row["id"]?>"><?=$row["name"]?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="text" placeholder="Borító link" class="form-control" name="series_cover">
                </div>
            </div>
            <div class="g-recaptcha" data-sitekey="6Ldn7pwfAAAAACw2iKHx8m9Z44PmGvO0WMI0jOSv"></div>
            <br>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="submit" class="btn btn-block btn-login" name="addSeriesBtn" value="Hozzáadás">
                </div>
            </div>
        </div>
    </form>
</BODY>
</HTML>
<?php
if (isset($_POST["addSeriesBtn"])) {
    if ($_POST['g-recaptcha-response'] != "") {
        if ($_POST["series_title"] == "") {
?>
            <script>
                Swal.fire(
                    'Hiba!!',
                    'A cím nem lehet üres!',
                    'warning'
                )
            </script>
        <?php
        } else if ($_POST["series_season"] == "") {
            ?>
                <script>
                    Swal.fire(
                        'Hiba!!',
                        'Az évad száma nem lehet üres!',
                        'warning'
                    )
                </script>
            <?php
            } 
        
        else if ($_POST["series_episode"] == "") {
        ?>
            <script>
                Swal.fire(
                    'Hiba!!',
                    'A részek száma nem lehet üres!',
                    'warning'
                )
            </script>
        <?php
        } else if ($_POST["category"] == "") {
        ?>
            <script>
                Swal.fire(
                    'Hiba!!',
                    'Válassz kategóriát!',
                    'warning'
                )
            </script>
        <?php
        } else if ($_POST["series_cover"] == "") {
        ?>
            <script>
                Swal.fire(
                    'Hiba!!',
                    'A borító képe nem lehet üres!',
                    'warning'
                )
            </script>
        <?php
        }  else {
            $secret = "6Ldn7pwfAAAAACRw3JETEHv49XHprFK4_nePnRy8";
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                    $stitle = $_POST["series_title"];
                    $season = $_POST["series_season"];
                    $episode = $_POST["series_episode"];
                    echo "<script>alertText('alertText','Sikeres hozzáadás!','success')</script>";
                    $category = $_POST["category"];
                    $cover = $_POST["series_cover"];
                    $addseriesquery = "INSERT INTO sorozatok(evad, resz, cim, kategoria, borito) VALUES ($season,$episode,\"".$stitle."\",$category,\"".$cover."\")";
                    echo $addseriesquery;
                    executeQuery($addseriesquery);
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