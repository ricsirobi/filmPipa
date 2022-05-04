<?php
if (isset($_GET["sid"]) && isset($_GET["evad"])&& isset($_GET["title"]) )

$sql  = 'select resz.id, resz.reszSzam ,resz.cim , resz.hossz from resz, sorozatok where sorozatid = '.$_GET["sid"] . ' group by cim order by reszSzam';
$result = classList($sql);
if ($result === NULL || empty($result)) : ?>
    <p>Nincs rekord</p>
<?php else : ?>

    <head>
        <link rel="stylesheet" href="<?php echo PUBLIC_DIR . "style.css"; ?>">
    </head>

    <body>
    <form method="post" action="">
        <div class="usersDiv">
            <h2><?=$_GET["title"].": ".$_GET["evad"].". évad"?><br><input type="submit" name="saveSaw" value="Mentés"></h2>
            <table class="table">
                <form method="post">
                    <thead>
                        <tr>
                            <th> Rész</th>
                            <th>Cím</th>
                            <th> Láttam </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($result as $row) : $n = $n + 1 ?>
                            <tr>
                                <td><?=$row["reszSzam"]?> </td>
                                <td><?= $row['cim'] ?></td>
                                <td> <input type='checkbox' name=<?= $row["id"] ?> value=<?= $row["id"] ?>> </td>
                            </tr>
                        <?php endforeach; ?>

                    </tbody>
                </form>
            </table>
        </div>
    </form>
    </body>
<?php endif; ?>


<?php
if (isset($_POST["saveSaw"])) {
    $result = classList($sql);
    echo $_POST[$row["id"]];
    foreach ($result as $row) {
        if ($_POST[$row["id"]] == true) {
            $sqlif = "select * from sawepisode where uid = " . $_SESSION["uid"] . " and eid = " . $_POST[$row["id"]];
            $ifNotExists = classList($sqlif);
            if ($ifNotExists == null || empty($ifNotExists)) {
                $sql = "iNSERT INTO sawepisode(uid, eid) VALUES (" . $_SESSION["uid"] . "," . $_POST[$row["id"]] . ")";
            executeQuery($sql);
            } else {
               
            }
        }
    }
}

?>