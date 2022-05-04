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
    <div class="simple-container">
        <h2>Kategória hozzáadása</h2>
        <div class="row">
            <div class="col-md-12 form-group">
                <form action="" method="post" enctype="multipart/form-data">
                    Válassza ki a fájlt:
                    <br>
                    <input type="file" name="fileToUpload" value="/uploads">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <input type="submit" name="submit" value="Feltöltés">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>


    </form>
</BODY>

</HTML>

<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$fileName = basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$f = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

if (isset($_POST["submit"])) {
    $uploadOk = 1;
}

if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Túl nagy a fájl.";
    $uploadOk = 0;
}

if (($f != "csv") && $f != "") {
    echo $f;
    echo "Csak csv fájl megengedett.";
    $uploadOk = 0;
} else {
    $uploadOk = 1;
}

if ($uploadOk == 0) {
    //echo "Hiba a fájl feltöltése során";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Fájl: " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " feltöltve.";

        $handleFile = fopen($target_file, "r");
        while (!feof($handleFile)) {
            $line = fgets($handleFile);
            uploadNewCategory($line);
        }

        fclose($handleFile);
    } else {
        //echo "Hiba a fájl feltöltése során.";
    }
}
function uploadNewCategory($cname)
{
    if ($cname != "") {
        $checkQuery = "sELECT * FROM kategoria WHERE name = '" . $cname . "'";
        $ifNotExists = classList($checkQuery);
        if ($ifNotExists === null || empty($ifNotExists)) {
            $addcategoryquery = "iNSERT INTO kategoria(name) VALUES (\"$cname\")";
            executeQuery($addcategoryquery);
            echo "<br>Sikeresen hozzáadva a kategóriákhoz: " . $cname;
        } else {
            echo "<br>Már volt ilyen kategória: " . $cname;
        }
    }
}
?>