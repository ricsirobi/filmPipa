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
            <h2>Film hozzáadása</h2>
            <span id="alertText"></span>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="text" class="form-control" placeholder="Cím" name="film_title">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="number" placeholder="Hossz (Perc)" class="form-control" name="film_minute">
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
                    <input type="text" placeholder="Borító link" class="form-control" name="film_cover">
                </div>
            </div>
            <div class="g-recaptcha" data-sitekey="6Ldn7pwfAAAAACw2iKHx8m9Z44PmGvO0WMI0jOSv"></div>
            <br>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="submit" class="btn btn-block btn-login" name="addFilmBtn" value="Hozzáadás">
                </div>
            </div>
        </div>
    </form>
</BODY>
</HTML>
<?php
if (isset($_POST["addFilmBtn"])) {
    if ($_POST['g-recaptcha-response'] != "") {
        if ($_POST["film_title"] == "") {
?>
            <script>
                Swal.fire(
                    'Hiba!!',
                    'A cím nem lehet üres!',
                    'warning'
                )
            </script>
        <?php
        } else if ($_POST["film_minute"] == "") {
        ?>
            <script>
                Swal.fire(
                    'Hiba!!',
                    'A hossz nem lehet üres!',
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
        } else if ($_POST["film_cover"] == "") {
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
                    $ftitle = $_POST["film_title"];
                    $minute = $_POST["film_minute"];
                    echo "<script>alertText('alertText','Sikeres hozzáadás!','success')</script>";
                    $category = $_POST["category"];
                    $cover = $_POST["film_cover"];
                    $addfilmquery = "iNSERT INTO filmek(cim, hossz, kategoria, borito) VALUES (\"".$ftitle."\",".$minute.",".$category.", \" ".$cover."\");";
                    executeQuery($addfilmquery);
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