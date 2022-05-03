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
            <h2>Kategória hozzáadása</h2>
            <span id="alertText"></span>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="text" class="form-control" placeholder="új kategória neve" name="category_name">
                </div>
            </div>
            
            <div class="row">
                
            </div>
            <div class="g-recaptcha" data-sitekey="6Ldn7pwfAAAAACw2iKHx8m9Z44PmGvO0WMI0jOSv"></div>
            <br>
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="submit" class="btn btn-block btn-login" name="addCategoryBtn" value="Hozzáadás">
                </div>
            </div>
        </div>
    </form>
</BODY>
</HTML>
<?php
if (isset($_POST["addCategoryBtn"])) {
    if ($_POST['g-recaptcha-response'] != "") {
        if ($_POST["category_name"] == "") {
?>
            <script>
                Swal.fire(
                    'Hiba!!',
                    'A kategória neve nem lehet üres!',
                    'warning'
                )
            </script>
        <?php
        }   else {
            $secret = "6Ldn7pwfAAAAACRw3JETEHv49XHprFK4_nePnRy8";
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                
                $cname = $_POST["category_name"];
                $checkQuery = "sELECT * FROM kategoria WHERE name = '".$cname."'";
                $ifNotExists = classList($checkQuery);
                if ($ifNotExists === null || empty($ifNotExists)) {
                    echo "<script>alertText('alertText','Sikeres kategória hozzáadás!','success')</script>";
                    $addcategoryquery = "iNSERT INTO kategoria(name) VALUES (\"$cname\")";
                    echo $addcategoryquery;
                    executeQuery($addcategoryquery);
                }
                else
                {
                    echo "<script>alertText('alertText','Már van ilyen kategória!','error')</script>";
                }
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