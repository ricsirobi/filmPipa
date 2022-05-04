<?php $sql  = 'select filmek.id, cim, hossz, borito , name as kategoria
FROM filmek, kategoria 
WHERE kategoria.id = filmek.kategoria 
order by cim desc';
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
                <h2>Filmek: <br><input type="submit" name="saveSaw" value="Mentés"></h2>

                <table class="table">
                    <form method="post">
                        <thead>
                            <tr>
                                <th>Borító</th>
                                <th>Cím</th>
                                <th>Hossz(perc)</th>
                                <th>Kategória</th>
                                <th> Láttam </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($result as $row) : $n = $n + 1 ?>
                                <tr>
                                    <td><img src="<?= $row['borito'] ?>" width="300" height="150" alt="cover picture"></td>
                                    <td><?= $row['cim'] ?></td>
                                    <td><?= $row['hossz'] ?></td>
                                    <td><?= $row['kategoria'] ?></td>
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
            $sqlif = "select * from sawfilm where uid = " . $_SESSION["uid"] . " and fid = " . $_POST[$row["id"]];
            $ifNotExists = classList($sqlif);
            if ($ifNotExists == null || empty($ifNotExists)) {
                $sql = "iNSERT INTO sawfilm(uid, fid) VALUES (" . $_SESSION["uid"] . "," . $_POST[$row["id"]] . ")";
            executeQuery($sql);
            } else {
               
            }
        }
    }
}

?>